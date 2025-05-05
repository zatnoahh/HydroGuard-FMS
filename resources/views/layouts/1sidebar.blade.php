<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!-- Sidebar Brand -->
  <div class="sidebar-brand text-center py-3">
    <a href="#" class="brand-link d-flex align-items-center justify-content-center">
      <img src="../../dist/assets/img/HFMS-Logo1.png" alt="HFMS Logo" class="brand-image opacity-75 shadow me-2 rounded-circle" />
      <span class="brand-text fw-light fs-5">HFMS</span>
    </a>
  </div>

  <!-- Sidebar Menu -->
  <div class="sidebar-wrapper">
    <nav class="mt-3">
      <ul class="nav flex-column sidebar-menu" data-lte-toggle="treeview" role="menu" data-accordion="false">
        
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon bi bi-house-door"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Water Level -->
        <li class="nav-item">
          <a href="{{ route('distance.index') }}" class="nav-link">
            <i class="nav-icon bi bi-droplet-half"></i>
            <p>Flood Alert</p>
          </a>
        </li>

        <!-- Relief Centers with treeview -->
        <li class="nav-item">
          <a href="{{ route('reliefCenters.index') }}" class="nav-link">
            <i class="nav-icon bi bi-building"></i>
            <p>Relief Centers</p>
          </a>
        </li>

        <!-- Safety Guideline -->
        <li class="nav-item">
          <a href="{{ route('safety_guidelines.index') }}" class="nav-link">
            <i class="nav-icon bi bi-signpost-2"></i>
            <p>Safety Guidelines</p>
          </a>
        </li>

        <!-- Manage Threshold -->
        <li class="nav-item">
          <a href="{{ route('threshold.index') }}" class="nav-link">
            <i class="nav-icon bi bi-sliders"></i>
            <p>Manage Threshold</p>
          </a>
        </li>

          <!-- User Safety Guidelines -->
        <li class="nav-item">
          <a href="{{ route('user.safety_guidelines.index') }}" class="nav-link">
            <i class="nav-icon bi bi-signpost"></i>
            <p>User Safety Guidelines</p>
          </a>
        </li>

        <!-- Admin Only -->
        @can('isAdmin')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-shield-lock"></i>
            <p>Users</p>
          </a>
        </li>
        @endcan

      </ul>
    </nav>
  </div>
</aside>
<!-- 
              <li class="nav-header">SETTING</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                  <p>
                    Auth
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-box-arrow-in-right"></i>
                      <p>
                        Version 1
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="./examples/login.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Login</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/register.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Register</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-box-arrow-in-right"></i>
                      <p>
                        Version 2
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Login</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/register-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Register</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="./examples/lockscreen.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Lockscreen</p>
                    </a>
                  </li>
                </ul>
              </li>
               -->