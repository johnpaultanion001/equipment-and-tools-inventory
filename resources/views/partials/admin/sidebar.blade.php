<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion toggled" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
    <div class="sidebar-brand-icon ">
        <i class="fas fa-building"></i>
    </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

@can('admin_access')

    <li class="nav-item {{ request()->is('admin/equipments')  ? 'active' : '' }}">
        <a class="nav-link" href="/admin/equipments">
            <i class="fas fa-fw fa-table"></i>
            <span>Equipments</span></a>
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
