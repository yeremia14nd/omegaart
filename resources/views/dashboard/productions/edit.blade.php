@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Perbaharui Produksi</h1>
</div>
<a href="/dashboard/productions" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Daftar
    Produksi</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/productions/{{ $production->id }}" class="mb-5"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Nama Produk Order</label>
            <input type="text" class="form-control @error('order_id') is-invalid @enderror" id="order_id"
                name="order_id" value="{{ old('order_id', $production->order->product->name)}}" readonly>
        </div>
        <div class="mb-3">
            <label for="customer" class="form-label">Nama Customer</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer"
                name="customer" value="{{ old('customer', $production->order->user->name)}}" readonly>

        </div>
        <label for="start_production" class="form-label">Tanggal Mulai Produksi</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control @error('start_production') is-invalid @enderror"
                id="start_production" name="start_production"
                placeholder=" @error('start_production') {{ $message }} @enderror "
                value="{{ old('start_production', $production->start_production) }}" required>
        </div>
        <label for="work_duration" class="form-label">Durasi Produksi (cth: 14 hari kerja)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('work_duration') is-invalid @enderror" id="work_duration"
                name="work_duration" placeholder=" @error('work_duration') {{ $message }} @enderror "
                value="{{ old('work_duration', $production->work_duration) }}" required>
            <div class="input-group-append">
                <span class="input-group-text">Hari Kerja</span>
            </div>
        </div>
        <div class="mb-3">
            <label for="surveyor" class="form-label">Nama Surveyor</label>
            <input type="text" class="form-control @error('surveyor') is-invalid @enderror" id="surveyor"
                name="worker_name" value="{{ old('surveyor', $surveyor)}}" readonly>

        </div>
        <div class="mb-3">
            <label for="worker_name" class="form-label">Teknisi Produksi</label>
            <select class="form-select @error('worker_name') is-invalid @enderror" name="worker_name" required>
                <option value="" class="text-muted">Pilih Teknisi</option>
                @foreach ($workers as $worker)
                @if (old('worker_name', $production->worker_name) == $worker->name)
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
        <label for="isFinished" class="form-label">Status Produksi</label>
        <select class="form-select mb-3" @error('isFinished') is-invalid @enderror" id="isFinished" name="isFinished">
            <option value='0' @if (old('isFinished', $production->isFinished) == 0)
                selected @endif>Belum
                selesai produksi
            </option>
            <option value='1' @if (old('isFinished', $production->isFinished) == 1)
                selected
                @endif>Sudah selesai Produksi
            </option>
        </select>
        <div class="mb-3">
            <label for="file_asset" class="form-label">Foto Produksi</label>
            <input type="hidden" name="oldFile" value="{{ $production->file_asset }}">
            @if ($production->file_asset)
            <img src="{{ asset('storage/' . $production->file_asset) }}"
                class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control @error('file_asset') is-invalid @enderror" type="file" id="image"
                name="file_asset" onchange="previewImage()" multiple>
            @error('file_asset')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Produksi</button>
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