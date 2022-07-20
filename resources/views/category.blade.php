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
</section>


<div class="container">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach ($products as $item)
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm">
        <a id="imageLink" href=""><img id="unsplashImage" src="{{ asset('storage/' . $item->imageAssets) }}"
            class="card-img-top" alt="{{ $item->category->name }}"></a>
        <div class="card-body">
          <h5 class="card-title">{{ Str::Limit($item->name, 35) }}</h5>
          <small class="text-muted">di kategori {{ $item->category->name }} </small><small
            class="text-muted p-1 border rounded" style="font-size: 0.8em">{{
            $item->productAvailability->availability
            }}</small>
          <p class="card-text pt-2">{!! Str::Limit($item->excerpt, 80) !!}</p>
          <a href="/products/{{ $item->slug }}" class="btn btn-primary">Lihat Produk</a>
          <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection