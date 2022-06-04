@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Invoice List</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/invoices/create" class="btn btn-primary m-2">Create New invoice</a>
    <table class="table table-striped table-sm">
        @if ($invoices->has([0]))
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order Code</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Estimator</th>
                <th scope="col">Total Price</th>
                <th scope="col">Description</th>
                <th scope="col">File</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>Order Code: {{ $invoice->order_id }}</td>
                <td>{{ $invoice->order->user->name}}</td>
                <td>{{ $invoice->created_by}}</td>
                <td>Rp. {{ number_format($invoice->total_price_product / 1, 0) }}</td>
                <td>{{ $invoice->description}}</td>
                <td><a href="/dashboard/invoices/download/{{ $invoice->id }}">{{ $invoice->fileAsset }}</a>
                </td>
                <td>
                    <a href="/dashboard/invoices/{{ $invoice->id }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/invoices/{{ $invoice->id }}/edit" class="badge bg-warning">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/invoices/{{ $invoice->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Are you sure to delete this invoice?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <h3 class="my-3 text-muted">there is no Invoices</h3>
        @endif
    </table>
</div>
@endsection