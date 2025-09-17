@extends('layouts.app', ['pageSlug' => 'tasks'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Tasks Managment</h5>
                            <h2 class="card-title">Tasks</h2>
                            @can('Create Task')
                                <a href="{{ route('taskCreatePage') }}" class="button"> Create Task</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <h4 style="color:aliceblue;margin-left:20px;margin-top: 10px;">{{ session('status') }}</h4>
                <div class="card-body" id="card-content">
                    @include('partials.tasks', ['tasks' => $tasks, 'pageSlug' => 'tasks'])
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            height: 100% !important;
        }

        .button {
            display: block;
            width: 140px;
            font-weight: bold;

            text-align: center;

            background: linear-gradient(45deg,
                    rgb(16, 137, 211) 0%,
                    rgb(18, 177, 209) 100%);
            color: white;
            padding-block: 15px;



            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 5px 5px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .button:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 5px 5px -15px;
            color: aliceblue;
        }

        .button:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 5px 5px -15px;
        }
    </style>

    {{-- <script>
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
        initSearch("rolesTable", "rolesSearch");

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSearch);
        } else {
            initSearch();
        }
    </script> --}}
    @vite(['resources/js/app.js'])
@endsection
