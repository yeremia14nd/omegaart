@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Konfirmasi Pembayaran</h1>
</div>
<a href="/dashboard/payments" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Semua
    Pembayaran</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/payments/{{ $payment->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Customer yang membayar</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $payment->user->name)}}" readonly>
        </div>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="product" class="form-label">Produk</label>
            <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product"
                value="{{ old('product', $payment->invoice->order->product->name)}}" readonly>
            @error('product')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        @error('product_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="has_paid_down_payment" class="form-label">Pembayaran Down Payment</label>
        <select class="form-select mb-3" @error('has_paid_down_payment') is-invalid @enderror"
            id="has_paid_down_payment" name="has_paid_down_payment">
            <option value='0' @if (old('has_paid_down_payment', $payment->has_paid_down_payment) == 0)
                selected @endif>Belum
                DP
            </option>
            <option value='1' @if (old('has_paid_down_payment', $payment->has_paid_down_payment) == 1)
                selected
                @endif>Sudah DP
            </option>
        </select>
        <label for="has_paid_full" class="form-label">Pembayaran Full</label>
        <select class="form-select mb-3" @error('has_paid_full') is-invalid @enderror" id="has_paid_full"
            name="has_paid_full">
            <option value='0' @if (old('has_paid_full', $payment->has_paid_full) == 0)
                selected @endif>Belum
                Lunas
            </option>
            <option value='1' @if (old('has_paid_full', $payment->has_paid_full) == 1)
                selected
                @endif>Sudah Lunas
            </option>
        </select>
        <label for="is_confirmed" class="form-label">Konfirmasi Bukti Tranfer</label>
        <select class="form-select mb-3" @error('is_confirmed') is-invalid @enderror" id="is_confirmed"
            name="is_confirmed">
            <option value='0' @if (old('is_confirmed', $payment->is_confirmed) == 0)
                selected @endif>Belum
                dikonfirmasi
            </option>
            <option value='1' @if (old('is_confirmed', $payment->is_confirmed) == 1)
                selected
                @endif>Sudah dikonfirmasi
            </option>
        </select>
        <label for="description" class="form-label">Deskripsi Pembayaran</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder=" @error('description') {{ $message }} @enderror "
                value="{{ old('description', $payment->description) }}" readonly>
        </div>
        <div class="mb-3">
            <label for="image_asset" class="form-label">File Pembayaran</label>
            @if ($payment->image_asset)
            <img src="{{ asset('storage/' . $payment->image_asset) }}"
                class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            @error('image_asset')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
    </form>
</div>

<script>
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