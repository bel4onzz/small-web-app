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
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No records</td>
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
    $('#search_table').unbind().on('input', function() {
        var searchText = $(this).val().toLowerCase();

        if(typeof debounceTimer !== "undefined"){
            clearTimeout(debounceTimer); // Clear previous timer
        }
        debounceTimer = setTimeout(function() {
            fetchTableData(1, searchText);
        }, 1000); // Set new timer
    });

    // Pagination AJAX
    $(document).unbind().on('click', '#pagination_links a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        fetchTableData(page);
    });

    // Function to fetch table data via AJAX
    function fetchTableData(page = 1, search = "") {
        $('#users_table').html('');

        $.ajax({
            url: 'api/users?page=' + page + '&search=' + $('#search_table').val(),
            success: function(response) {
                $('#users_table').html(response.table_data);
            },
            complete: function() {
                $('#search_table').focus();
            }

        });
    }
</script>
