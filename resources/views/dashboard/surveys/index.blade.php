@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Surveys</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/surveys/create" class="btn btn-primary m-2">Create New Survey</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Customer Name</th>
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
                <td>{{ $survey->user->name }}</td>
                <td>{{ $survey->address }}</td>
                <td>{{ $survey->city }}</td>
                <td>{{ $survey->description }}</td>
                <td>{{ $survey->surveyDate }}</td>
                <td>{{ $survey->surveyTime }}</td>
                <td>
                    <a href="/dashboard/surveys/{{ $survey->id }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/surveys/{{ $survey->id }}/edit" class="badge bg-warning">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/surveys/{{ $survey->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Are you sure to delete this survey?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection