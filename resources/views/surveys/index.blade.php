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
            <h1 class="h2">Your Survey Schedule List</h1>
        </div>

        <div class="table-responsive">
            {{-- <a href="/dashboard/products/create" class="btn btn-primary m-2">Create New Product</a> --}}
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Description</th>
                        <th scope="col">Survey Date</th>
                        <th scope="col">Survey Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $survey->product_name }}</td>
                        <td>{{ $survey->address }}</td>
                        <td>{{ $survey->city }}</td>
                        <td>{{ $survey->description }}</td>
                        <td>{{ $survey->surveyDate }}</td>
                        <td>{{ $survey->surveyTime }}</td>
                        <td>
                            <a href="/surveys/{{ $survey->id }}/edit" class="badge bg-warning">
                                <span data-feather="edit"></span> Change Schedule
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection