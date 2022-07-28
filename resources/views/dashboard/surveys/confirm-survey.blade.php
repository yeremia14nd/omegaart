@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Konfirmasi Survei Selesai</h1>
</div>
<a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Daftar
    Survei</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/surveys/{{ $survey->id }}/confirmSurvey" class="mb-5"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Customer yang disurvei</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $survey->order->user->name)}}" disabled>
        </div>
        <div class="mb-3">
            <label for="product" class="form-label">Produk</label>
            <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product"
                value="{{ old('product', $survey->order->product->name)}}" disabled>
        </div>
        <div class="mb-3">
            <label for="surveyFile" class="form-label">Survei File</label>
            <input type="hidden" name="oldFile" value="{{ $survey->surveyFile }}">
            @if ($survey->surveyFile)
            <img src="{{ asset('storage/' . $survey->surveyFile) }}"
                class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control @error('surveyFile') is-invalid @enderror" type="file" id="image"
                name="surveyFile" onchange="previewImage()" multiple>
            @error('surveyFile')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Konfirmasi Survei Selesai</button>
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