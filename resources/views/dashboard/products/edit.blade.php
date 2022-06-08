@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/products" class="btn btn-success my-3"> <span data-feather="arrow-left"></span> Kembali ke Semua
    Produk</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Produk</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/products/{{ $product->slug }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" autofocus
                value="{{ old('name', $product->name) }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly
                value="{{ old('slug', $product->slug) }}">
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                @foreach ($categories as $category)
                @if (old('category_id', $product->category_id) == $category->id)
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
            <label for="image" class="form-label">Gambar Produk</label>
            <input type="hidden" name="oldImage" value="{{ $product->imageAssets }}">
            @if ($product->imageAssets)
            <img src="{{ asset('storage/' . $product->imageAssets) }}"
                class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control @error('imageAssets') is-invalid @enderror" type="file" id="image"
                name="imageAssets" onchange="previewImage()">
            @error('imageAssets')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="price" class="form-label">Harga Produk</label>
        <div class="input-group mb-3">
            <span class="input-group-text">Rp.</span>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                placeholder=" @error('price') {{ $message }} @enderror " value="{{ old('price', $product->price) }}">
        </div>

        <label for="workDuration" class="form-label">Durasi Pengerjaan Produk (Hari)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('workDuration') is-invalid @enderror" id="workDuration"
                name="workDuration" placeholder=" @error('workDuration') {{ $message }} @enderror "
                value="{{ old('workDuration', $product->workDuration) }}">
            <span class="input-group-text">Hari</span>
        </div>
        <label for="weight" class="form-label">Berat Produk (dalam Kilogram)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight"
                placeholder=" @error('weight') {{ $message }} @enderror " value="{{ old('weight', $product->weight) }}">
            <span class="input-group-text">Kilogram</span>
        </div>
        <label for="stock" class="form-label">Stok Produk (Unit)</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
                placeholder=" @error('stock') {{ $message }} @enderror " value="{{ old('stock', $product->stock) }}">
            <span class="input-group-text">Unit</span>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Dekripsi: </label> @error('description')
            <div class="invalid-feedback d-inline">
                {{ $message }}
            </div>
            @enderror
            <input id="description" type="hidden" name="description" class="@error('description') is-invalid @enderror"
                value="{{ old('description', $product->description) }}">
            <trix-editor input="description"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Ubah Produk</button>
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