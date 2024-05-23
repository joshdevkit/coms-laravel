<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo e(route('owner.dashboard')); ?>" class="brand-link">
      <img src="<?php echo e(asset('templates/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Project Owner</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="<?php echo e(route('owner.dashboard')); ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Projects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('owner.project-list')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project List</p>
                </a>
              </li>

            </ul>
          </li>

          
        </ul>
      </nav>
    </div>
  </aside>
<?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/templates/owner/sidebar.blade.php ENDPATH**/ ?>