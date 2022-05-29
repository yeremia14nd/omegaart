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
    <a href="/dashboard/orders/create" class="btn btn-primary m-2">Create New order</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Customer</th>
                <th scope="col">Tanggal Order</th>
                <th scope="col">Survey</th>
                <th scope="col">Invoice</th>
                <th scope="col">Paid</th>
                <th scope="col">Production</th>
                <th scope="col">Installation</th>
                <th scope="col">Final Invoice</th>
                <th scope="col">Full Paid</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->product->name }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('l, d-M-Y, H:i A') }}</td>
                <td class="{{ $order->is_surveyed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_surveyed ==
                    '1' ?
                    "Sudah disurvey" : "Belum disurvey" }}</td>
                <td class="{{ $order->is_invoice_sent == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_invoice_sent == '1' ? 'Sudah dikirim invoice' : 'Belum dikirim invoice'
                    }}</td>
                <td class="{{ $order->is_paid_invoiced == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_paid_invoiced == '1' ? 'Invoice sudah dibayar' : 'Invoice belum
                    dibayar' }}</td>
                <td class="{{ $order->is_productioned == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_productioned == '1' ? 'Sudah diproses produksi' : 'Belum diproses
                    produksi' }}</td>
                <td class="{{ $order->is_installed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_installed == '1' ? 'Sudah dilakukan pemasangan' : 'Belum dilakukan
                    pemasangan' }}</td>
                <td class="{{ $order->final_invoice_sent == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_final_invoice_sent == '1' ? 'Invoice Final sudah dikirim' : 'Invoice
                    Final belum
                    dikirim' }}</td>
                <td class="{{ $order->is_final_invoice_paid == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $order->is_final_invoice_paid == '1' ? 'Invoice Final sudah dibayar' : 'Invoice
                    Final belum
                    dibayar' }}</td>
                <td>
                    <a href="/dashboard/orders/{{ $order->id }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/orders/{{ $order->id }}/edit" class="badge bg-warning">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/orders/{{ $order->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Are you sure to delete this order?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection