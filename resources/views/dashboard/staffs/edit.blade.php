@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/staffs" class="btn btn-success my-3"> <span data-feather="arrow-left"></span> Back to
    All staffs</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Staff</h1>
</div>

<div class="col-lg-8">

    <form method="post" action="/dashboard/staffs/{{ $staff->userName }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Of staff</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" autofocus
                value="{{ old('name', $staff->name) }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="userName" class="form-label">UserName</label>
            <input type="text" class="form-control @error('userName') is-invalid @enderror" id="userName"
                name="userName" readonly value="{{ old('userName', $staff->userName) }}">
            @error('userName')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">staff Image</label>
            <input type="hidden" name="oldImage" value="{{ $staff->imageAssets }}">
            @if ($staff->imageAssets)
            <img src="{{ asset('storage/' . $staff->imageAssets) }}"
                class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control @error('imageAssets') is-invalid @enderror" type="file" id="image"
                name="imageAssets" onchange="previewImage()">
            @error('imageAssets')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="email" class="form-label">Email</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder=" @error('email') {{ $message }} @enderror " value="{{ old('email', $staff->email) }}">
        </div>

        <label for="address" class="form-label">Address</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Address</span>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror "
                value="{{ old('address', $staff->address) }}">
        </div>
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                name="phoneNumber" placeholder=" @error('phoneNumber') {{ $message }} @enderror "
                value="{{ old('phoneNumber', $staff->phoneNumber) }}">
        </div>

        <button type="submit" class="btn btn-primary">Edit staff</button>
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