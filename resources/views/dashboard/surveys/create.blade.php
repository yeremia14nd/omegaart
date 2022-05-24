@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Survey</h1>
</div>
<a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
    All Survey</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/surveys" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Name Of Customer to Survey</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                @foreach ($users as $user)
                @if (old('user_id') == $user->id)
                <option value="{{ $user->id }}" selected>{{ $user->name }} </option>
                @else
                <option value="{{ $user->id }}">{{ $user->name }} </option>
                @endif
                @endforeach
            </select>
        </div>
        @error('user_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email')}}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="product" class="form-label">Product</label>
            <select class="form-select @error('product_id') is-invalid @enderror" name="product_id">
                @foreach ($products as $product)
                @if (old('product_id') == $product->id)
                <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                @else
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        @error('product_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="address" class="form-label">Address of Survey</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror " value="{{ old('address') }}">
        </div>

        <label for="city" class="form-label">City</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                placeholder=" @error('city') {{ $message }} @enderror " value="{{ old('city') }}">
        </div>
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                name="phoneNumber" placeholder=" @error('phoneNumber') {{ $message }} @enderror "
                value="{{ old('phoneNumber') }}">
        </div>
        <label for="surveyDate" class="form-label">Survey Date</label>
        <div class="input-group mb-3">
            <input type="date" class="form-control @error('surveyDate') is-invalid @enderror" id="surveyDate"
                name="surveyDate" placeholder=" @error('surveyDate') {{ $message }} @enderror "
                value="{{ old('surveyDate') }}">
        </div>
        <label for="surveyTime" class="form-label">Survey Time</label>
        <div class="input-group mb-3">
            <input type="time" class="form-control @error('surveyTime') is-invalid @enderror" id="surveyTime"
                name="surveyTime" placeholder=" @error('surveyTime') {{ $message }} @enderror "
                value="{{ old('surveyTime') }}">
        </div>
        <label for="description" class="form-label">Description of the survey</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder=" @error('description') {{ $message }} @enderror "
                value="{{ old('description') }}">
        </div>
        <button type="submit" class="btn btn-primary">Create survey</button>
    </form>
</div>

{{-- <script>
    //cari tahu bagaimana mengambil data dari input nama dan masukkan ambil data email otomatis ketika memilih nama
    // const name = document.querySelector('#user_id');
    // const email = document.querySelector('#email');

    // name.addEventListener('change', function() {
    //     fetch(name.value)              
    //         .then(email.value = name.value)
            
    // });
</script> --}}

@endsection