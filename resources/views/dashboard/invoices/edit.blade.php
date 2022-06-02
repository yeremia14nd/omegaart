@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Invoice</h1>
</div>
<a href="/dashboard/invoices" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
    All Invoice</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/invoices/{{ $invoice->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="my-3">
            <label for="order_id" class="form-label">Name Of Order</label>
            <select class="form-select @error('order_id') is-invalid @enderror" name="order_id" id="order_id">
                @foreach ($orders as $order)
                <option value="">Please select the Order Product</option>
                @if (old('order_id', $invoice->order_id) == $order->id)
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
                name="created_by" value="{{ old('created_by', $invoice->created_by)}}" readonly>
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
                value="{{ old('description', $invoice->description) }}">
        </div>
        <div class="mb-3">
            <label for="fileAsset" class="form-label">Invoice File</label>
            <input type="hidden" name="oldFile" value="{{ $invoice->fileAsset }}" width="100">
            @if ($invoice->fileAsset)
            <iframe src="{{ asset('storage/' . $invoice->fileAsset) }}"
                class="img-preview img-fluid mb-3 col-sm-5 d-block"></iframe>
            @else
            <iframe class="img-preview img-fluid mb-3 col-sm-5"></iframe>
            @endif
            <input class="form-control @error('fileAsset') is-invalid @enderror" type="file" id="image" name="fileAsset"
                onchange="previewImage()">
            @error('fileAsset')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Invoice</button>
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