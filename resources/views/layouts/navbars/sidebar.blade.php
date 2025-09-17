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
            <li @if ($pageSlug == 'user-managment') class="active " @endif>
                <a href="{{route('userManagment')}}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>User Management</p>
                </a>
            </li>
            <li @if ($pageSlug == 'roles') class="active " @endif>
                <a href="{{route('rolesManagment')}}">
                    <i class="tim-icons icon-lock-circle"></i>
                    <p>Roles and Permissions</p>
                </a>
            </li>
            <li @if ($pageSlug == 'categories') class="active " @endif>
                <a href="{{route('categoryManagment')}}">
                    <i class="tim-icons icon-components"></i>
                    <p>categories</p>
                </a>
            </li>
            <li @if ($pageSlug == 'tasks') class="active " @endif>
                <a href="{{route('taskManagment')}}">
                    <i class="tim-icons icon-notes"></i>
                    <p>Tasks</p>
                </a>
            </li>
            <li @if ($pageSlug == 'admins') class="active " @endif>
                <a href="{{route('adminManagment')}}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Admins</p>
                </a>
            </li>
            </li>
        </ul>
    </div>
</div>
