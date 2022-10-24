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

  .center {
    margin: auto;
    width: 50%;
    border: 3px;
    padding: 10px;
  }
</style>
<div class="container">
  <div class="row pr-4">
    <div class="col-6 center" style="background: #f8f8f8; height: 100%">
      <div class="m-4">
        @if($checkout->status == 1)
        <h5 class="mb-3" style="text-align: center">Menunggu Konfirmasi Pembayaran</h5>
        @elseif($checkout->status == 2)
        <h5 class="mb-3" style="text-align: center">Pembayaran Berhasil Dikonfirmasi</h5>
        @endif
        <h5 class="mb-3">Ringkasan Order</h5>
        <div class="ringkasan d-flex flex-column">
          <div class="information d-flex justify-content-between">
            <p>Total Biaya</p>
            <b>Rp. {{ number_format($checkout->cart->total, 2) }}</b>
          </div>
        </div>
        <h5 class="mb-3">Alamat Pengiriman</h5>
        <div class="ringkasan d-flex flex-column">
          <div class="information d-flex justify-content-between">
            <b>{{ $checkout->shipping_address }}</b>
          </div>
        </div>
        <hr class="my-4">
        <div class="payment-options">
          <h5 class="mb-3">Tipe Pembayaran</h5>
          <div class="ringkasan d-flex flex-column">
            <div class="information d-flex justify-content-between">
              @if($checkout->payment_type == 'bank_transfer')
              <b>Bank Transfer</b>
              @elseif($checkout->payment_type == 'credit_card')
              <b>Credit Card</b>
              @elseif($checkout->payment_type == 'Shopee Pay')
              <b>Shopee Pay</b>
              @elseif($checkout->payment_type == 'gopay')
              <b>Gopay</b>
              @endif
            </div>
          </div>
        </div>
        <hr class="my-4">
      </div>
    </div>
  </div>
</div>
@endsection