@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Konfirmasi Surveyor Bertugas</h1>
</div>
<a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Daftar
    Survei</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/surveys/{{ $survey->id }}/confirmSurveyor" class="mb-5"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Customer yang disurvei</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $survey->order->user->name)}}" disabled>
        </div>
        <div class="mb-3">
            <label for="product" class="form-label">Produk yang disurvei</label>
            <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product"
                value="{{ old('product', $survey->order->product->name)}}" disabled>
        </div>
        <div class="mb-3">
            <label for="assignTo" class="form-label">Surveyor yang Bertugas</label>
            <select class="form-select @error('assignTo') is-invalid @enderror" name="assignTo" autofocus required>
                <option value="">Pilih Surveyor</option>
                @foreach ($assigns as $assignRole)
                @if (old('assignTo', $survey->assignTo) == $assignRole->name)
                <option value="{{ $assignRole->name }}" selected>{{ $assignRole->name }}</option>
                @else
                <option value="{{ $assignRole->name }}">{{ $assignRole->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        @error('assignTo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <button type="submit" class="btn btn-primary">Konfirmasi Surveyor</button>
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