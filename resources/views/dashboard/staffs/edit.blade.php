@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/staffs" class="btn btn-success my-3"> <span data-feather="arrow-left"></span> Kembali ke Semua
    Staf</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Role Staf</h1>
</div>

<div class="col-lg-8">

    <form method="post" action="/dashboard/staffs/{{ $staff->userName }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Staf</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" autofocus
                value="{{ old('name', $staff->name) }}" readonly>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="userName" class="form-label">Username</label>
            <input type="text" class="form-control @error('userName') is-invalid @enderror" id="userName"
                name="userName" readonly value="{{ old('userName', $staff->userName) }}" readonly>
            @error('userName')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Foto Profil Staf</label>
            <div class="mb-2">
                <img id="unsplashImage" src="{{ asset('storage/' . $staff->imageAssets) }}"
                    class="img-fluid img-thumbnail" alt="{{ $staff->name }}">
            </div>
        </div>
        <label for="email" class="form-label">Email</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder=" @error('email') {{ $message }} @enderror " value="{{ old('email', $staff->email) }}"
                readonly>
        </div>

        <label for="address" class="form-label">Alamat</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Alamat</span>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror " value="{{ old('address', $staff->address) }}"
                readonly>
        </div>
        <label for="phoneNumber" class="form-label">Telepon</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                name="phoneNumber" placeholder=" @error('phoneNumber') {{ $message }} @enderror "
                value="{{ old('phoneNumber', $staff->phoneNumber) }}" readonly>
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label">Role Staf</label>
            <br>
            <small class="mb-2">Role saat ini:
                @if ($staff->role_id === 2)
                Admin
                @elseif ($staff->role_id === 3)
                Estimator
                @elseif ($staff->role_id === 4)
                Teknisi
                @else
                Tidak ada Role Staf
                @endif</small>
            <select class="form-select @error('role_id') is-invalid @enderror" name="role_id">
                <option value="">Silahkan ubah role</option>
                <option value=2>Admin</option>
                <option value=3>Estimator</option>
                <option value=4>Teknisi</option>
            </select>
            @error('role_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ubah Role Staf</button>
    </form>
</div>

@endsection