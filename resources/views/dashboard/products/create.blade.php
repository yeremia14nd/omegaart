@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/products" class="btn btn-success my-3"> <span data-feather="arrow-left"></span> Back to
    All Products</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"> Create New Product</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/products" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Of Product</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" autofocus
                value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly
                value="{{ old('slug') }}">
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                @foreach ($categories as $category)
                @if (old('category_id') == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="product_availability_id" class="form-label">Availability</label>
            <select class="form-select mb-3" @error('product_availability_id') is-invalid @enderror"
                id="product_availability_id" name="product_availability_id">
                <option value=''>Please choose availability
                </option>
                @foreach ($product_availability as $availability)
                @if (old('product_availability_id') == $availability->id)
                <option value="{{ $availability->id }}" selected>{{ $availability->availability }}</option>
                @else
                <option value="{{ $availability->id }}">{{ $availability->availability }}</option>
                @endif
                </option>
                @endforeach
            </select>
        </div>
        @error('product_availability_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control @error('imageAssets') is-invalid @enderror" type="file" id="image"
                name="imageAssets" onchange="previewImage()">
            @error('imageAssets')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="price" class="form-label">Price of Product</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Rp.</span>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                placeholder=" @error('price') {{ $message }} @enderror " value="{{ old('price') }}">
        </div>

        <label for="workDuration" class="form-label">Duration Time for Product (Days)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('workDuration') is-invalid @enderror" id="workDuration"
                name="workDuration" placeholder=" @error('workDuration') {{ $message }} @enderror "
                value="{{ old('workDuration') }}">
            <span class="input-group-text">Days</span>
        </div>
        <label for="weight" class="form-label">Weight of the Product (in Kilograms)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight"
                placeholder=" @error('weight') {{ $message }} @enderror " value="{{ old('weight') }}">
            <span class="input-group-text">Kilograms</span>
        </div>
        <label for="stock" class="form-label">Stock of the Product (Unit)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
                placeholder=" @error('stock') {{ $message }} @enderror " value="{{ old('stock') }}">
            <span class="input-group-text">Units</span>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" class="@error('description') is-invalid @enderror"
                value="{{ old('description') }}">
            <trix-editor input="description"></trix-editor>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch('/dashboard/products/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault()
    });

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection