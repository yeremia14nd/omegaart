@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Invoice</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/invoices" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
                All Invoices</a>
            <a href="/dashboard/invoices/{{ $invoice->id }}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/invoices/{{ $invoice->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3"
                    onclick="return confirm('Are you sure to delete this invoice?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md text-center">
                    @if ($invoice->fileAsset)
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe id="unsplashImage" src="{{ asset('storage/' . $invoice->fileAsset) }}"
                            class="img-fluid img-thumbnail" alt="{{ $invoice->order_id }}"></iframe>
                    </div>
                    @else
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe id="unsplashImage" src="{{ $invoice->fileAsset }}" class="img-fluid img-thumbnail"
                            alt="{{ $invoice->order_id }}"></iframe>
                    </div>
                    @endif
                </div>
                <div class="col-md">
                    <h5 class="mb-2">Customer Name : {{ $invoice->order->user->name }}</h5>
                    <p class="my-0">Invoice ID : <b> {{ $invoice->id}}</b></p>
                    <p class="my-0">Order ID : <b> {{ $invoice->order->id}}</b></p>
                    <p class="my-0">Product : <b> {{ $invoice->order->product->name}}</b></p>
                    <p class="my-0">Price : <b> {{ $invoice->total_price_product}}</b></p>
                    <p class="my-0">Estimator : <b> {{ $invoice->created_by}}</b></p>
                    <p class="my-0">Surveyor : <b> {{ $survey->assignTo}}</b></p>
                    <p>Deskripsi : {!! $invoice->description !!}</p>
                    <p>Download File : <a href="/dashboard/invoices/download/{{ $invoice->id }}">{{ $invoice->fileAsset
                            }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection