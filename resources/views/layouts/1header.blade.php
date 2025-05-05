<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body shadow-sm">
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <!-- Sidebar Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list fs-5"></i>
                </a>
            </li>
            <!-- Sidebar Toggle & Brand -->
          <div class="d-flex align-items-center">
              <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse">
                  <i class="bi bi-list text-white"></i>
              </button>
              <a class="navbar-brand fw-bold d-none d-md-block" href="{{ url('/dashboard') }}">
                  <i class="bi bi-droplet-half me-2"></i>HydroGuard
              </a>
          </div>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto align-items-center">
            <!--begin::Authentication / User Menu-->
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
                <!-- User Avatar & Dropdown -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Avatar with initials -->
                        <div class="bg-primary text-white rounded-circle text-center" style="width: 35px; height: 35px; line-height: 35px; font-weight: bold;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="d-none d-md-inline fw-semibold">{{ Auth::user()->name }}</span>
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                        <h6 class="dropdown-header">Account</h6>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person-circle me-2"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            <!--end::Authentication / User Menu-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->

