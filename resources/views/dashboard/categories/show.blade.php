@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Category</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/categories" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back
                to
                All categories</a>
            <a href="/dashboard/categories/{{ $category->slug }}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3"
                    onclick="return confirm('Are you sure to delete this category?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md text-center">
                    @if ($category->imageAssets)
                    <img id="unsplashImage" src="{{ asset('storage/' . $category->imageAssets) }}"
                        class="img-fluid img-thumbnail" alt="{{ $category->name }}">
                    @else
                    <img id="unsplashImage" src="{{ $category->imageAssets }}" class="img-fluid img-thumbnail"
                        alt="{{ $category->name }}">
                    @endif
                </div>
                <div class="col-md">
                    <h1 class="mb-2">{{ $category->name }}</h1>
                    <h5>Deskripsi</h5>
                    <p>{!! $category->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection