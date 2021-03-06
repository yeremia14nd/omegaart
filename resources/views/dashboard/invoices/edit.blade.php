@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Invoice</h1>
</div>
<a href="/dashboard/invoices" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Semua
    Invoice</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/invoices/{{ $invoice->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="text" class="form-label">Nama Order</label>
            <input type="text" class="form-control @error('order_id') is-invalid @enderror" id="order_id"
                name="order_id" value="{{ old('order_id', $invoice->order->product->name)}}" readonly>
            @error('order_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
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
        <label for="description" class="form-label">Dekripsi dari Invoice</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder=" @error('description') {{ $message }} @enderror "
                value="{{ old('description', $invoice->description) }}">
        </div>
        <label for="total_price_product" class="form-label">Total Harga Produk</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('total_price_product') is-invalid @enderror" id="price"
                name="total_price_product" placeholder=" @error('total_price_product') {{ $message }} @enderror "
                value="{{ old('total_price_product', $invoice->total_price_product) }}">
        </div>
        <div class="mb-3">
            <label for="fileAsset" class="form-label">File Invoice</label>
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
        <button type="submit" class="btn btn-primary">Ubah Invoice</button>
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
<script src="/js/autoNumeric.min.js"></script>
<script>
    const price = new AutoNumeric('#price', {
      decimalPlaces: '0',
      decimalCharacter: ',',
      digitGroupSeparator: '.'
    });  
    
</script>

@endsection