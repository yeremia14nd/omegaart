@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Staff</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/staffs" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back
                to
                All Staffs</a>
            <a href="/dashboard/staffs/{{ $staff->userName }}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/staffs/{{ $staff->userName }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3" onclick="return confirm('Are you sure to delete this staff?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md text-center">
                    @if ($staff->imageAssets)
                    <img id="unsplashImage" src="{{ asset('storage/' . $staff->imageAssets) }}"
                        class="img-fluid img-thumbnail" alt="{{ $staff->name }}">
                    @else
                    <img id="unsplashImage" src="{{ $staff->imageAssets }}" class="img-fluid img-thumbnail"
                        alt="{{ $staff->name }}">
                    @endif
                </div>
                <div class="col-md">
                    <h1 class="mb-2">{{ $staff->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Username</td>
                            <td>: {{ $staff->userName }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $staff->email }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>: {{ $staff->address }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>: {{ $staff->phoneNumber }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection