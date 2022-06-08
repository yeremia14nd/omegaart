<style>
  .dropdown-toggle::after {
    display: none;
  }
</style>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">OMEGA ART</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="nav justify-content-end">
    <li class="nav-item dropdown">
      <a href="#" class="nav-link dropdown-toggle" role="button" id="dropdownNotif" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell fa-2x mt-3 mr-2"></i>
        <span
          class="badge badge-light"
          id="unread_count"
          style="position: absolute;
                 right: -7px;
                 top: 8px;
                 background: #ccc;
                 color: #333;
                 border-radius: 50%">
          0
        </span>
      </a>
      <ul class="dropdown-menu" id="notification_list">
        <li><a href="#" class="dropdown-item">
          <div class="profile_link">
            <div class="pd_content">
              <h6>ADA PEMBAYARAN BARU</h6>
              <p>Ada Pembayaran Siswa telah diupdate, Cek dengan klik disini!</strong>.</p>
              <span class="nm_time">2 min ago</span>
            </div>
          </div>
        </a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Separated link</a></li>
      </ul>
    </li>
  </ul>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <form action="/logout" method="post">
        @csrf
        <button type="submit" class="nav-link px-3 bg-dark border-0">Logout <span
            data-feather="log-out"></span></button>
      </form>
    </div>
  </div>
</header>
