// Function to fetch table data
async function fetchTableData(page = 1, search = "") {
    $("#users_table").html("");

    $.ajax({
        url: "api/users?page=" + page + "&search=" + $("#search_table").val(),
        type: "GET",
        success: function (response) {
            $("#users_table").html(response.table_data);
        },
        complete: function () {
            $("#search_table").focus();

            tableActions();
        },
    });
}

// Function to get user data
function getUser(userId, action = "edit") {
    $("#page_loader").removeClass("d-none");
    $("#user_modal").html("");

    $.ajax({
        url: "api/users/" + userId + "/" + action,
        type: "GET",
        success: function (response) {
            if (action === "delete") {
                $("#delete_user_modal").html(response.user_data);
            } else {
                $("#user_modal").html(response.user_data);
            }
        },
        complete: function () {
            if (action === "delete") {
                $("#deleteUserModal").modal("show");

                // reset modal
                $("#deleteUserModal").on("hidden.bs.modal", function () {
                    resetModalData(userId);
                });

                //initialize delete modal form
                deleteModalForm();
            } else if (action === "edit") {
                $("#addNewUserModal").modal("show");

                // reset modal after user closes edit user user modal withouth updating the data
                $("#addNewUserModal").on("hidden.bs.modal", function () {
                    resetModalData(userId);
                });

                //initialize submit modal form
                submitModalForm();
            }

            $("#datepicker").datepicker({
                format: "yyyy-mm-dd",
            });

            $("#page_loader").addClass("d-none");
        },
    });
}

function tableActions() {
    // Pagination AJAX
    $("#pagination_links a")
        .unbind()
        .on("click", function (event) {
            event.preventDefault();

            console.log("PAGINATION LINK CLICKED");

            var page = $(this).attr("href").split("page=")[1];

            fetchTableData(page);
        });

    // Edit user
    $(".edit-user")
        .unbind()
        .on("click", function (event) {
            event.preventDefault();

            var userId = $(this).data("user-id");

            getUser(userId);
        });

    // Delete user
    $(".delete-user-icon")
        .unbind()
        .on("click", function (event) {
            event.preventDefault();

            var userId = $(this).data("user-id");

            getUser(userId, "delete");
        });
}

function submitModalForm() {
    $(".submit-modal")
        .unbind()
        .on("click", function (e) {
            e.preventDefault();

            var form = $("#add_new_user");

            form.parsley().reset();
            form.parsley().validate();

            if (form.parsley().isValid()) {
                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: new FormData(form[0]),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        fetchTableData();

                        form.parsley().reset();
                        $("#add_new_user input").val("");

                        $("#addNewUserModal").modal("hide");

                        if (form.attr("method") === "POST") {
                            $("#flash_success_message").text(
                                "User created successfully!"
                            );
                        } else {
                            $("#flash_success_message").text(
                                "User updated successfully!"
                            );
                        }

                        $("#success_flash").addClass("show");
                        setTimeout(function () {
                            $("#success_flash").removeClass("show");
                        }, 2000);

                        $("#user_modal").html(response.modal_data);
                    },
                    error: function (response) {
                        for (const value in response.responseJSON.errors) {
                            $('[name="' + value + '"]')
                                .parsley()[0]
                                .addError("serverValidationError", {
                                    message:
                                        response.responseJSON.errors[value][0],
                                });
                        }
                    },
                    complete: function (response) {
                        $("#datepicker").datepicker({
                            format: "yyyy-mm-dd",
                        });
                    },
                });
            }
        });
}

function deleteModalForm() {
    $(".delete-user-button")
        .unbind()
        .on("click", function (e) {
            e.preventDefault();

            $.ajax({
                url: "api/users/" + $(".delete-user-button").data("user-id"),
                type: "DELETE",
                processData: false,
                contentType: false,
                success: function (response) {
                    fetchTableData();

                    $("#add_new_user input").val("");

                    $("#deleteUserModal").modal("hide");

                    $("#flash_success_message").text(
                        "User deleted successfully!"
                    );
                    $("#success_flash").addClass("show");
                    setTimeout(function () {
                        $("#success_flash").removeClass("show");
                    }, 2000);

                    $("#delete_user_modal").html(response.modal_data);
                },
            });
        });
}

function resetModalData(userId) {
    $("#add_new_user input").val("");
    $.ajax({
        url: "api/users/" + userId + "/reset-modal",
        type: "GET",
        success: function (response) {
            $("#user_modal").html(response.user_data);
        },
        complete: function () {
            $("#datepicker").datepicker({
                format: "yyyy-mm-dd",
            });
        },
    });
}

$(async function () {
    await fetchTableData();

    //initialize create new modal form
    submitModalForm();

    // Search functionality
    $("#search_table")
        .unbind()
        .on("input", function () {
            var searchText = $(this).val().toLowerCase();

            if (typeof debounceTimer !== "undefined") {
                clearTimeout(debounceTimer); // Clear previous timer
            }
            debounceTimer = setTimeout(function () {
                fetchTableData(1, searchText);
            }, 1000); // Set new timer
        });
});
