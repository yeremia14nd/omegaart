@extends('layouts.main')

@section('container')
<section class="py-5 text-center container bg-secondary ">
  <div class="row">
    <div class="col-md-8 mx-auto mt-3">
      <h1 class="fw-bold mb-4">Cart</h1>
    </div>
  </div>
</section>

<div class="album bg-light mb-5">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @if (empty($cart) || count($cart) ==0 )
      <h4>Tidak ada produk dalam cart</h4>
      @else
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">harga</th>
            <th scope="col">Sub Total</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        @foreach ($cart as $c)
        <tbody>
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $c->nama_produk }}</td>
            <td>{{ $c->harga_produk }}</td>
            <td>{{ $c->jumlah }}</td>
            <td>
              <a href="/cart" class="badge bg-info">
                <span data-feather="eye"></span>
              </a>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>
      @endif


      {{-- @foreach ($cart as $item)
      <div class="col">
        <div class="card shadow-sm">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
            role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>{{ $item->id }}</title>
            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Cart ID: {{
              $item->id }}</text>
          </svg>

          <div class="card-body">
            <p>Cart by User ID: <a href="" class="text-decoration-none">{{ $item->user->id }}</a></p>
            <p class="card-text">Status: {{ $item->status }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="/cart/cart-list/{{ $item->id }}"><button type="button"
                    class="btn btn-sm btn-outline-secondary">View</button></a>
              </div>
              <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach --}}
    </div>
  </div>
</div>


@endsection