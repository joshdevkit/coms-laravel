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
                <img src="{{ asset(auth()->user()->avatar) }}" alt="User Avatar" class="img-circle elevation-2" style="width: 30px; height: 30px; object-fit: cover;">
                <span class="d-none d-md-inline">{{ auth()->user()->fullname }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header">
                        <h3 class="widget-user-username">{{ auth()->user()->fullname }}</h3>
                        <h5 class="widget-user-desc">
                            @if(auth()->user()->type == 1)
                               System Administrator
                            @elseif(auth()->user()->type == 2)
                               Project Manager
                            @elseif(auth()->user()->type == 3)
                              Project Member
                            @elseif(auth()->user()->type == 0)
                               Project Owner
                            @endif
                        </h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 border-top">
                                <a href="{{ route('owner.account-settings') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-cog mr-2"></i> Account Settings
                                </a>
                            </div>
                            <div class="col-sm-12 border-top">
                                <a href="{{ route('owner.change-password') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-users mr-2"></i> Change Password
                                </a>
                            </div>
                            <div class="col-sm-12 border-top">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary btn-block">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>

      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
