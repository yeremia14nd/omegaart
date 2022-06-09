@extends('layouts.main')

@section('container')

<section class="py-4 text-center container">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h1 class="fw-bold mb-4">{{ $title }}</h1>
      <p>
        <a href="/shop" class="btn btn-outline-info btn-lg px-4 me-sm-3">Semua Produk</a>
        <a href="/categories" class="btn btn-outline-info btn-lg px-4">Kategori</a>
      </p>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="/shop">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
          <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>
</section>

@if ($products->count())
<div class="container">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach ($products as $item)
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm">
        <img id="unsplashImage" src="{{ asset('storage/' . $item->imageAssets) }}" class="img-fluid img-thumbnail"
          alt="{{ $item->category->name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $item->name }}</h5>
          <small class="text-muted ">in Category {{ $item->category->name }}</small>
          <small class="text-muted p-1 border rounded" style="font-size: 0.8em">{{
            $item->productAvailability->availability
            }}</small>
          <p class="card-text pt-2">{!! $item->excerpt !!}</p>
          <a href="/products/{{ $item->slug }}" class="btn btn-primary">Lihat Produk</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@else
<p class="text-center fs-4">Produk tidak ditemukan</p>
@endif


<div class="d-flex justify-content-center my-4">
  {{ $products->links() }}
</div>

@endsection