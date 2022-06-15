@extends('layouts.main')

@section('container')

<div class="row justify-content-center">

    <a href="/profil/{{ $user->userName }}" class="btn btn-success my-3 col-sm-2"> <span
            data-feather="arrow-left"></span>
        Kembali ke Profil</a>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ubah Password</h1>
    </div>

    <div class="col-lg-6">

        <form method="post" action="/profil/{{ $user->userName }}/updatePassword" class="mb-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="oldPassword" class="form-label">Password lama</label>
                <input type="password" class="form-control @error('oldPassword') is-invalid @enderror " id="oldPassword"
                    name="oldPassword" autofocus>
                @error('oldPassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror " id="password"
                    name="password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="newConfirmPassword" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control @error('newConfirmPassword') is-invalid @enderror "
                    id="newConfirmPassword" name="newConfirmPassword">
                @error('newConfirmPassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Ubah Password</button>
        </form>
    </div>
</div>

@endsection