@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Semua Produk</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/products/create" class="btn btn-primary m-2">Tambah Produk</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Gambar</th>
                <th scope="col">Durasi Kerja</th>
                <th scope="col">Harga</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td><img id="image" src="{{ asset('storage/' . $product->imageAssets) }}" class="img-fluid" width="50"
                        alt="{{ $product->category->name }}"></td>
                <td>{{ $product->workDuration }} Hari</td>
                <td>Rp. {{ number_format($product->price / 1, 0) }}</td>
                <td>
                    <a href="/dashboard/products/{{ $product->slug }}" class="badge bg-info" title="Lihat detail">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/products/{{ $product->slug }}/edit" class="badge bg-warning" title="Edit">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/products/{{ $product->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Apakah anda yakin ingin menghapus produk ini?')"
                            title="Hapus"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection