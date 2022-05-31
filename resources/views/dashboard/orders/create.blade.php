@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/orders" class="btn btn-success my-3"> <span data-feather="arrow-left"></span> Back to
    All Orders</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create Order</h1>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/orders" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Name Of Customer to order</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                <option value="" class="text-muted">Select customer...</option>
                @foreach ($users as $user)
                @if (old('user_id') == $user->id)
                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                @else
                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
            <label for="product_id" class="form-label">Order Product Name</label>
            <select class="form-select @error('product_id') is-invalid @enderror" name="product_id">
                <option value="" class="text-muted">Select product...</option>
                @foreach ($products as $product)
                @if (old('product_id') == $product->id)
                <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                @else
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endif
                @endforeach
            </select>
            @error('product_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Deskripsi Status: </label> @error('status')
            <div class="invalid-feedback d-inline">
                {{ $message }}
            </div>
            @enderror
            <input id="status" type="hidden" name="status" class="@error('status') is-invalid @enderror"
                value="{{ old('status') }}">
            <trix-editor input="status"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>

@endsection