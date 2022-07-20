@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Order</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/orders" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke
                Semua Order</a>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Order Produk: {{ $order->product->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Nama Customer</td>
                            <td>: {{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $order->user->address }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $order->user->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Order</td>
                            <td>: {{ $order->created_at->format('l, d-M-Y, H:i A') }}</td>
                        </tr>
                        <tr>
                            <td>Jadwal Survey</td>
                            <td
                                class="{{ $order->is_survey_scheduled == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                : {{
                                $order->is_survey_scheduled == '1' ? "Sudah dijadwal survey" : "Belum dijadwal survey"
                                }}</td>
                        </tr>
                        <tr>
                            <td>Survey Selesai</td>
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
                            <td>Terbayar</td>
                            <td class="{{ $order->is_paid_invoiced == '1' ? 'bg-success fw-bold' : 'table-danger' }}">:
                                {{ $order->is_paid_invoiced == '1' ? 'Invoice sudah dibayar' : 'Invoice belum
                                dibayar' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Produksi</td>
                            <td class="{{ $order->is_productioned == '1' ? 'bg-success fw-bold' : 'table-danger' }}">:
                                {{ $order->is_productioned == '1' ? 'Sudah diproses produksi' : 'Belum diproses
                                produksi' }}</td>
                        </tr>
                        <tr>
                            <td>Pemasangan</td>
                            <td class="{{ $order->is_installed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">: {{
                                $order->is_installed == '1' ? 'Sudah dilakukan pemasangan' : 'Belum dilakukan
                                pemasangan' }}</td>
                        </tr>
                        <tr>
                            <td>Final Invoice</td>
                            <td
                                class="{{ $order->is_final_invoice_sent == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                : {{ $order->is_final_invoice_sent == '1' ? 'Invoice Final sudah dikirim' : 'Invoice
                                Final belum
                                dikirim' }}</td>
                        </tr>
                        <tr>
                            <td>Pembayaran Full</td>
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