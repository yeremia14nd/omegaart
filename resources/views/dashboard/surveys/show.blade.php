@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Survey</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
                All Survey</a>
            <a href="/dashboard/surveys/{{ $survey->id}}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/surveys/{{ $survey->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3"
                    onclick="return confirm('Are you sure to delete this survey?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Product: {{ $survey->product_name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Customer Name</td>
                            <td>: {{ $survey->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>: {{ $survey->address }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>: {{ $survey->city }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>: {{ $survey->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <td>Survey Date</td>
                            <td>: {{ $survey->surveyDate }}</td>
                        </tr>
                        <tr>
                            <td>Survey Time</td>
                            <td>: {{ $survey->surveyTime }}</td>
                        </tr>
                        <tr>
                            <td>Survey Assign To</td>
                            <td>: @if ($survey->assignTo)
                                {{ $survey->assignTo }}
                                @else
                                <a href="/dashboard/surveys/{{ $survey->id}}/edit" class="badge bg-primary">Assign
                                    Role</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Survey File</td>
                            <td>: @if ($survey->surveyFile)
                                {{ $survey->surveyFile }}
                                @else
                                <a href="/dashboard/surveys/{{ $survey->id}}/edit" class="badge bg-primary">Upload</a>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <h5>Deskripsi</h5>
                    <p>{!! $survey->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection