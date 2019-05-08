
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
        <div class="sidebar-brand-text mx-3">FitBite</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('/admin/dashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>


      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePlans" aria-expanded="true" aria-controls="collapsePlans">
          <i class="fas fa-fw fa-folder"></i>
          <span>Meal Plans</span>
        </a>
        <div id="collapsePlans" class="collapse" aria-labelledby="headingPlans" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/admin/meal-plan/add">Create new plan</a>
            <a class="collapse-item" href="/admin/meal-plan/all">All plans</a>
          </div>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/admin/page/add">Create new page</a>
            <a class="collapse-item" href="/admin/page/all">All pages</a>
          </div>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseBlogs" aria-expanded="true" aria-controls="collapseBlogs">
          <i class="fas fa-fw fa-folder"></i>
          <span>Blogs</span>
        </a>
        <div id="collapseBlogs" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/admin/blog/add">Create new blog</a>
            <a class="collapse-item" href="/admin/blog/all">All blogs</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Orders</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/user/all">
          <i class="fas fa-fw fa-user"></i>
          <span>Users</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-cog"></i>
          <span>Site informations</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
