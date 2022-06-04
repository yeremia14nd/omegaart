@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Invoice Payments</h1>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Payment Quotation
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <h5>Payment Information</h5>
                            <table class="table table-sm">
                                <tr>
                                    <td>Order ID</td>
                                    <td>: {{ $invoice->order_id }}</td>
                                </tr>
                                <tr>
                                    <td>Product</td>
                                    <td>: {{ $invoice->order->product->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:Rp. {{ number_format($invoice->total_price_product) }}</td>
                                </tr>
                                <tr>
                                    <td>Invoice File</td>
                                    <td>: <a href="/dashboard/invoices/download/{{ $invoice->id }}">{{
                                            $invoice->fileAsset }}</a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <h5>Bank Transfer</h5>
                            <h6>Bank BCA :</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>01234567000</strong></td>
                                    <td>: An. CV.OMEGA ART</td>
                                </tr>
                            </table>
                            <small>*Pembayaran DP minimal 50% dari total Invoice yaitu minimal Rp. {{
                                number_format($invoice->total_price_product/2) }}</small></br>
                            <small>*Silahkan isi form Payment dibawah ini dan upload bukti Transfer. Admin akan mengecek
                                dan
                                konfirmasi pembayaran untuk dilakukan proses produksi produk</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <form method="post" action="/payments" class="mb-5" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control @error('invoice_id') is-invalid @enderror " id="invoice_id"
                    name="invoice_id" value="{{ $invoice->id }}">
                <input type="hidden" class="form-control @error('user_id') is-invalid @enderror " id="user_id"
                    name="user_id" value="{{ auth()->user()->id }}">
                <label for="total_price_paid" class="form-label">Total Price of Transfer</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend3">Rp</span>
                    </div>
                    <input type="number" class="form-control @error('total_price_paid') is-invalid @enderror"
                        id="total_price_paid" name="total_price_paid"
                        placeholder=" @error('total_price_paid') {{ $message }} @enderror "
                        value="{{ old('total_price_paid') }}">
                </div>
                <div class="mb-3">
                    <label for="image_asset" class="form-label">Transfer Receipt</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('image_asset') is-invalid @enderror" type="file" id="image"
                        name="image_asset" onchange="previewImage()">
                    @error('image_asset')
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
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-lg-6">Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>
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