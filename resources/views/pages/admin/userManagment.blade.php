@extends('layouts.app', ['pageSlug' => 'user-managment'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">User Managment</h5>
                            <h2 class="card-title">Users</h2>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="card-content">
                    @include('partials.users', ['users' => $users ,'pageSlug' => 'user-managment'])
                </div>
            </div>
        </div>
    </div>

    <script>
        function initSearch(tableId, inputId) {
            const searchInput = document.getElementById(inputId);
            const table = document.getElementById(tableId);

            if (!searchInput || !table) return;

            const rows = table.querySelectorAll("tbody tr");

            searchInput.addEventListener("input", function() {
                const query = this.value.toLowerCase().trim();
                rows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(query) ? "" : "none";
                });
            });
        }
        initSearch("usersTable", "userSearch");

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSearch);
        } else {
            initSearch();
        }
    </script>
@endsection
