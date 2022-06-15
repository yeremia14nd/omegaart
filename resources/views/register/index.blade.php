@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row justify-content-center mt-5 mb-5">
    <div class="col-lg-5">
      <main class="form-registration">
        <h1 class="h3 mb-3 fw-normal text-center">Form Pendaftaran</h1>
        <form action="/register" method="post">
          @csrf
          <div class="form-floating">
            <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror"
              id="name" placeholder="Name" required value="{{ old('name') }}">
            <label for="name">Nama</label>
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="text" name="userName" class="form-control @error('userName') is-invalid @enderror"
              id="userName" placeholder="Username" required value="{{ old('userName') }}">
            <label for="userName">Username</label>
            @error('userName')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
              placeholder="name@example.com" required value="{{ old('email') }}">
            <label for="email">Alamat Email</label>
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="password" name="password"
              class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password"
              placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Daftar</button>
        </form>
        <small class="d-block text-center mt-3">Sudah punya akun? <a href="/login">Login</a></small>
      </main>
    </div>
  </div>
</div>

@endsection