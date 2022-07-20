<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Omega Art | Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="/css/dashboard.css" rel="stylesheet">

  {{-- Font Awesome --}}
  <script src="https://kit.fontawesome.com/77607fceac.js" crossorigin="anonymous"></script>

  {{-- Trix Editor --}}
  <link rel="stylesheet" type="text/css" href="/css/trix.css">
  <script type="text/javascript" src="/js/trix.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>


  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display: none;
    }
  </style>
</head>

<body>

  @include('dashboard.layouts.header')

  <div class="container-fluid">
    <div class="row">
      @include('dashboard.layouts.sidebar')
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('container')
      </main>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function () {
    $.ajax({
      type: "GET",
      url: "/notif",
      dataType: "JSON",
      success: function (data) {
        if (data.unread == 0) {
          $('#unread_count').text(0);
        } else {
          $('#unread_count').text(data.unread);
        }

        $('#notification_list').html('');
        $.each(data.data, function (i, notif) {

          if (notif.read_status == 0) {
            if (notif.notif_kategori == 'checkout') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/checkout" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ada Transaksi Baru Menunggu Konfirmasi<span class="badge bg-secondary">New<span></h6>' +
                '<p>Ada pesanan baru yang menunggu untuk konfirmasi pembayaran.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'survey') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/survey" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ada Survey Baru Menunggu Konfirmasi<span class="badge bg-secondary">New<span></h6>' +
                '<p>Ada survey baru yang menunggu untuk konfirmasi.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'invoice') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/invoice" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ada Invoice Baru Untuk di Validasi<span class="badge bg-secondary">New<span></h6>' +
                '<p>Ada invoice baru menunggu untuk di validasi.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'invoice_order') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/invoice_order" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Pembayaran Invoice, Jadwalkan Produksi<span class="badge bg-secondary">New<span></h6>' +
                '<p>Pembayaran baru invoice, silahkan jadwalkan produksi.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'produksi') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/installments" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ajukan Jadwal Pemasangan<span class="badge bg-secondary">New<span></h6>' +
                '<p>Produksi selesai, atur jadwal pemasangan.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            }
          } else {
            if (notif.notif_kategori == 'checkout') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/checkout" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ada Transaksi Menunggu Konfirmasi</h6>' +
                '<p>Ada pesanan baru yang menunggu untuk konfirmasi pembayaran.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'survey') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/survey" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ada Survey Baru Menunggu Konfirmasi</h6>' +
                '<p>Ada survey baru yang menunggu untuk konfirmasi.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'invoice') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/invoice" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ada Invoice Baru Untuk di Validasi</h6>' +
                '<p>Ada invoice baru menunggu untuk di validasi.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'invoice_order') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/invoice_order" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Pembayaran Invoice, Jadwalkan Produksi</h6>' +
                '<p>Pembayaran baru invoice, silahkan jadwalkan produksi.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'produksi') {
              $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/installments" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Ajukan Jadwal Pemasangan</h6>' +
                '<p>Produksi selesai, atur jadwal pemasangan.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            }
          }
        });
      },
    });
  })

  $(document).ready(function () {
    $.ajax({
      type: "GET",
      url: "/notif_teknisi",
      dataType: "JSON",
      success: function (data) {
        if (data.unread == 0) {
          $('#teknisi_unread_count').text(0);
        } else {
          $('#teknisi_unread_count').text(data.unread);
        }

        $('#teknisi_notification_list').html('');
        $.each(data.data, function (i, notif) {

          if (notif.read_status == 0) {
            if (notif.notif_kategori == 'survey') {
              $('#teknisi_notification_list').append('<a href="/checkout_read/' + notif.id + '/survey" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Jadwal Survey Sudah Masuk<span class="badge bg-secondary">New<span></h6>' +
                '<p>Ada jadwal survey baru yang masuk.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'produksi') {
              $('#teknisi_notification_list').append('<a href="/checkout_read/' + notif.id + '/produksi" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Jadwal Baru Produksi<span class="badge bg-secondary">New<span></h6>' +
                '<p>Ada jadwal produksi baru yang masuk.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            }
          } else {
            if (notif.notif_kategori == 'survey') {
              $('#teknisi_notification_list').append('<a href="/checkout_read/' + notif.id + '/survey" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Jadwal Survey Sudah Masuk</h6>' +
                '<p>Ada jadwal survey baru yang masuk.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            } else if (notif.notif_kategori == 'produksi') {
              $('#teknisi_notification_list').append('<a href="/checkout_read/' + notif.id + '/produksi" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Jadwal Baru Produksi</h6>' +
                '<p>Ada jadwal produksi baru yang masuk.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            }
          }
        });
      },
    });
  })

  $(document).ready(function () {
    $.ajax({
      type: "GET",
      url: "/notif_estimator",
      dataType: "JSON",
      success: function (data) {
        if (data.unread == 0) {
          $('#estimator_unread_count').text(0);
        } else {
          $('#estimator_unread_count').text(data.unread);
        }

        $('#estimator_notification_list').html('');
        $.each(data.data, function (i, notif) {

          if (notif.read_status == 0) {
            if (notif.notif_kategori == 'invoice') {
              $('#estimator_notification_list').append('<a href="/checkout_read/' + notif.id + '/invoice" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Buat Invoice Untuk Survey Baru<span class="badge bg-secondary">New<span></h6>' +
                '<p>Buat invoice baru untuk data survey yang baru masuk.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            }
          } else {
            if (notif.notif_kategori == 'invoice') {
              $('#estimator_notification_list').append('<a href="/checkout_read/' + notif.id + '/invoice" class="dropdown-item">' +
                '<div class="profile_link">' +
                '<div class="pd_content">' +
                '<h6>Buat Invoice Untuk Survey Baru</h6>' +
                '<p>Buat invoice baru untuk data survey yang baru masuk.</strong>.</p>' +
                '</div>' +
                '<div><hr class="dropdown-divider"></div>' +
                '</div>' +
                '</a>');
            }
          }
        });
      },
    });
  })
  </script>
  <script src="/js/dashboard.js"></script>
  <script src="/js/autoNumeric.min.js"></script>
  <script>
    const price = new AutoNumeric('#price', {
    decimalPlaces: '0',
    decimalCharacter: ',',
    digitGroupSeparator: '.'
  });  
  
  </script>
</body>

</html>