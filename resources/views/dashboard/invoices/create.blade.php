@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New invoice</h1>
</div>
<a href="/dashboard/invoices" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
    All Invoice</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/invoices" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Name Of Order Product</label>
            <select class="form-select @error('order_id') is-invalid @enderror" name="order_id" id="order_id">
                <option value="">Please select the Order Product</option>
                @foreach ($orders as $order)
                @if (old('order_id') == $order->id)
                <option value="{{ $order->id }}" selected>{{ $order->product->name }} </option>
                @else
                <option value="{{ $order->id }}">{{ $order->product->name }} </option>
                @endif
                @endforeach
            </select>
        </div>
        @error('order_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="text" class="form-label">Estimator</label>
            <input type="text" class="form-control @error('created_by') is-invalid @enderror" id="created_by"
                name="created_by" value="{{ old('created_by', auth()->user()->name)}}" readonly>
            @error('created_by')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="description" class="form-label">Description of the Invoice</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder=" @error('description') {{ $message }} @enderror "
                value="{{ old('description') }}">
        </div>
        <label for="total_price_product" class="form-label">Total Price of the Product</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control @error('total_price_product') is-invalid @enderror"
                id="total_price_product" name="total_price_product"
                placeholder=" @error('total_price_product') {{ $message }} @enderror "
                value="{{ old('total_price_product') }}">
        </div>
        <div class="mb-3">
            <label for="fileAsset" class="form-label">Invoice File</label>
            <iframe class="img-preview img-fluid mb-3 col-sm-5"></iframe>
            <input class="form-control @error('fileAsset') is-invalid @enderror" type="file" id="image" name="fileAsset"
                onchange="previewImage()">
            @error('fileAsset')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Invoice</button>
    </form>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection