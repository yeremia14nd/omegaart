@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Profil Information</h1>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md text-center">
                    <img id="unsplashImage" src="{{ asset('storage/' . $userprofile->imageAssets) }}"
                        class="img-fluid img-thumbnail" alt="{{ $userprofile->name }}">
                </div>
                <div class="col-md">
                    <h1 class="mb-2">{{ $userprofile->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Email</td>
                            <td>: {{ $userprofile->email }}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>: {{ $userprofile->userName}}</td>
                        </tr>
                        <tr>
                            <td>No Telephone</td>
                            <td>: {{ $userprofile->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>: {{ $userprofile->address }}</td>
                        </tr>
                    </table>
                    <form action="/profil/{{ $userprofile->userName }}/edit" method="get">
                        @csrf
                        <div class="d-grid gap-2">
                            {{-- <a href="" class="btn btn-primary">Add To Cart</a> --}}
                            <button type="submit" class="btn btn-primary">Edit Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection