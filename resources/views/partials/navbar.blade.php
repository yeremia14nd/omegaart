<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/"><img src="/img/logoOmega.png" class="d-inline-block align-top" alt="">
        OMEGA ART</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'home') ? 'active' : '' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'about') ? 'active' : '' }}" href="/about">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'contact') ? 'active' : '' }}" href="/contact">Kontak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'shop') ? 'active' : '' }}" href="/shop">Toko</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link {{ ($active === 'cart') ? 'active' : '' }}" href="/cart">Cart</a>
          </li> --}}
        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Welcome <span class="badge badge-light" id="unread" style="position: absolute;
                right: -15px;
                top: 8px;
                background: #ccc;
                color: #333;
                border-radius: 50%">0
              </span>, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/profil/{{ auth()->user()->userName }}"><i class="bi bi-person"></i>
                  Profil</a></li>
              <li><a class="dropdown-item" href="/cart"><i class="bi bi-bag"></i><span id="count"></span></a></li>
              <li><a class="nav-link dropdown-toggle dropdown-item" role="button" id="subMenuDropdown"
                  data-bs-target="collapse" aria-expanded="false" href="#collapseDropdown"
                  aria-controls="collapseDropdown"><i class="bi bi-bell"></i><span id="count_pemesanan"></span><i
                    class="bi bi-three-dots-vertical"></i>
                </a>
                <ul class="collapse dropdown-menu dropdown-submenu" id="collapseDropdown"
                  aria-labelledby="subMenuDropdown">
                  <li>
                    <a class="dropdown-item" href="/history">History</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/surveys"><span id="count_surveys"></span></a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/invoices"><span id="count_invoice"></span></a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/installments" id="count_installments">Pemasangan</a>
                  </li>
                </ul>
              </li>

              @canany(['superadmin','admin', 'estimator', 'teknisi'])
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window-reverse"></i>
                  Dashboard</a></li>
              @endcanany
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log Out</button>
                </form>
              </li>
            </ul>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'login') ? 'active' : '' }}" href="/login"><i
                class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
</header>