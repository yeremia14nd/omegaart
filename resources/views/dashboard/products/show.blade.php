@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Produk</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/products" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali
                ke Semua Produk</a>
            <a href="/dashboard/products/{{ $product->slug }}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Ubah</a>
            <form action="/dashboard/products/{{ $product->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3"
                    onclick="return confirm('Apakah anda yakin ingin menghapus produk ini?')"><span
                        data-feather="x-circle"></span> Hapus</button>
            </form>
            <div class="row">
                <div class="col-md text-center">
                    @if ($product->imageAssets)
                    <img id="unsplashImage" src="{{ asset('storage/' . $product->imageAssets) }}"
                        class="img-fluid img-thumbnail" alt="{{ $product->category->name }}">
                    @else
                    <img id="unsplashImage" src="{{ $product->imageAssets }}" class="img-fluid img-thumbnail"
                        alt="{{ $product->category->name }}">
                    @endif
                </div>
                <div class="col-md">
                    <h1 class="mb-2">{{ $product->name }}</h1>
                    <p class="my-0">Harga mulai dari <b>Rp. {{ number_format($product->price / 1, 0) }},-</b></p>
                    <p class="mt-0">Estimasi Pengerjaan {{ $product->workDuration }} hari kerja</p>
                    <p>
                        dalam <a href="/categories/{{ $product->category->slug }}" class="text-decoration-none">{{
                            $product->category->name
                            }}</a>
                    </p>
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
                            <td>Stok</td>
                            <td>: {{ $product->stock }} Unit</td>
                        </tr>
                    </table>
                    <h5>Deskripsi</h5>
                    <p>{!! $product->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection