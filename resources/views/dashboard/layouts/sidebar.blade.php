<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} {{ Request::is('dashboard/profile') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Profile
          </a>
        </li>
        @can('organization')
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Posts
          </a>
        </li>
        @endcan
      </ul>

      @can('admin')
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center text-muted px-3 mt-4 mb-1">
        ADMINISTRATOR
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Students
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/organization*') ? 'active' : '' }}" href="/dashboard/organization">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Organizations
          </a>
        </li>
      </ul>
      @endcan
    
  </div>
  </nav>