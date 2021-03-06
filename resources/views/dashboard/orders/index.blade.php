@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Orders</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/orders/create" class="btn btn-primary m-2">Tambah Order Baru</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Customer</th>
                <th scope="col">Tanggal Order</th>
                <th scope="col">Jadwal Survei</th>
                <th scope="col">Survei</th>
                <th scope="col">Invoice</th>
                <th scope="col">Terbayar</th>
                <th scope="col">Produksi</th>
                <th scope="col">Pemasangan</th>
                <th scope="col">Final Invoice</th>
                <th scope="col">Pembayaran Full</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>Order ID: {{ $order->id }} {{ $order->product->name }} </td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('l, d-M-Y, H:i A') }}</td>
                <td class="{{ $order->is_survey_scheduled == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_survey_scheduled ==
                    '1' ?
                    "Sudah dijadwal" : "Belum dijadwal" }}</td>
                <td class="{{ $order->is_surveyed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_surveyed ==
                    '1' ?
                    "Sudah disurvei" : "Belum disurvei" }}</td>
                <td class="{{ $order->is_invoice_sent == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_invoice_sent == '1' ? 'Sudah dikirim invoice' : 'Belum dikirim invoice'
                    }}</td>
                <td class="{{ $order->is_paid_invoiced == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_paid_invoiced == '1' ? 'Invoice sudah dibayar' : 'Invoice belum
                    dibayar' }}</td>
                <td class="{{ $order->is_productioned == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_productioned == '1' ? 'Sudah selesai produksi' : 'Belum diproses
                    produksi' }}</td>
                <td class="{{ $order->is_installed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_installed == '1' ? 'Sudah dilakukan pemasangan' : 'Belum dilakukan
                    pemasangan' }}</td>
                <td class="{{ $order->is_final_invoice_sent == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_final_invoice_sent == '1' ? 'Invoice Final sudah dikirim' : 'Invoice
                    Final belum
                    dikirim' }}</td>
                <td class="{{ $order->is_final_invoice_paid == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_final_invoice_paid == '1' ? 'Invoice Final sudah dibayar' : 'Invoice
                    Final belum
                    dibayar' }}</td>
                <td>
                    <a href="/dashboard/orders/{{ $order->id }}" class="badge bg-info" title="Lihat detail">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/orders/{{ $order->id }}/edit" class="badge bg-warning" title="Edit">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/orders/{{ $order->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Apakah anda yakin ingin menghapus order ini?')" title="Hapus"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection