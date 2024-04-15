<x-layout>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis">Small Web Application</h1>
        <p class="lead mb-1">Welcome to small web application.</p>
        <p class="lead mb-1">This is application for storing data in database.</p>

        <div class="col-lg-6 mx-auto mt-4">
            <!-- Add new record button -->
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-end">
                <button type="button" class="btn btn-primary btn-sm p-2" data-bs-toggle="modal"
                    data-bs-target="#addNewUserModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-fill-add" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0">
                        </path>
                        <path
                            d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4">
                        </path>
                    </svg>
                    Add New
                </button>
            </div>

            <!-- Add / Update User Modal -->
            <div id="user_modal">
                <x-modal />
            </div>

            <!-- Delete User Modal -->
            <div id="delete_user_modal">
                <x-modal />
            </div>

            <!-- Search table input -->
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-end my-2">
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="search_table" name="search" placeholder="Search..."
                        value="{{ request('search') }}">
                    <div class="d-flex justify-content-start ps-1">
                        <label class="label small" for="company"><small>Start typing to search</small></label>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <x-table :users="$users" :pagination="$pagination" />
        </div>
    </div>
</x-layout>
