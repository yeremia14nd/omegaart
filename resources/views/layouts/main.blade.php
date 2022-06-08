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
                    href="https://www.facebook.com/aluminiumkacagordenminimalislasercuttingmurah" target="_blank"><i
                      class="bi bi-facebook"></i></a></li>
              </ul>
            </div>
            <div class="d-flex py-4 my-4 border-top">
              <p>&copy; 2022 CV.OMEGA ART. All rights reserved.</p>
            </div>
          </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
      </script>
    </footer>

    {{-- <script src="/js/omegaart.js"></script> --}}
  </main>



  @yield('javascript')
</body>

</html>