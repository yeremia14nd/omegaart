@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Payments</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/payments/create" class="btn btn-primary m-2">Create New payment</a>
    <table class="table table-striped table-sm">
        @if ($payments->has([0]))
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Invoice ID</th>
                <th scope="col">Order ID</th>
                <th scope="col">Customer</th>
                <th scope="col">Product</th>
                <th scope="col">Total Price</th>
                <th scope="col">Paid</th>
                <th scope="col">Confirmation</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $payment->invoice_id }}</td>
                <td>{{ $payment->invoice->order->id }}</td>
                <td>{{ $payment->user->name }}</td>
                <td>{{ $payment->invoice->order->product->name }}</td>
                <td>{{ $payment->invoice->total_price_product }}</td>
                <td>{{ $payment->total_price_paid }}</td>
                <td>{{ $payment->is_confirmed }}</td>
                <td>{{ $payment->image_asset }}</td>
                <td>
                    <a href="/dashboard/payments/{{ $payment->slug }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/payments/{{ $payment->slug }}/edit" class="badge bg-warning">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/payments/{{ $payment->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Are you sure to delete this payment?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <h3 class="my-3 text-muted">there is no Payments</h3>
        @endif
    </table>
</div>
@endsection