<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteUserModalLabel">Delete record!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete user {{ $user['name'] ?? '' }} - {{ $user['email'] ?? '' }}?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
                <button type="button" class="btn btn-danger delete-user"
                    data-user-id="{{ $user['id'] }}">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".delete-user").on("click", function(e) {
        e.preventDefault();

        $.ajax({
            url: "api/users/" + $(".delete-user").data("user-id"),
            type: "DELETE",
            processData: false,
            contentType: false,
            success: function(response) {
                fetchTableData();

                $("#add_new_user input").val("");

                $("#deleteUserModal").modal("hide");

                $("#flash_success_message").text("User deleted successfully!");
                $("#success_flash").addClass("show");
                setTimeout(function() {
                    $("#success_flash").removeClass("show");
                }, 2000);

                $("#delete_user_modal").html(response.modal_data);
            },
        });
    });
</script>
