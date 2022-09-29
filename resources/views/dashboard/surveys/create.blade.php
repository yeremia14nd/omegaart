@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Survei Baru</h1>
</div>
<a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Semua
    Survei</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/surveys" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Nama Produk Order</label>
            <select class="form-select @error('order_id') is-invalid @enderror" name="order_id" id="order_id">
                <option value="" class="text-muted">Pilih Produk Order...</option>
                @foreach ($orders as $order)
                @if (old('order_id') == $order->id)
                <option value="{{ $order->id }}" selected>{{ $order->product->name }} </option>
                @else
                <option value="{{ $order->id }}">{{ $order->product->name }} </option>
                @endif
                @endforeach
            </select>
            @error('order_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="customer" class="form-label">Nama Customer</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer"
                name="customer" value="{{ old('customer')}}" readonly>

        </div>
        @error('customer')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email')}}" readonly>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="phoneNumber" class="form-label">Telepon</label>
        <div class="input-group mb-3">
            <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                name="phoneNumber" placeholder=" @error('phoneNumber') {{ $message }} @enderror "
                value="{{ old('phoneNumber') }}">
        </div>
        <label for="address" class="form-label">Alamat Survey</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror " value="{{ old('address') }}">
        </div>

        {{-- <label for="city" class="form-label">Kota</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                placeholder=" @error('city') {{ $message }} @enderror " value="{{ old('city') }}">
        </div> --}}
        <label for="surveyDate" class="form-label">Tanggal Survei</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control @error('surveyDate') is-invalid @enderror" id="surveyDate"
                name="surveyDate" placeholder=" @error('surveyDate') {{ $message }} @enderror "
                value="{{ old('surveyDate') }}">
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
        <label for="description" class="form-label">Deskripsi Survei</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder=" @error('description') {{ $message }} @enderror "
                value="{{ old('description') }}">
        </div>
        <div class="mb-3">
            <label for="assignTo" class="form-label">Surveyor yang Bertugas</label>
            <select class="form-select @error('assignTo') is-invalid @enderror" name="assignTo">
                <option value="" class="text-muted">Pilih surveyor...</option>
                @foreach ($assigns as $assignRole)
                @if (old('assignRole') == $assignRole->name)
                <option value="{{ $assignRole->name }}" selected>{{ $assignRole->name }}</option>
                @else
                <option value="{{ $assignRole->name }}">{{ $assignRole->name }}</option>
                @endif
                @endforeach
            </select>
            @error('assignTo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Tambah Survei</button>
    </form>
</div>

<script>
    const order_id = document.querySelector('#order_id');
    const customer = document.querySelector('#customer');
    const email = document.querySelector('#email');
    const address = document.querySelector('#address');
    const phoneNumber = document.querySelector('#phoneNumber');

    order_id.addEventListener('change', function() {
        fetch('/dashboard/surveys/checkOrder?order_id=' + order_id.value)
            .then(response => response.json())
            .then(data => [
            customer.value = data.name, 
            email.value = data.email,
            address.value = data.address,
            phoneNumber.value =  data.phoneNumber,
         ])        
    });
</script>
@endsection