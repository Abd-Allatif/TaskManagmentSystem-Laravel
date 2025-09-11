<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('dashboard') }}" class="simple-text logo-mini">{{ __('TMD') }}</a>
            <a href="{{ route('dashboard') }}" class="simple-text logo-normal">{{ __('TM DashBoard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{route('dashboard')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>DashBoard</p>
                </a>
            </li>
            <li @if ($pageSlug == 'admin-managment-view') class="active " @endif>
                <a href="{{route('adminManagmentView')}}">
                    <i class="tim-icons icon-paper"></i>
                    <p>Admin Management View</p>
                </a>
            </li>
            <li @if ($pageSlug == 'user-managment') class="active " @endif>
                <a href="{{route('userManagment')}}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>User Management</p>
                </a>
            </li>
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Admin Profile</p>
                </a>
            </li>
            </li>
        </ul>
    </div>
</div>
