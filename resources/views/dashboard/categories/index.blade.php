@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Kategori</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/categories/create" class="btn btn-primary m-2">Tambah Kategori Baru</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kategori</th>
                <th scope="col">Gambar</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td><img id="image" src="{{ asset('storage/' . $category->imageAssets) }}" class="img-fluid" width="50"
                        alt="{{ $category->name }}"></td>
                <td>{!! $category->description !!}</td>
                <td>
                    <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection