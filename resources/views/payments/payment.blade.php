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
  @if(count($errors) > 0)
  @foreach($errors->all() as $error)
  <div class="alert alert-warning">{{ $error }}</div>
  @endforeach
  @endif
  @if ($message = Session::get('error'))
  <div class="alert alert-warning">
    <p>{{ $message }}</p>
  </div>
  @endif
  @if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
  @endif
  <form action="{{ route('checkout.payment', $id_checkout) }}" class="form-horizontal" method="post"
    enctype="multipart/form-data">
    @method('patch')
    @csrf()
    <div class="row pr-4">
      <div class="col-6 py-4">
        <div class="form-section">
          <h5 class="mb-3">Informasi Kontak</h5>
          <input type="text" class="form-control" placeholder="Email address" value="{{ $users->email }}">
        </div>
        <div class="form-section">
          <h5 class="mb-3">Alamat Pengiriman</h5>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" placeholder="First Name">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" placeholder="Last Name">
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Address">
          </div>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" name="provinsi" placeholder="Provinsi">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" name="kota" placeholder="Kota">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan / Kecamatan">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" name="kodepos" placeholder="Kode Pos">
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="No Telpon">
          </div>
        </div>
        <div class="form-section">
          <h5 class="mb-3">Keranjang</h5>
          <div class="cart">
            @foreach($cart_item->detail as $detail)
            <div class="product d-flex w-100">
              <img src="{{ asset('storage/' . $detail->product->imageAssets) }}" alt="">
              <div class="d-flex flex-column flex-md-row justify-content-md-between w-100">
                <div class="description d-flex flex-column">
                  <p class="title">{{ $detail->product->name }}</p>
                  <span class="qty">Qty : {{ $detail->quantity }}</span>
                </div>
                <p class="price">Rp. {{ number_format($detail->price, 2) }}</p>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-6" style="background: #f8f8f8; height: 100%">
        <div id="countdown">
        </div>
        <div class="m-4">
          <h5 class="mb-3">Ringkasan Order</h5>
          <div class="ringkasan d-flex flex-column">
            <div class="information d-flex justify-content-between">
              <p>Total Biaya</p>
              <b>Rp. {{ number_format($cart_item->total) }},-</b>
            </div>
          </div>
          <hr class="my-4">
          <div class="payment-options">
            <h5 class="mb-3">Pembayaran</h5>
            <div class="my-3">
              <input type="radio" name="payment" value="bank_transfer" class="mr-2" checked> Bank Transfer
            </div>
            <div class="table-responsive">
              <h5>Bank Transfer</h5>
              <h6>Bank BCA :</h6>
              <table class="table table-sm">
                <tr>
                  <td><strong>01234567000</strong></td>
                  <td>: An. CV.OMEGA ART</td>
                </tr>
              </table>
              <small>*Silahkan upload bukti Transfer. Admin akan mengecek
                dan
                konfirmasi pembayaran untuk dilakukan proses pengiriman produk</small>
            </div>
            {{-- <div class="my-3">
              <input type="radio" name="payment" value="credit_card" class="mr-2"> Credit Card
            </div>
            <div class="my-3">
              <input type="radio" name="payment" value="shopee_pay" class="mr-2"> Shopee Pay
            </div>
            <div class="my-3">
              <input type="radio" name="payment" value="gopay" class="mr-2"> GOPAY
            </div> --}}
          </div>
          <hr class="my-4">
          <div>
            <label class="mb-3">Upload Bukti Pembayaran</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input type="file" name="bukti_pembayaran" class="form-control" id="image" onchange="previewImage()">
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-4" style="width: 100%">Checkout</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section('javascript')
<script>
  CountDownTimer('{{$checkout->created_at}}', 'countdown');
  function CountDownTimer(dt, id)
  {
    var end = new Date('{{$checkout->pay_until}}');
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    function showRemaining() {
      var now = new Date();
      var distance = end - now;
      if (distance < 0) {

        clearInterval(timer);
        document.getElementById(id).innerHTML = '<b>Pembayaran Sudah Tidak Valid</b> ';
        return;
      }
      var days = Math.floor(distance / _day);
      var hours = Math.floor((distance % _day) / _hour);
      var minutes = Math.floor((distance % _hour) / _minute);
      var seconds = Math.floor((distance % _minute) / _second);

      document.getElementById(id).innerHTML ='<h5>Silahkan Bayar Sebelum ' + hours + ' Jam ' + minutes + ' Menit ' + seconds + ' Detik' + '</h5>';
    }
    timer = setInterval(showRemaining, 1000);
  }

  function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection