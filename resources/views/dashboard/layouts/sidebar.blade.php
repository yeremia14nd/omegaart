<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/products*') ? 'active' : '' }}" href="/dashboard/products">
          <span data-feather="box"></span>
          Products
        </a>
      </li>
    </ul>
    @canany(['superadmin','admin'])
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
      <span>Administrator</span>
    </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
          <span data-feather="grid"></span>
          Categories of Product
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/customers*') ? 'active' : '' }}" href="/dashboard/customers">
          <span data-feather="users"></span>
          Customers List
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
          <span data-feather="shopping-bag"></span>
          Orders
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/surveys*') ? 'active' : '' }}" href="/dashboard/surveys">
          <span data-feather="map"></span>
          Surveys
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/invoices*') ? 'active' : '' }}" href="/dashboard/invoices">
          <span data-feather="credit-card"></span>
          Invoices For Survey Order
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/staffs*') ? 'active' : '' }}" href="/dashboard/staffs">
          <span data-feather="users"></span>
          All Staff
        </a>
      </li>
    </ul>
    @endcanany
  </div>
</nav>