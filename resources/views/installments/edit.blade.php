@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ulasan Pemasangan</h1>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Pemasangan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <h5>Informasi Pemasangan</h5>
                            <table class="table table-sm">
                                <tr>
                                    <td>Order ID</td>
                                    <td>: {{ $installment->production->order_id }}</td>
                                </tr>
                                <tr>
                                    <td>Produk</td>
                                    <td>: {{ $installment->production->order->product->name }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pemasangan</td>
                                    <td
                                        class="{{ $installment->is_installed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                                        :
                                        {{
                                        $installment->is_installed== '1' ? "Produk sudah dipasang" : "Produk Belum
                                        dipasang" }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md text-center">
                            <img id="unsplashImage" src="{{ asset('storage/' . $installment->file_asset) }}"
                                class="img-fluid img-thumbnail" alt="{{ $installment->id }}" width="30%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <form method="post" action="/installments/{{ $installment->id }}" class="mb-5">
                @method('put')
                @csrf
                <label for="description" class="form-label">Ulasan Customer</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" placeholder=" @error('description') {{ $message }} @enderror "
                        value="{{ old('description') }}" placeholder="Produk sudah terpasang dengan baik">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-lg-6">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection