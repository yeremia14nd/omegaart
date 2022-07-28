<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>

    </ul>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
      <span>Administrator -
        @if (Auth::user()->role_id === 1)
        Super Admin
        @elseif(Auth::user()->role_id === 2)
        Admin
        @elseif(Auth::user()->role_id === 3)
        Estimator
        @elseif(Auth::user()->role_id === 4)
        Teknisi
        @else
        Unauthorized
        @endif
      </span>
    </h6>
    <ul class="nav flex-column">
      @canany(['superadmin','admin'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/products*') ? 'active' : '' }}" href="/dashboard/products">
          <span data-feather="box"></span>
          Produk
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
          <span data-feather="grid"></span>
          Kategori Produk
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/customers*') ? 'active' : '' }}" href="/dashboard/customers">
          <span data-feather="users"></span>
          Daftar Customer
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
          <span data-feather="shopping-bag"></span>
          Order
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin', 'estimator', 'teknisi'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/surveys*') ? 'active' : '' }}" href="/dashboard/surveys">
          <span data-feather="map"></span>
          Survei
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin', 'estimator'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/invoices*') ? 'active' : '' }}" href="/dashboard/invoices">
          <span data-feather="file-text"></span>
          Invoice untuk Order
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin', 'estimator'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/payments*') ? 'active' : '' }}" href="/dashboard/payments">
          <span data-feather="credit-card"></span>
          Pembayaran Invoice Order
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin', 'estimator'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/confirmation*') ? 'active' : '' }}" href="/dashboard/confirmation">
          <span data-feather="credit-card"></span>
          Pembayaran Available Product
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin', 'estimator', 'teknisi'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/productions*') ? 'active' : '' }}" href="/dashboard/productions">
          <span data-feather="refresh-cw"></span>
          Produksi
        </a>
      </li>
      @endcanany
      @canany(['superadmin','admin', 'teknisi'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/installments*') ? 'active' : '' }}" href="/dashboard/installments">
          <span data-feather="check-circle"></span>
          Pemasangan
        </a>
      </li>
      @endcanany
      @canany(['superadmin'])
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/staffs*') ? 'active' : '' }}" href="/dashboard/staffs">
          <span data-feather="users"></span>
          Daftar Staf
        </a>
      </li>
      @endcanany
    </ul>
  </div>
</nav>