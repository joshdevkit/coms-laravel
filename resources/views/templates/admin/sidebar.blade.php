<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('templates/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.create-project') || request()->routeIs('admin.view-projects') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Projects
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create-project') }}"
                                class="nav-link {{ request()->routeIs('admin.create-project') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add New Project</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.view-projects') }}"
                                class="nav-link {{ request()->routeIs('admin.view-projects') ? 'active' : '' }}">
                                <i class="far fa-eye nav-icon"></i>
                                <p>Project List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Tasks
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New Task</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Task List</p>
                </a>
              </li>
            </ul>
          </li> --}}
                <li class="nav-item">
                    <a href="{{ route('admin.reports') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                            Project Costing
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.costing') }}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Costing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.estimator') }}" class="nav-link">
                                <i class="fas fa-wrench nav-icon"></i>
                                <p>Estimator</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
