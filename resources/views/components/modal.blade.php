<div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addNewUserModalLabel">Add new record</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add_new_user" action="{{ isset($user) ? 'api/users/' . $user['id'] : 'api/users' }}">
                    <div class="row">
                        <div class="form-field text-start my-2">
                            <label class="label" for="name">Full Name</label>
                            <input id="name" name="full_name" class="form-control" type="text" required
                                data-parsley-required-message="This field is required"
                                value="{{ $user['name'] ?? '' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field text-start my-2">
                            <label class="label" for="email">E-mail</label>
                            <input id="email" name="email" class="form-control" type="email" required
                                data-parsley-required-message="This field is required"
                                value="{{ $user['email'] ?? '' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field text-start my-2">
                            <label class="label" for="phone">Phone</label>
                            <input id="phone" name="phone" class="form-control" type="text" required
                                data-parsley-required-message="This field is required"
                                value="{{ $user['phone'] ?? '' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-field text-start my-2">
                            <label class="label" for="phone">Date of Birth</label>
                            <input type="text" name="date_of_birth" id="datepicker" class="form-control" required
                                data-parsley-required-message="This field is required"
                                value="{{ $user['birth_date'] ?? '' }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if (isset($user) && !empty($user))
                    <button type="button" class="btn btn-primary submit-modal">Update</button>
                @else
                    <button type="button" class="btn btn-primary submit-modal">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>
