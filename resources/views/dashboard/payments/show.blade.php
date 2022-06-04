@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Payment</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/payments" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
                All Payment</a>
            <a href="/dashboard/payments/{{ $payment->id}}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/payments/{{ $payment->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3"
                    onclick="return confirm('Are you sure to delete this payment?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Product: {{ $payment->invoice->order->product->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Customer Name</td>
                            <td>: {{ $payment->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Total Price Paid</td>
                            <td>: Rp. {{ number_format($payment->total_price_paid) }}</td>
                        </tr>
                        <tr>
                            <td>Pay Down Payment</td>
                            <td
                                class="{{ $payment->has_paid_down_payment == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                : {{
                                $payment->has_paid_down_payment == '1' ? "Sudah DP" : "Belum DP" }}</td>
                        </tr>
                        <tr>
                            <td>Pay Full</td>
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
                            <td>Payment File</td>
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