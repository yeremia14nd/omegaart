@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Perbaharui Survey</h1>
</div>
<a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Semua
    Survey</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/surveys/{{ $survey->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Customer yang disurvey</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $survey->order->user->name)}}" readonly>
        </div>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email', $survey->order->user->email)}}" readonly>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="product" class="form-label">Produk</label>
            <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product"
                value="{{ old('product', $survey->order->product->name)}}" readonly>
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
        <label for="address" class="form-label">Alamat Survey</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror "
                value="{{ old('address', $survey->address) }}">
        </div>

        <label for="city" class="form-label">Kota</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                placeholder=" @error('city') {{ $message }} @enderror " value="{{ old('city', $survey->city) }}">
        </div>
        <label for="phoneNumber" class="form-label">Telepon</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                name="phoneNumber" placeholder=" @error('phoneNumber') {{ $message }} @enderror "
                value="{{ old('phoneNumber', $survey->phoneNumber) }}">
        </div>
        <label for="surveyDate" class="form-label">Tanggal Survey</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control @error('surveyDate') is-invalid @enderror" id="surveyDate"
                name="surveyDate" placeholder=" @error('surveyDate') {{ $message }} @enderror "
                value="{{ old('surveyDate', $survey->surveyDate) }}">
        </div>
        <label for="surveyTime" class="form-label">Waktu Survey</label>
        <div class="input-group mb-3">
            <input type="time" class="form-control @error('surveyTime') is-invalid @enderror" id="surveyTime"
                name="surveyTime" placeholder=" @error('surveyTime') {{ $message }} @enderror "
                value="{{ old('surveyTime', $survey->surveyTime) }}">
        </div>
        <label for="description" class="form-label">Deskripsi Survey</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder=" @error('description') {{ $message }} @enderror "
                value="{{ old('description', $survey->description) }}">
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
        @error('assignRole')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="surveyFile" class="form-label">Survey File</label>
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
        <button type="submit" class="btn btn-primary">Perbaharui survey</button>
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