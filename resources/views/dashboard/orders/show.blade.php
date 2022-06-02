@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Order</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/orders" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
                All order</a>
            <a href="/dashboard/orders/{{ $order->id}}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/orders/{{ $order->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3" onclick="return confirm('Are you sure to delete this order?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Order Product: {{ $order->product->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Customer Name</td>
                            <td>: {{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>: {{ $order->user->address }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>: {{ $order->user->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>: {{ $order->created_at->format('l, d-M-Y, H:i A') }}</td>
                        </tr>
                        <tr>
                            <td>Survey</td>
                            <td class="{{ $order->is_surveyed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">: {{
                                $order->is_surveyed == '1' ? "Sudah disurvey" : "Belum disurvey" }}</td>
                        </tr>
                        <tr>
                            <td>Invoice</td>
                            <td class="{{ $order->is_invoice_sent == '1' ? 'bg-success fw-bold' : 'table-danger' }}">:
                                {{ $order->is_invoice_sent == '1' ? 'Sudah dikirim invoice' : 'Belum dikirim invoice'
                                }}</td>
                        </tr>
                        <tr>
                            <td>Paid</td>
                            <td class="{{ $order->is_paid_invoiced == '1' ? 'bg-success fw-bold' : 'table-danger' }}">:
                                {{ $order->is_paid_invoiced == '1' ? 'Invoice sudah dibayar' : 'Invoice belum
                                dibayar' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Production</td>
                            <td class="{{ $order->is_productioned == '1' ? 'bg-success fw-bold' : 'table-danger' }}">:
                                {{ $order->is_productioned == '1' ? 'Sudah diproses produksi' : 'Belum diproses
                                produksi' }}</td>
                        </tr>
                        <tr>
                            <td>Installation</td>
                            <td class="{{ $order->is_installed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">: {{
                                $order->is_installed == '1' ? 'Sudah dilakukan pemasangan' : 'Belum dilakukan
                                pemasangan' }}</td>
                        </tr>
                        <tr>
                            <td>Final Invoice</td>
                            <td class="{{ $order->final_invoice_sent == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                : {{ $order->is_final_invoice_sent == '1' ? 'Invoice Final sudah dikirim' : 'Invoice
                                Final belum
                                dikirim' }}</td>
                        </tr>
                        <tr>
                            <td>Full Paid</td>
                            <td
                                class="{{ $order->is_final_invoice_paid == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                : {{ $order->is_final_invoice_paid == '1' ? 'Invoice Final sudah dibayar' : 'Invoice
                                Final belum
                                dibayar' }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi Status</td>
                            <td>: - {!! $order->status !!} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection