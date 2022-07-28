@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Produksi</h1>
</div>
@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif
<a href="/dashboard/productions" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Daftar
    Produksi</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/productions" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Nama Produk Order</label>
            <select class="form-select @error('order_id') is-invalid @enderror" name="order_id" id="order_id">
                <option value="" class="text-muted">Pilih produk order...</option>
                @foreach ($orders as $order)
                @if (old('order_id') == $order->id)
                <option value="{{ $order->id }}" selected>{{ $order->product->name }} </option>
                @else
                <option value="{{ $order->id }}">{{ $order->product->name }} </option>
                @endif
                @endforeach
            </select>
        </div>
        @error('order_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="customer" class="form-label">Nama Customer</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer"
                name="customer" value="{{ old('customer')}}" readonly>

        </div>
        <label for="start_production" class="form-label">Tanggal Mulai Produksi</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control @error('start_production') is-invalid @enderror"
                id="start_production" name="start_production"
                placeholder=" @error('start_production') {{ $message }} @enderror "
                value="{{ old('start_production') }}" required>
        </div>
        <label for="work_duration" class="form-label">Durasi Produksi (cth: 14 hari kerja)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('work_duration') is-invalid @enderror" id="work_duration"
                name="work_duration" placeholder=" @error('work_duration') {{ $message }} @enderror "
                value="{{ old('work_duration') }}" required>
            <div class="input-group-append">
                <span class="input-group-text">Hari Kerja</span>
            </div>
        </div>
        <div class="mb-3">
            <label for="surveyor" class="form-label">Nama Surveyor</label>
            <input type="text" class="form-control @error('surveyor') is-invalid @enderror" id="surveyor"
                name="worker_name" value="{{ old('surveyor')}}" readonly>

        </div>
        <div class="mb-3">
            <label for="worker_name" class="form-label">Teknisi Produksi</label>
            <select class="form-select @error('worker_name') is-invalid @enderror" name="worker_name" required>
                <option value="" class="text-muted">Pilih Teknisi</option>
                @foreach ($workers as $worker)
                @if (old('worker_name') == $worker->name)
                <option value="{{ $worker->name }}" selected>{{ $worker->name }}</option>
                @else
                <option value="{{ $worker->name }}">{{ $worker->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        @error('worker_name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <button type="submit" class="btn btn-primary">Buat Jadwal Produksi</button>
    </form>
</div>

<script>
    const order_id = document.querySelector('#order_id');
    const customer = document.querySelector('#customer');
    const surveyor = document.querySelector('#surveyor');
    const fileSurvey = document.querySelector('#fileSurvey');    

    order_id.addEventListener('change', function() {
        fetch('/dashboard/productions/checkOrder?order_id=' + order_id.value)
            .then(response => response.json())
            .then(data => [
            customer.value = data.name,             
            surveyor.value = data.surveyor,                         
         ])        
    }); 
</script>
@endsection