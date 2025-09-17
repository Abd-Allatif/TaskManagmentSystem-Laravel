<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
    <div class="container-fluid">

        <div class="navbar-wrapper">
            <a class="navbar-brand"
                @can('View DashBoard') href="{{ route('dashboard') }}" @endcan>{{ $page ?? __('Task Managment Dashboard') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <div class="photo">
                            <img src="{{ asset('black') }}/img/anime3.png" alt="{{ __('Profile Photo') }}">
                        </div>

                        <b class="caret d-none d-lg-block d-xl-block"></b>
                    </a>

                    <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                            <a href="{{ route('adminProfile') }}" class="nav-item dropdown-item">{{ __('Profile') }}</a>
                        </li>

                        <li class="dropdown-divider"></li>

                        <li class="nav-link">
                            <a href="{{ route('admin-logout') }}" class="nav-item dropdown-item"
                                onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="separator d-lg-none"></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdowns = document.querySelectorAll(".dropdown");

        dropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector(".dropdown-toggle");

            trigger.addEventListener("click", function(e) {
                e.preventDefault();

                // Close all other dropdowns first
                document.querySelectorAll(".dropdown.show").forEach(openDropdown => {
                    if (openDropdown !== dropdown) {
                        openDropdown.classList.remove("show");
                    }
                });

                // Toggle this one
                dropdown.classList.toggle("show");
            });
        });

        // Close when clicking outside
        document.addEventListener("click", function(e) {
            document.querySelectorAll(".dropdown.show").forEach(openDropdown => {
                if (!openDropdown.contains(e.target)) {
                    openDropdown.classList.remove("show");
                }
            });
        });

        // Optional: close on Escape key
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                document.querySelectorAll(".dropdown.show").forEach(openDropdown => {
                    openDropdown.classList.remove("show");
                });
            }
        });
    });
</script>
