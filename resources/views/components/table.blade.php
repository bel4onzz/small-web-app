<div id="users_table">
    <!-- Table -->
    <div class="table-responsive">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Age</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($users['data']) && !empty($users['data']))
                    @foreach ($users['data'] as $user)
                        <tr>
                            <td>
                                {{ $loop->iteration + ($pagination->currentPage() - 1) * $pagination->perPage() }}
                            </td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['phone'] }}</td>
                            <td>{{ $user['age'] }}</td>
                            <td>
                                <a href="" title="Edit Record" class="px-2 text-decoration-none edit-user"
                                    data-user-id="{{ $user['id'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pen text-warning" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                    </svg>
                                </a>
                                <a href="" title="Delete Record" class="px-2 text-decoration-none delete-user"
                                    data-user-id="{{ $user['id'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">No records</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-end" id="pagination_links">
        {{ $pagination->links() }}
    </div>
</div>

<script>
    // Search functionality
    $("#search_table").unbind().on("input", function() {
        var searchText = $(this).val().toLowerCase();

        if (typeof debounceTimer !== "undefined") {
            clearTimeout(debounceTimer); // Clear previous timer
        }
        debounceTimer = setTimeout(function() {
            fetchTableData(1, searchText);
        }, 1000); // Set new timer
    });

    // Pagination AJAX
    $("#pagination_links a").unbind().on("click", function(event) {
        event.preventDefault();

        var page = $(this).attr("href").split("page=")[1];

        fetchTableData(page);
    });

    // Pagination AJAX
    $("#pagination_links a").unbind().on("click", function(event) {
        event.preventDefault();

        var page = $(this).attr("href").split("page=")[1];

        fetchTableData(page);
    });

    // Edit user
    $(".edit-user").unbind().on("click", function(event) {
        event.preventDefault();

        var userId = $(this).data("user-id");

        getUser(userId);
    });

    // Delete user
    $(".delete-user").unbind().on("click", function(event) {
        event.preventDefault();

        var userId = $(this).data("user-id");

        getUser(userId, "delete");
    });

    // Function to fetch table data
    function fetchTableData(page = 1, search = "") {
        $("#users_table").html("");

        $.ajax({
            url: "api/users?page=" + page + "&search=" + $("#search_table").val(),
            type: "GET",
            success: function(response) {
                $("#users_table").html(response.table_data);
            },
            complete: function() {
                $("#search_table").focus();
            }

        });
    }

    // Function to get user data
    function getUser(userId, action = "edit") {
        $("#user_modal").html("");

        $.ajax({
            url: "api/users/" + userId + "/" + action,
            type: "GET",
            success: function(response) {
                if (action === "delete") {
                    $("#delete_user_modal").html(response.user_data);
                } else {
                    $("#user_modal").html(response.user_data);
                }
            },
            complete: function() {
                if (action === "delete") {
                    $("#deleteUserModal").modal("show");

                    // reset modal
                    $("#deleteUserModal").on("hidden.bs.modal", function() {
                        resetModalData(userId)
                    });
                } else if (action === "edit") {
                    $("#addNewUserModal").modal("show");

                    // reset modal after user closes edit user user modal withouth updating the data
                    $("#addNewUserModal").on("hidden.bs.modal", function() {
                        resetModalData(userId)
                    });
                }

                $("#datepicker").datepicker({
                    format: "yyyy-mm-dd"
                });
            }

        });
    }

    function resetModalData(userId) {
        $("#add_new_user input").val("");
        $.ajax({
            url: "api/users/" + userId + "/reset-modal",
            type: "GET",
            success: function(response) {
                $("#user_modal").html(response.user_data);
            },
            complete: function() {
                $("#datepicker").datepicker({
                    format: "yyyy-mm-dd"
                });
            }
        });
    }
</script>
