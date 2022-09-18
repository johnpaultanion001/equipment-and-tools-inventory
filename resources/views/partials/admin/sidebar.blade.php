<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-user"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{ Auth::user()->roles()->pluck('title')->implode(', ') }}</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

@can('admin_access')
    <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*')  ? 'active' : '' }}">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-fw fa-folder"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ request()->is('admin/events') || request()->is('admin/events/*')  ? 'active' : '' }}">
        <a class="nav-link" href="/admin/events">
            <i class="fas fa-fw fa-folder"></i>
            <span>Events</span></a>
    </li>
    <li class="nav-item {{ request()->is('admin/members')  ? 'active' : '' }}">
        <a class="nav-link" href="/admin/members">
            <i class="fas fa-fw fa-table"></i>
            <span>Members</span></a>
    </li>
@endcan

@can('user_access')
<li class="nav-item {{ request()->is('admin/user/events') || request()->is('admin/user/*')  ? 'active' : '' }}">
        <a class="nav-link" href="/admin/user/events">
            <i class="fas fa-fw fa-folder"></i>
            <span>Events</span>
        </a>
</li>
<li class="nav-item {{ request()->is('admin/users/history')  ? 'active' : '' }}">
        <a class="nav-link" href="/admin/users/history">
            <i class="fas fa-fw fa-folder"></i>
            <span>History</span>
        </a>
</li>
<li class="nav-item {{ request()->is('admin/users/account/*')  ? 'active' : '' }}">
        <a class="nav-link" href="/admin/users/account/{{auth()->user()->id}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Account</span>
        </a>
</li>
@endcan

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>
<!-- End of Sidebar -->