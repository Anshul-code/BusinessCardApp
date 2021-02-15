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
    <a href="/showUsers/editUser/{{ $user_data->id }}" class="brand-link">
      <span class="brand-text font-weight-light">Edit User Profile</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
     
        <div class="image">
          <img src="{{ asset('/storage/profile_images/'.$user_data->profile_image) }}" class="img-circle elevation-2" alt="User Image" style="height: 35px;width:35px;">
        </div>
     
        <div class="info">
          <a href="/showUsers/editUser/{{ $user_data->id }}" class="d-block">{{ $user_data->name }} (<i class="fas fa-user-edit"></i>)</a>
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
            <a href="/showUsers" class="nav-link {{ Route::is('showUsers') ? 'active' : '' }}">
              <i class="nav-icon fas fa-arrow-circle-left"></i>
              <p>
                Go To Dashboard
              </p>
            </a>
          </li>
      
          <li class="nav-header" style="padding-top: 2px;">BUSINESS CARD MANAGEMENT</li>
          <!-- Portfolio -->
          <li class="nav-item">
            <a href="/portfolioAdminEdit/{{$user_data->id}}" class="nav-link {{ Route::is('portfolioAdminEdit') ? 'active' : '' }}">
              <i class="fas fa-images"></i>
              <p>&nbsp; Portfolio</p>
            </a>
          </li>
          <!-- profile template -->
          <li class="nav-item">
              <a href="/updateTemplateAdminEdit/{{$user_data->id}}" class="nav-link {{ Route::is('updateTemplateAdminEdit') ? 'active' : ''}}">
                <i class="fas fa-object-group"></i>
                <p>&nbsp; Change Profile Template</p>
              </a>
          </li>
          <li class="nav-item">
          <a href="/{{ $user_data->name_slug }}" target="_blank" class="nav-link">
              <i class="fas fa-eye"></i>
              <p>&nbsp; View Profile</p>
            </a>
          </li>
          <li class="nav-item {{ Route::is('userProfileAdminEdit') || Route::is('additionalInfoAdminEdit') || Route::is('addSkillsAdminEdit') || Route::is('addExperienceAdminEdit') || Route::is('addEducationAdminEdit') || Route::is('addReferenceAdminEdit') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ Route::is('userProfileAdminEdit') || Route::is('additionalInfoAdminEdit') || Route::is('addSkillsAdminEdit') || Route::is('addExperienceAdminEdit') || Route::is('addEducationAdminEdit') || Route::is('addReferenceAdminEdit') ? 'active' : ''}}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Edit Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/editUserProfileAdminEdit/{{ $user_data->id }}" class="nav-link {{ Route::is('userProfileAdminEdit') ? 'active' : ''}}">
                  <i class="fas fa-user-edit"></i>
                  <p>&nbsp; Profile Info<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/editAdditionalInfoAdminEdit/{{ $user_data->id }}" class="nav-link {{ Route::is('additionalInfoAdminEdit') ? 'active' : ''}}">
                  <i class="fas fa-info-circle"></i>
                  <p>&nbsp; Add/Edit Additional Info<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addSkillsAdminEdit/{{ $user_data->id }}" class="nav-link {{ Route::is('addSkillsAdminEdit') ? 'active' : ''}}">
                  <i class="fas fa-chart-bar"></i>
                  <p>&nbsp; Add/Remove Skills<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addExperienceAdminEdit/{{ $user_data->id }}" class="nav-link {{ Route::is('addExperienceAdminEdit') ? 'active' : ''}}">
                  <i class="fas fa-briefcase"></i>
                  <p>&nbsp; Add/Remove Experience<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addEducationAdminEdit/{{ $user_data->id }}" class="nav-link {{ Route::is('addEducationAdminEdit') ? 'active' : ''}}">
                  <i class="fas fa-briefcase"></i>
                  <p>&nbsp; Add/Remove Education<br></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/addReferenceAdminEdit/{{ $user_data->id }}" class="nav-link {{ Route::is('addReferenceAdminEdit') ? 'active' : ''}}">
                  <i class="fas fa-id-card"></i>
                  <p>&nbsp; Add/Remove Refrence<br></p>
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
