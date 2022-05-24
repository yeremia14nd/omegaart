@extends('layouts.main')

@section('container')
<div class="container">
  <div class="row justify-content-center">
    <h5 class="col-sm-4">Detail Products</h5>
    <a href="/shop" class="text-decoration-none col-sm-4 d-flex align-items-end flex-column mt-auto px-0 text-end">
      Back to Shop
    </a>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md text-center">
          <img id="unsplashImage" src="{{ asset('storage/' . $product->imageAssets) }}" class="img-fluid img-thumbnail"
            alt="{{ $product->category->name }}">
        </div>
        <div class="col-md">
          <h1 class="mb-2">{{ $product->name }}</h1>
          <p class="my-0">Price start from <b>Rp. {{ number_format($product->price / 1, 0) }},-</b></p>
          <p class="mt-0 mb-2">Estimasi Pengerjaan {{ $product->workDuration }} hari kerja</p>
          <small class="text-muted p-1 border rounded " style="font-size: 0.8em">{{
            $product->productAvailability->availability
            }}</small>
          <table class="table">
            <tr>
              <td>Kategori</td>
              <td>: {{ $product->category->name }}</td>
            </tr>
            <tr>
              <td>Berat</td>
              <td>: {{ $product->weight }} Kg</td>
            </tr>
            <tr>
              <td>Stock</td>
              <td>: {{ $product->stock }} Unit</td>
            </tr>
          </table>
          <h5>Deskripsi</h5>
          <p>{{ $product->description }}</p>
          @if ($product->productAvailability->id === 1)
          <form action="{{ route('cart.store') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="d-grid gap-2">
              {{-- <a href="" class="btn btn-primary">Add To Cart</a> --}}
              <button type="submit" class="btn btn-primary">Add To Cart</button>
            </div>
          </form>
          @else
          <form action="/orders" method="post">
            @csrf
            <div class="d-grid gap-2">
              <input type="hidden" class="form-control @error('product_id') is-invalid @enderror " id="product_id"
                name="product_id" value="{{ $product->id }}">
              <input type="hidden" class="form-control @error('user_id') is-invalid @enderror " id="user_id"
                name="user_id" value="{{ auth()->user()->id }}">
              <button type="submit" class="btn btn-primary">Go Order and Survey</button>
            </div>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
