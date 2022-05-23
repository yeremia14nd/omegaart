@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Customer</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/customers" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back
                to
                All Customers</a>
            <a href="/dashboard/customers/{{ $customer->userName }}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/customers/{{ $customer->userName }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3"
                    onclick="return confirm('Are you sure to delete this customer?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md text-center">
                    @if ($customer->imageAssets)
                    <img id="unsplashImage" src="{{ asset('storage/' . $customer->imageAssets) }}"
                        class="img-fluid img-thumbnail" alt="{{ $customer->name }}">
                    @else
                    <img id="unsplashImage" src="{{ $customer->imageAssets }}" class="img-fluid img-thumbnail"
                        alt="{{ $customer->name }}">
                    @endif
                </div>
                <div class="col-md">
                    <h1 class="mb-2">{{ $customer->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Username</td>
                            <td>: {{ $customer->userName }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>: {{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>: {{ $customer->phoneNumber }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection