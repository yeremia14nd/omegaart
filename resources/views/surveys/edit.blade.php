@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Change Survey Appointment</h1>
        </div>

        <div class="col-lg-6">
            <form method="post" action="/surveys/{{ $survey->id }}" class="mb-5">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="product" class="form-label"> Product Name</label>
                    <input type="text" class="form-control @error('product') is-invalid @enderror " id="product"
                        name="product" value="{{ $survey->product->name }}" readonly>
                    @error('product')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label"> Customer Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name"
                        autofocus value="{{ old('name', $survey->user->name) }}" readonly>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <label for="address" class="form-label">Address to Survey</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Address</span>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" placeholder=" @error('address') {{ $message }} @enderror "
                        value="{{ old('address', $survey->address) }}">
                </div>
                <label for="city" class="form-label">City</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                        value="{{ old('city', $survey->city) }}">
                    @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                        name="phoneNumber" value="{{ old('phoneNumber', $survey->phoneNumber) }}">
                    @error('phoneNumber')
                    <div class="invalid-feedback"> {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="surveyDate" class="form-label">Survey Date</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control @error('surveyDate') is-invalid @enderror" id="surveyDate"
                        name="surveyDate" value="{{ old('surveyDate', $survey->surveyDate) }}">
                    @error('surveyDate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="surveyTime" class="form-label">Survey Time</label>
                <div class="input-group mb-3">
                    <input type="time" class="form-control @error('surveyTime') is-invalid @enderror" id="surveyTime"
                        name="surveyTime" placeholder=" @error('surveyTime') {{ $message }} @enderror "
                        value="{{ old('surveyTime', $survey->surveyTime) }}">
                    @error('surveyTime')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" placeholder=" @error('description') {{ $message }} @enderror "
                        value="{{ old('description', $survey->description) }}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-lg-6">Update Survey</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection