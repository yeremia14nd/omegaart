@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/staffs" class="btn btn-success my-3"> <span data-feather="arrow-left"></span> Back to
    All staffs</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create staff</h1>
</div>

<div class="col-lg-8">

    <form method="post" action="/dashboard/staffs" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Of Staff</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" autofocus
                value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="userName" class="form-label">User Name</label>
            <input type="text" class="form-control @error('userName') is-invalid @enderror" id="userName"
                name="userName" value="{{ old('userName') }}">
            @error('userName')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Staff Profil Picture</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
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
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder=" @error('email') {{ $message }} @enderror " value="{{ old('email') }}">
        </div>

        <label for="address" class="form-label">Address</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Address</span>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror " value="{{ old('address') }}">
        </div>
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <div class="input-group mb-3">
            <input type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                name="phoneNumber" placeholder=" @error('phoneNumber') {{ $message }} @enderror "
                value="{{ old('phoneNumber') }}">
        </div>
        <div class="mb-3">
            <label for="is_role" class="form-label">Assign Role</label>
            <select class="form-select @error('is_role') is-invalid @enderror" name="is_role" required>
                <option value="">Please select the role</option>
                <option value="2">Admin</option>
                <option value="3">Estimator</option>
                <option value="4">Teknisi</option>
            </select>
        </div>
        @error('assignRole')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <small class="d-block text-muted my-2">Default Password of every staff created by Admin is "password"</small>
        <button type="submit" class="btn btn-primary">Create staff</button>
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