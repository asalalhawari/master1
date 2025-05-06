<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{ asset('index.html') }}"><img src="{{ asset('assets/images/logo.svg') }}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="{{ asset('index.html') }}"><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
  </div>
  <ul class="nav">
      <li class="nav-item profile">
          <div class="profile-desc">
              <div class="profile-pic">
                  <div class="count-indicator">
                     <img class="img-xs rounded-circle"
     src="{{ Auth::check() && Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : asset('assets/images/faces/face15.jpg') }}"
     alt="Profile Picture">
                      <span class="count bg-success"></span>
                  </div>
                  <div class="profile-name">
                    <h5 class="mb-0 font-weight-normal" style="color: white">
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </h5>
                                          <span>Admin</span>
                  </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">


              </div>
          </div>
      </li>
      <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items">
          <a class="nav-link" href="{{ url('/dash') }}">
              <span class="menu-icon">
                  <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>

      <li class="nav-item menu-items">
          <a class="nav-link" href="{{ url('/appointments') }}">
              <span class="menu-icon">
                  <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Appointments</span>
          </a>
      </li>
      <li class="nav-item menu-items">
          <a class="nav-link" href="{{ url('/users') }}">
              <span class="menu-icon">
                  <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Users</span>
          </a>
      </li>
      <li class="nav-item menu-items">
          <a class="nav-link" href="{{ url('/services') }}">
              <span class="menu-icon">
                  <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Services</span>
          </a>
      </li>
      <li class="nav-item menu-items" id="admin-management" style="display: {{ Auth::check() && Auth::user()->role === 'super_admin' ? 'block' : 'none' }}">
        <a class="nav-link" href="{{ url('/admin-management') }}">
            <span class="menu-icon">
                <i class="mdi mdi-account-key"></i>
            </span>
            <span class="menu-title">Admin Management</span>
        </a>
    </li>

      <li class="nav-item menu-items">
          <a class="nav-link" href="{{ url('/contacts') }}">
              <span class="menu-icon">
                  <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Contact us</span>
          </a>
      </li>

  </ul>
</nav>
