@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <form action="/orders/{{ $order->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger mb-3"
                onclick="return confirm('Apakah anda yakin ingin membatalkan survei?')"><span
                    data-feather="x-circle"></span> Batalkan Order untuk Survei</button>
        </form>
        @if (session()->has('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Jadwalkan Survei</h1>
        </div>

        <div class="col-lg-6">
            <form method="post" action="/surveys" class="mb-5">
                @csrf
                <input type="hidden" id="order_id" name="order_id" value="{{ $order->id }}">
                <div class="mb-3">
                    <label for="product" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('product') is-invalid @enderror " id="product"
                        name="product" value="{{ $product->name }}" readonly>
                    @error('product')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">nama Customer</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name"
                        autofocus value="{{ old('name', $user->name) }}" readonly>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $user->email) }}" readonly>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <label for="address" class="form-label">Alamat untuk Survei</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Alamat</span>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" placeholder=" @error('address') {{ $message }} @enderror "
                        value="{{ old('address', $user->address) }}">
                </div>
                <label for="city" class="form-label">Kota</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                        value="{{ old('city') }}"
                        placeholder="Kelurahan/Kecamatan, Kota (Contoh: Jatimulyo/Lowokwaru, Kota Malang)">
                    @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="phoneNumber" class="form-label">Telepon</label>
                <div class="input-group mb-3">
                    <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                        name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber) }}">
                    @error('phoneNumber')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="surveyDate" class="form-label">Tanggal Survei</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control @error('surveyDate') is-invalid @enderror" id="surveyDate"
                        name="surveyDate" value="{{ old('surveyDate') }}">
                    @error('surveyDate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="surveyTime" class="form-label">Waktu Survei</label>
                <div class="input-group mb-3">
                    <input type="time" class="form-control @error('surveyTime') is-invalid @enderror" id="surveyTime"
                        name="surveyTime" placeholder=" @error('surveyTime') {{ $message }} @enderror "
                        value="{{ old('surveyTime') }}">
                    @error('surveyTime')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" placeholder=" @error('description') {{ $message }} @enderror "
                        value="{{ old('description') }}"
                        placeholder="Hubungi saya ketika survei dan saya bisa disurvei siang hari saja">
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-lg-6">Buat Jadwal Survei</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection