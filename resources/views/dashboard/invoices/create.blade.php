@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Invoice Baru</h1>
</div>
<a href="/dashboard/invoices" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali ke Semua
    Invoice</a>

<div class="col-lg-8">
    <form method="post" action="/dashboard/invoices" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label">Nama Produk Order</label>
            <select class="form-select @error('order_id') is-invalid @enderror" name="order_id" id="order_id">
                <option value="">Silahkan pilih Order</option>
                @foreach ($orders as $order)
                @if (old('order_id') == $order->id)
                <option value="{{ $order->id }}" selected>
                    Order ID:{{ $order->id }} {{ $order->product->name }} - Status {{ $order->is_invoice_sent == '1' ?
                    'Sudah dikirim invoice' : 'Belum dikirim invoice'
                    }}
                </option>
                @else
                <option value="{{ $order->id }}">Order ID: {{ $order->id }} -- {{ $order->product->name }} - Status --
                    {{
                    $order->is_invoice_sent == '1' ?
                    'Sudah dikirim invoice' : 'Belum dikirim invoice' }}</option>
                @endif
                @endforeach
            </select>
            @error('order_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Nama Customer</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer"
                name="customer" value="{{ old('customer')}}" readonly>
            @error('customer')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
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
        <label for="description" class="form-label">Deskripsi dari Invoice</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" placeholder=" @error('description') {{ $message }} @enderror "
                value="{{ old('description') }}">
        </div>
        <label for="total_price_product" class="form-label">Total Harga Produk</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
            </div>
            <input type="text" class="form-control @error('total_price_product') is-invalid @enderror" id="price"
                name="total_price_product" placeholder=" @error('total_price_product') {{ $message }} @enderror "
                value="{{ old('total_price_product') }}">
        </div>
        <div class="mb-3">
            <label for="fileAsset" class="form-label">File Invoice</label>
            <iframe class="img-preview img-fluid mb-3 col-sm-5"></iframe>
            <input class="form-control @error('fileAsset') is-invalid @enderror" type="file" id="image" name="fileAsset"
                onchange="previewImage()">
            @error('fileAsset')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Buat Invoice</button>
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
    const order_id = document.querySelector('#order_id');
    const customer = document.querySelector('#customer');

    order_id.addEventListener('change', function() {
        fetch('/dashboard/invoices/checkOrder?order_id=' + order_id.value)
            .then(response => response.json())
            .then(data => [
            customer.value = data.name,                                   
         ])        
    }); 
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