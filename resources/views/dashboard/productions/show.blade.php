@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Produksi</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/productions" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span>
                Kembali
                ke Semua Produksi</a>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Produk: {{ $production->order->product->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Order Id</td>
                            <td>: {{ $production->order_id }}</td>
                        </tr>
                        <tr>
                            <td>Nama Customer</td>
                            <td>: {{ $production->order->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai Produksi</td>
                            <td>: {{ $production->start_production}}</td>
                        </tr>
                        <tr>
                            <td>Durasi Produksi</td>
                            <td>: {{ $production->work_duration }} Hari</td>
                        </tr>
                        <tr>
                            <td>Teknisi Produksi</td>
                            <td>: {{ $production->worker_name }}</td>
                        </tr>
                        <tr>
                            <td>Status Produksi</td>
                            <td class="{{ $production->isFinished == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                :
                                {{
                                $production->isFinished == '1' ? "Sudah Selesai Produksi" : "Belum Selesai Produksi" }}
                            </td>
                        </tr>
                        <tr>
                            <td>File produksi</td>
                            <td>:
                                <a href="/dashboard/productions/download/{{ $production->id }}">{{
                                    $production->file_asset
                                    }}</a>
                            </td>
                        </tr>
                    </table>
                    <div class="col-md text-center">
                        <img id="unsplashImage" src="{{ asset('storage/' . $production->file_asset) }}"
                            class="img-fluid img-thumbnail" alt="{{ $production->order_id }}" width="30%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection