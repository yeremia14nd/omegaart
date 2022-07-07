<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>OMEGA ART | {{ $title }}</title>

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  {{-- Bootstrap Icon --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

  {{-- My Style --}}
  <link rel="stylesheet" href="/css/style.css">
  <script src="https://kit.fontawesome.com/77607fceac.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
          integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
          integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
          crossorigin="anonymous"></script>
</head>


<body>
@include('partials.navbar')
<main>
  <div class="mt-5 pt-3">
    @yield('container')
  </div>
  <!-- FOOTER -->

  <footer class="py-5 mt-5" style="background-color: #DB9955; color:white">
    <div class="container">
      <div class="">
        <div class="row justify-content-between">
          <div class="col-md-4">
            <h2>OMEGA ART</h2>
            <p>Omega Art merupakan perusahaan yang bergerak dibidang pengerjaan dan pemasangan produk
              interior dan eksterior untuk bangunan anda..</p>
          </div>
          <div class="col-2">
            <h5>Links</h5>
            <ul class="list-unstyled d-flex">
              <li class="ms-2"><a class="link-light" href="https://www.instagram.com/omegaart48/" target="_blank"><i
                    class="bi bi-instagram"></i></a></li>
              <li class="ms-2"><a class="link-light"
                                  href="https://www.facebook.com/aluminiumkacagordenminimalislasercuttingmurah"
                                  target="_blank"><i
                    class="bi bi-facebook"></i></a></li>
            </ul>
          </div>
          <div class="d-flex py-4 my-4 border-top">
            <p>&copy; 2022 CV.OMEGA ART. All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function () {
        $.ajax({
          type: "GET",
          url: "/total_cart",
          dataType: "JSON",
          success: function (data) {
            if (data.total == 0) {
              $('#count').text(' Cart');
            } else {
              $('#count').text(' ' + data.total + ' Cart');
            }
          },
        });

        $.ajax({
          type: "GET",
          url: "/total_surveys",
          dataType: "JSON",
          success: function (data) {
            if (data.total == 0) {
              $('#count_surveys').text(' Survey');
            } else {
              $('#count_surveys').text(' ' + data.total + ' Surveys');
            }
          },
        });

        $.ajax({
          type: "GET",
          url: "/total_invoice",
          dataType: "JSON",
          success: function (data) {
            if (data.total == 0) {
              $('#count_invoice').text(' Invoice');
            } else {
              $('#count_invoice').text(' ' + data.total + ' Invoice');
            }
          },
        });

        $.ajax({
          type: "GET",
          url: "/total_pemesanan",
          dataType: "JSON",
          success: function (data) {
            if (data == 0) {
              $('#count_pemesanan').text(' Status Pemesanan');
            } else {
              $('#count_pemesanan').text(' ' + data + ' Status Pemesanan');
            }
          },
        });

        $.ajax({
          type: "GET",
          url: "/notif_customer",
          dataType: "JSON",
          success: function (data) {
            if (data.unread == 0) {
              $('#unread').text(0);
            } else {
              $('#unread').text(data.unread);
            }
            // console.log('test');

            // $('#notification_list').html('');
            // $.each(data.data, function (i, notif) {
            //
            //   if (notif.read_status == 0) {
            //     if (notif.notif_kategori == 'checkout') {
            //       $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/checkout" class="dropdown-item">' +
            //         '<div class="profile_link">' +
            //         '<div class="pd_content">' +
            //         '<h6>Ada Transaksi Baru Menunggu Konfirmasi<span class="badge bg-secondary">New<span></h6>' +
            //         '<p>Ada pesanan baru yang menunggu untuk konfirmasi pembayaran.</strong>.</p>' +
            //         '</div>' +
            //         '<div><hr class="dropdown-divider"></div>' +
            //         '</div>' +
            //         '</a>');
            //     } else if (notif.notif_kategori == 'survey') {
            //       $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/survey" class="dropdown-item">' +
            //         '<div class="profile_link">' +
            //         '<div class="pd_content">' +
            //         '<h6>Ada Survey Baru Menunggu Konfirmasi<span class="badge bg-secondary">New<span></h6>' +
            //         '<p>Ada survey baru yang menunggu untuk konfirmasi.</strong>.</p>' +
            //         '</div>' +
            //         '<div><hr class="dropdown-divider"></div>' +
            //         '</div>' +
            //         '</a>');
            //     }
            //   } else {
            //     if (notif.notif_kategori == 'checkout') {
            //       $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/checkout" class="dropdown-item">' +
            //         '<div class="profile_link">' +
            //         '<div class="pd_content">' +
            //         '<h6>Ada Transaksi Menunggu Konfirmasi</h6>' +
            //         '<p>Ada pesanan baru yang menunggu untuk konfirmasi pembayaran.</strong>.</p>' +
            //         '</div>' +
            //         '<div><hr class="dropdown-divider"></div>' +
            //         '</div>' +
            //         '</a>');
            //     } else if (notif.notif_kategori == 'survey') {
            //       $('#notification_list').append('<a href="/checkout_read/' + notif.id + '/survey" class="dropdown-item">' +
            //         '<div class="profile_link">' +
            //         '<div class="pd_content">' +
            //         '<h6>Ada Survey Baru Menunggu Konfirmasi</h6>' +
            //         '<p>Ada survey baru yang menunggu untuk konfirmasi.</strong>.</p>' +
            //         '</div>' +
            //         '<div><hr class="dropdown-divider"></div>' +
            //         '</div>' +
            //         '</a>');
            //     }
            //   }
            // });
          },
        });
      })
    </script>

  </footer>

  {{-- <script src="/js/omegaart.js"></script> --}}
</main>


@yield('javascript')
</body>

</html>
