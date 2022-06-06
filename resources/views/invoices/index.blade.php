@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Invoice List</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Product</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Invoice File</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>Order Id: {{ $invoice->order_id }}</td>
                        <td>{{ $invoice->order->product->name }}</td>
                        <td>Rp. {{ number_format($invoice->total_price_product) }}</td>
                        <td>{{ $invoice->description }}</td>
                        <td><a href="/dashboard/invoices/download/{{ $invoice->id }}">{{ $invoice->fileAsset }}</a></td>
                        <td>
                            @if ($invoice->is_paid_confirmed)
                            <span class="badge badge-pill badge-success text-dark">Confirmed Paid <i
                                    class="bi bi-check-circle-fill"></i></br>Product in Production</span>
                            @elseif ($invoice->order->is_paid_invoiced)
                            <span class="badge badge-pill badge-success text-dark">Has Paid <i
                                    class="bi bi-check-circle"></i></br>Waiting Confirmation</span>
                            @else
                            <form action="/payments/create" method="get">
                                <div class="d-grid gap-2">
                                    <input type="hidden" class="form-control @error('invoice_id') is-invalid @enderror "
                                        id="invoice_id" name="invoice_id" value="{{ $invoice->id }}">
                                    <input type="hidden" class="form-control @error('user_id') is-invalid @enderror "
                                        id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" class="badge bg-success border-0">Continue
                                        Payment</button>
                                </div>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection