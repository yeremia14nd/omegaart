@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Pembayaran</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/payments" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali
                ke Semua Pembayaran</a>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Produk: {{ $payment->invoice->order->product->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Invoice Id</td>
                            <td>: {{ $payment->invoice_id }}</td>
                        </tr>
                        <tr>
                            <td>Order Id</td>
                            <td>: {{ $payment->invoice->order->id }}</td>
                        </tr>
                        <tr>
                            <td>Nama Customer</td>
                            <td>: {{ $payment->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Total Harga Produk</td>
                            <td>: Rp. {{ number_format($payment->invoice->total_price_product) }}</td>
                        </tr>
                        <tr>
                            <td>Total Harga Terbayar</td>
                            <td>: Rp. {{ number_format($payment->total_price_paid) }}</td>
                        </tr>
                        <tr>
                            <td>Pembayaran Down Payment</td>
                            <td
                                class="{{ $payment->has_paid_down_payment == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                : {{
                                $payment->has_paid_down_payment == '1' ? "Sudah DP" : "Belum DP" }}</td>
                        </tr>
                        <tr>
                            <td>Pembayaran Full</td>
                            <td class="{{ $payment->has_paid_full == '1' ? 'bg-success fw-bold' : 'table-danger' }}">:
                                {{
                                $payment->has_paid_full == '1' ? "Sudah Lunas" : "Belum Lunas" }}</td>
                        </tr>
                        <tr>
                            <td>Konfirmasi Data Pembayaran</td>
                            <td class="{{ $payment->is_confirmed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">: {{
                                $payment->is_confirmed == '1' ? "Terkonfirmasi" : "Belum konfirmasi" }}</td>
                        </tr>
                        <tr>
                            <td>File Pembayaran</td>
                            <td>:
                                <a href="/dashboard/payments/download/{{ $payment->id }}">{{ $payment->image_asset
                                    }}</a>
                            </td>
                        </tr>
                    </table>
                    <h5>Keterangan Customer: </h5>
                    <p>{!! $payment->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection