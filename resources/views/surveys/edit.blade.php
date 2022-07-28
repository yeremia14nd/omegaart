@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Perubahan Jadwal Survei</h1>
        </div>
        <div class="d-flex justify-content-center">
            <a href="/surveys/" class="btn btn-outline-danger px-5">
                <span data-feather="arrow-left"></span> Batal
            </a>
        </div>
        <div class="col-lg-6">
            <form method="post" action="/surveys/{{ $survey->id }}" class="mb-5">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="product" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('product') is-invalid @enderror " id="product"
                        name="product" value="{{ $survey->order->product->name }}" readonly>
                    @error('product')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Customer</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name"
                        autofocus value="{{ old('name', $survey->order->user->name) }}" readonly>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <label for="address" class="form-label">Alamat untuk Survei</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Address</span>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" placeholder=" @error('address') {{ $message }} @enderror "
                        value="{{ old('address', $survey->address) }}">
                </div>
                <label for="city" class="form-label">Kota</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                        value="{{ old('city', $survey->city) }}">
                    @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="phoneNumber" class="form-label">Telepon</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control @error('phoneNumber') is-invalid @enderror"
                        id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $survey->phoneNumber) }}">
                    @error('phoneNumber')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="surveyDate" class="form-label">Tanggal Survei</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control @error('surveyDate') is-invalid @enderror" id="surveyDate"
                        name="surveyDate" value="{{ old('surveyDate', $survey->surveyDate) }}">
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
                        value="{{ old('surveyTime', $survey->surveyTime) }}">
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
                        value="{{ old('description', $survey->description) }}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-lg-6">Perbaharui Jadwal Survei</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection