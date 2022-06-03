@extends('layouts.main')

@section('container')
  <style>
    .form-section {
      margin-top: 1rem;
      margin-bottom: 3rem;
    }

    input {
      padding: 10px 5px;
      font-size: 12px;
    }

    .form-group {
      margin-top: 2rem;
    }

    .cart .product {
      width: 100%;
      margin-bottom: 20px;
      color: #3F3A64;
    }

    .cart .product img {
      width: 75px;
      height: 75px;
      margin-right: 15px;
    }

    .cart .product .description .title {
      margin: 0;
      font-weight: 600;
    }

    .cart .product .description .qty {
      margin: 0;
      font-weight: 400;
    }
  </style>
  <div class="container">
    <form action="" class="form-horizontal">
      <div class="row">
          <div class="col-5 my-4">
            <div class="form-section">
              <h5 class="mb-3">Contact Information</h5>
              <input type="text" class="form-control" placeholder="Email address">
            </div>
            <div class="form-section">
              <h5 class="mb-3">Shipping Address</h5>
              <div class="form-group row">
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="First Name">
                </div>
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Last Name">
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Address">
              </div>
              <div class="form-group row">
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Provinsi">
                </div>
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Kota">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Kelurahan / Kecamatan">
                </div>
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Kode Pos">
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="No Telpon">
              </div>
            </div>
            <div class="form-section">
              <h5 class="mb-3">Keranjang</h5>
              <div class="cart">
                <div class="product d-flex w-100">
                  <img src="/" alt="">
                  <div class="d-flex flex-column flex-md-row justify-content-md-between w-100">
                    <div class="description d-flex flex-column">
                      <p class="title">Produk 1</p>
                      <span class="qty">Qty : 1</span>
                    </div>
                    <p class="price">Rp. 300.000</p>
                  </div>
                </div>
                <div class="product d-flex w-100">
                  <img src="/" alt="">
                  <div class="d-flex flex-column flex-md-row justify-content-md-between w-100">
                    <div class="description d-flex flex-column">
                      <p class="title">Produk 1</p>
                      <span class="qty">Qty : 1</span>
                    </div>
                    <p class="price">Rp. 300.000</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6" style="background: #ccc; height: 100%">
            <p>TEst</p>
          </div>
      </div>
    </form>
  </div>
@endsection