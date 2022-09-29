@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Pemasangan</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/installments" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span>
                Kembali
                ke Semua Pemasangan</a>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Produk: {{ $installment->production->order->product->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Order Id</td>
                            <td>: {{ $installment->production->order_id }}</td>
                        </tr>
                        <tr>
                            <td>Produksi Id</td>
                            <td>: {{ $installment->production->id }}</td>
                        </tr>
                        <tr>
                            <td>Nama Customer</td>
                            <td>: {{ $installment->production->order->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai pemasangan</td>
                            <td>: {{ $installment->start_installment}}</td>
                        </tr>
                        <tr>
                            <td>Alamat Pemasangan</td>
                            <td>: {{ $installment->address}} </td>
                        </tr>
                        {{-- <tr>
                            <td>Kota</td>
                            <td>: {{ $installment->city}} </td>
                        </tr> --}}
                        <tr>
                            <td>Teknisi Pemasangan</td>
                            <td>: {{ $installment->worker }}</td>
                        </tr>
                        <tr>
                            <td>Konfirmasi Jadwal Pemasangan </td>
                            <td
                                class="{{ $installment->is_customer_confirm_date == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                :
                                {{
                                $installment->is_customer_confirm_date == '1' ? "Customer Sudah Konfirmasi Jadwal" :
                                "Customer Belum
                                Konfirmasi Jadwal" }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status Pemasangan</td>
                            <td class="{{ $installment->is_installed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                :
                                {{
                                $installment->is_installed== '1' ? "Produk sudah dipasang" : "Produk Belum dipasang" }}
                            </td>
                        </tr>
                        <tr>
                            <td>File pemasangan</td>
                            <td>:
                                <a href="/dashboard/installments/download/{{ $installment->id }}">{{
                                    $installment->file_asset
                                    }}</a>
                            </td>
                        </tr>
                    </table>
                    <h5>Ulasan Customer: </h5>
                    <p>{!! $installment->description !!}</p>
                    <div class="col-md text-center">
                        <img id="unsplashImage" src="{{ asset('storage/' . $installment->file_asset) }}"
                            class="img-fluid img-thumbnail" alt="{{ $installment->id }}" width="30%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection