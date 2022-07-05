@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Invoice</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/invoices" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali
                ke Semua Invoice</a>
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
                    <h5 class="mb-2">Customer : {{ $invoice->order->user->name }}</h5>
                    <table class="table">
                        <tr>
                            <td>Invoice Id</td>
                            <td>: <b> {{ $invoice->id}}</b></td>
                        </tr>
                        <tr>
                            <td>Order Id</td>
                            <td>: <b> {{ $invoice->order->id}}</b></td>
                        </tr>
                        <tr>
                            <td>Produk</td>
                            <td>: <b> {{ $invoice->order->product->name}}</b></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>: <b>Rp. {{ number_format($invoice->total_price_product)}}</td>
                        </tr>
                        <tr>
                            <td>Estimator</td>
                            <td>: <b> {{ $invoice->created_by}}</b></td>
                        </tr>
                        <tr>
                            <td>Surveyor</td>
                            <td>: <b> {{ $survey->assignTo}}</b></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>: {!! $invoice->description !!}</td>
                        </tr>
                        <tr>
                            <td>Download File</td>
                            <td>: <a href="/dashboard/invoices/download/{{ $invoice->id }}">{{ $invoice->fileAsset
                                    }}</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection