@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Konfirmasi Pemasangan Selesai</h1>
</div>
<a href="/dashboard/installments" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke
    Daftar
    Pemasangan</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/installments/{{ $installment->id }}/confirmInstallment" class="mb-5"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="production_id" class="form-label">Nama Produksi Yang Selesai</label>
            <input type="text" class="form-control @error('production_id') is-invalid @enderror" id="production_id"
                name="production_id" value="{{ old('production_id', $installment->production->order->product->name)}}"
                readonly>
        </div>
        @error('production_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="customer" class="form-label">Nama Customer</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer"
                name="production_id" value="{{ old('production_id', $installment->production->order->user->name)}}"
                name="customer" value="{{ old('customer', )}}" readonly>

        </div>
        <label for="is_installed" class="form-label">Status Pemasangan</label>
        <select class="form-select mb-3" @error('is_installed') is-invalid @enderror" id="is_installed"
            name="is_installed">
            <option value='0' @if (old('is_installed', $installment->is_installed) == 0)
                selected @endif>Belum
                terpasang
            </option>
            <option value='1' @if (old('is_installed', $installment->is_installed) == 1)
                selected
                @endif>Sudah terpasang
            </option>
        </select>
        <div class="mb-3">
            <label for="file_asset" class="form-label">Gambar Pemasangan</label>
            <input type="hidden" name="oldFile" value="{{ $installment->file_asset }}">
            @if ($installment->file_asset)
            <img src="{{ asset('storage/' . $installment->file_asset) }}"
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
        <button type="submit" class="btn btn-primary">Konfirmasi Pemasangan</button>
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