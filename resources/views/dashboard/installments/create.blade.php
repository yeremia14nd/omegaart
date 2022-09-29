@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Jadwal Pemasangan</h1>
</div>
<a href="/dashboard/installments" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke
    Daftar
    Pemasangan</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/installments" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="production_id" class="form-label">Nama Produksi Yang Selesai</label>
            <select class="form-select @error('production_id') is-invalid @enderror" name="production_id"
                id="production_id">
                <option value="" class="text-muted">Pilih produksi...</option>
                @foreach ($productions as $production)
                @if (old('production_id') == $production->id)
                <option value="{{ $production->id }}" selected>{{ $production->order->product->name }} </option>
                @else
                <option value="{{ $production->id }}">{{ $production->order->product->name }} </option>
                @endif
                @endforeach
            </select>
            @error('production_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="customer" class="form-label">Nama Customer</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer"
                name="customer" value="{{ old('customer')}}" readonly>
            <input type="hidden" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id"
                value="{{ old('user_id')}}" readonly>

        </div>
        <label for="start_installment" class="form-label">Tanggal Mulai Pemasangan</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control @error('start_installment') is-invalid @enderror"
                id="start_installment" name="start_installment"
                placeholder=" @error('start_installment') {{ $message }} @enderror "
                value="{{ old('start_installment') }}">
            @error('start_installment')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="start_installment_time" class="form-label">Waktu Mulai Pemasangan</label>
        <div class="input-group mb-3">
            <input type="time" class="form-control @error('start_installment_time') is-invalid @enderror"
                id="start_installment_time" name="start_installment_time"
                placeholder=" @error('start_installment_time') {{ $message }} @enderror "
                value="{{ old('start_installment_time') }}">
            @error('start_installment_time')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="worker" class="form-label">Teknisi pemasangan</label>
            <select class="form-select @error('worker') is-invalid @enderror" name="worker">
                <option value="" class="text-muted">Pilih Teknisi</option>
                @foreach ($workers as $worker)
                @if (old('worker') == $worker->name)
                <option value="{{ $worker->name }}" selected>{{ $worker->name }}</option>
                @else
                <option value="{{ $worker->name }}">{{ $worker->name }}</option>
                @endif
                @endforeach
            </select>
            @error('worker')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="address" class="form-label">Alamat Pemasangan</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror " value="{{ old('address') }}" readonly>
        </div>
        {{-- <label for="city" class="form-label">Kota</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                placeholder=" @error('city') {{ $message }} @enderror " value="{{ old('city') }}" readonly>
        </div> --}}
        <button type="submit" class="btn btn-primary">Buat Jadwal Pemasangan</button>
    </form>
</div>

<script>
    const production_id = document.querySelector('#production_id');
    const customer = document.querySelector('#customer');       
    const address = document.querySelector('#address');       

    production_id.addEventListener('change', function() {
        fetch('/dashboard/installments/checkProduction?production_id=' + production_id.value)
            .then(response => response.json())
            .then(data => [
            customer.value = data.name,                                  
            user_id.value = data.user_id,                                  
            address.value = data.address,                                  
            // city.value = data.city,                                  
         ])        
    }); 
    
    
</script>
@endsection