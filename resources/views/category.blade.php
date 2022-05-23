@extends('layouts.main')

@section('container')
<section class="py-4 text-center container">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h1 class="fw-bold mb-4">{{ $title }}</h1>
      <p>
        <a href="/shop" class="btn btn-outline-info btn-lg px-4 me-sm-3">All Products</a>
        <a href="/categories" class="btn btn-outline-info btn-lg px-4">Categories</a>
      </p>
    </div>
  </div>
</section>


<div class="container">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach ($products as $item)
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm">
        <a id="imageLink" href=""><img id="unsplashImage" src="{{ $item->imageAssets }}" class="card-img-top"
            alt="{{ $item->category->name }}"></a>
        <div class="card-body">
          <h5 class="card-title">{{ $item->name }}</h5>
          <small class="text-muted">in Category {{ $item->category->name }}</small>
          <p class="card-text pt-2">{{ $item->excerpt }}</p>
          <a href="/products/{{ $item->slug }}" class="btn btn-primary">View Product</a>
          <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>


{{-- <div class="album bg-light mb-5">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @foreach ($products as $item)
      <div class="col">
        <div class="card shadow-sm">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
            role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>{{ $item->name }}</title>
            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{
              $item->name }}</text>
          </svg>

          <div class="card-body">
            <p class="card-text">{{ $item->excerpt }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="/products/{{ $item->slug }}"><button type="button"
                    class="btn btn-sm btn-outline-secondary">View</button></a>
              </div>
              <small class="text-muted">9 mins</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div> --}}


@endsection