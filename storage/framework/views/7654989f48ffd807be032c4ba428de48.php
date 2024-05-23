<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">

            <a class="nav-link mr-3" data-toggle="dropdown" href="#">
                <img src="<?php echo e(asset(auth()->user()->avatar)); ?>" alt="User Avatar" class="img-circle elevation-2" style="width: 30px; height: 30px; object-fit: cover;">
                <span class="d-none d-md-inline"><?php echo e(auth()->user()->fullname); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header">
                        <h3 class="widget-user-username"><?php echo e(auth()->user()->fullname); ?></h3>
                        <h5 class="widget-user-desc">
                            <?php if(auth()->user()->type == 1): ?>
                               System Administrator
                            <?php elseif(auth()->user()->type == 2): ?>
                               Project Manager
                            <?php elseif(auth()->user()->type == 3): ?>
                              Project Member
                            <?php elseif(auth()->user()->type == 0): ?>
                               Project Owner
                            <?php endif; ?>
                        </h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 border-top">
                                <a href="<?php echo e(route('owner.account-settings')); ?>" class="btn btn-primary btn-block">
                                    <i class="fas fa-cog mr-2"></i> Account Settings
                                </a>
                            </div>
                            <div class="col-sm-12 border-top">
                                <a href="<?php echo e(route('owner.change-password')); ?>" class="btn btn-primary btn-block">
                                    <i class="fas fa-users mr-2"></i> Change Password
                                </a>
                            </div>
                            <div class="col-sm-12 border-top">
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary btn-block">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>

      
    </ul>
  </nav>
<?php /**PATH C:\xampp\htdocs\construction-management-system\resources\views/templates/owner/topbar.blade.php ENDPATH**/ ?>