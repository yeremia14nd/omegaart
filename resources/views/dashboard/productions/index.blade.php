@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Produksi</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/productions/create" class="btn btn-primary m-2">Tambah jadwal produksi</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order Id</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Jadwal Mulai Produksi</th>
                <th scope="col">Durasi Produksi</th>
                <th scope="col">Kepala Produksi</th>
                <th scope="col">Status</th>
                <th scope="col">Foto Produksi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productions as $production)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>Order Id: {{ $production->order->id }}</td>
                <td>{{ $production->order->product->name }}</td>
                <td>{{ $production->order->user->name }}</td>
                <td>{{ $production->start_production }}</td>
                <td>{{ $production->work_duration }} hari</td>
                <td>{{ $production->worker_name }}</td>
                <td class="{{ $production->isFinished == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $production->isFinished == '1' ? 'Sudah selesai produksi' : 'Proses
                    produksi' }}</td>
                <td>@if ($production->file_asset)
                    <img id="image" src="{{ asset('storage/' . $production->file_asset) }}" class="img-fluid" width="50"
                        alt="{{ $production->file_asset }}">
                    @else
                    <a href="/dashboard/productions/{{ $production->id }}/confirmProduction"
                        class="badge bg-primary">Konfirmasi Selesai <br>
                        Silahkan unggah Gambar</a>
                    @endif
                </td>
                <td>
                    <a href="/dashboard/productions/{{ $production->id }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/productions/{{ $production->id }}/edit" class="badge bg-warning">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/productions/{{ $production->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Are you sure to delete this production?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection