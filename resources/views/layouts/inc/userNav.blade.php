<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
      @if (Route::has('login'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
      @endif
      
      @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
      @endif
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                 {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
      <!-- fullscreen button -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/userDashboard" class="brand-link">
      <span class="brand-text font-weight-light">User Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
     
        <div class="image">
          <img src="{{ asset('/storage/profile_images/'.Auth::user()->profile_image) }}" class="img-circle elevation-2" alt="User Image" style="height: 35px;width:35px;">
        </div>
     
        <div class="info">
          <a href="/userDashboard" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/userDashboard" class="nav-link {{ Route::is('userDashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
      
          <li class="nav-header" style="padding-top: 2px;">BUSINESS CARD MANAGEMENT</li>
          <!-- Portfolio -->
          <li class="nav-item">
            <a href="/portfolio" class="nav-link {{ Route::is('portfolio') ? 'active' : '' }}">
              <i class="fas fa-images"></i>
              <p>&nbsp; Portfolio</p>
            </a>
          </li>
          <!-- profile template -->
          <li class="nav-item">
              <a href="/updateProfileTemplate" class="nav-link {{ Route::is('updateProfileTemplate') ? 'active' : ''}}">
                <i class="fas fa-object-group"></i>
                <p>&nbsp; Change Profile Template</p>
              </a>
          </li>
          <li class="nav-item">
          <a href="/{{ Auth::user()->name_slug }}" target="_blank" class="nav-link">
              <i class="fas fa-eye"></i>
              <p>&nbsp; View Profile</p>
            </a>
          </li>
          <li class="nav-item {{ Route::is('editUserProfile') || Route::is('editAdditionalInfo') || Route::is('addSkills') || Route::is('addExperience') || Route::is('addEducation') || Route::is('addReference') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Route::is('editUserProfile') || Route::is('editAdditionalInfo') || Route::is('addSkills') || Route::is('addExperience') || Route::is('addEducation') || Route::is('addReference') ? 'active' : ''}}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Edit Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/editUserProfile" class="nav-link {{ Route::is('editUserProfile') ? 'active' : ''}}">
                  <i class="fas fa-user-edit"></i>
                  <p>&nbsp; Profile Info<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/editAdditionalInfo" class="nav-link {{ Route::is('editAdditionalInfo') ? 'active' : ''}}">
                  <i class="fas fa-info-circle"></i>
                  <p>&nbsp; Add/Edit Additional Info<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addSkills" class="nav-link {{ Route::is('addSkills') ? 'active' : ''}}">
                  <i class="fas fa-chart-bar"></i>
                  <p>&nbsp; Add/Remove Skills<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addExperience" class="nav-link {{ Route::is('addExperience') ? 'active' : ''}}">
                  <i class="fas fa-briefcase"></i>
                  <p>&nbsp; Add/Remove Experience<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addEducation" class="nav-link {{ Route::is('addEducation') ? 'active' : ''}}">
                  <i class="fas fa-briefcase"></i>
                  <p>&nbsp; Add/Remove Education<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addReference" class="nav-link {{ Route::is('addReference') ? 'active' : ''}}">
                  <i class="fas fa-id-card"></i>
                  <p>&nbsp; Add/Remove Refrence<br></p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/contactMessages" class="nav-link {{ Route::is('contactMessages') ? 'active' : ''}}">
              <i class="fas fa-comments-dollar"></i>
              <p>&nbsp; Contact Messages</p>
            </a>
          </li>

          <!-- Account setting -->
          <li class="nav-item {{ Route::is('changePassword') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Route::is('changePassword') ? 'active' : ''}}">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Account Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/changePassword" class="nav-link {{ Route::is('changePassword') ? 'active' : ''}}">
                  <i class="fas fa-edit"></i>
                  <p>&nbsp; Change Password<br></p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
