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

<div class="album bg-light mb-5">
  <div class="container">
    <div class="row">
      @foreach ($categories as $item)
      <div class="col-md-4">
        <a href="/categories/{{ $item->slug }}">
          <div class="card bg-light text-white">
            <img class="card-img" src="{{ asset('storage/' . $item->imageAssets) }}" alt="{{ $item->name }}">
            <div class="card-img-overlay d-flex align-items-center p-0">
              <h5 class="card-title text-center flex-fill p-4 fs-4" style="background-color: rgba(0, 0, 0, 0.5)">{{
                $item->name
                }}</h5>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection