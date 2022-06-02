@extends('dashboard.layouts.main')

@section('container')
<a href="/dashboard/orders" class="btn btn-success my-3"> <span data-feather="arrow-left"></span> Back to
    All Orders</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit order</h1>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/orders/{{ $order->id }}" class="mb-5">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="user_name" class="form-label">Name Of Customer to order</label>
            <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name"
                name="user_name" value="{{ old('user_name', $order->user->name)}}" readonly>
        </div>
        @error('user_name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="product" class="form-label">Order Product Name</label>
            <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product"
                value="{{ old('product', $order->product->name)}}" readonly>
            @error('product')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <label for="address" class="form-label">Address of Customer Contact</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                placeholder=" @error('address') {{ $message }} @enderror "
                value="{{ old('address', $order->user->address) }}" readonly>
        </div>
        <label for="phoneNumber" class="form-label">Phone Number</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber"
                name="phoneNumber" placeholder=" @error('phoneNumber') {{ $message }} @enderror "
                value="{{ old('phoneNumber', $order->user->phoneNumber) }}" readonly>
        </div>
        <label for="date" class="form-label">Order Date</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                placeholder=" @error('date') {{ $message }} @enderror " value="{{ old('date', $order->created_at) }}"
                readonly>
        </div>
        <label for="is_surveyed" class="form-label">Survey</label>
        <select class="form-select mb-3" @error('is_surveyed') is-invalid @enderror" id="is_surveyed"
            name="is_surveyed">
            <option value='0' @if (old('is_surveyed', $order->is_surveyed) == 0)
                selected @endif>Belum
                di survey
            </option>
            <option value='1' @if (old('is_surveyed', $order->is_surveyed) == 1)
                selected
                @endif>Sudah disurvey
            </option>
        </select>
        <label for="is_invoice_sent" class="form-label">Invoice Sent</label>
        <select class="form-select mb-3" @error('is_invoice_sent') is-invalid @enderror" id="is_invoice_sent"
            name="is_invoice_sent">
            <option value='0' @if (old('is_invoice_sent', $order->is_invoice_sent) == 0) selected @endif>Belum
                dikirim Invoice
            </option>
            <option value='1' @if (old('is_invoice_sent', $order->is_invoice_sent) == 1) selected @endif>Sudah
                dikirim Invoice
            </option>
        </select>
        @error('is_invoice_sent')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="is_paid_invoiced" class="form-label">Invoice Paid</label>
        <select class="form-select mb-3" @error('is_paid_invoiced') is-invalid @enderror" id="is_paid_invoiced"
            name="is_paid_invoiced">
            <option value='0' @if (old('is_paid_invoiced', $order->is_paid_invoiced) == 0) selected @endif>Belum
                dibayar
            </option>
            <option value='1' @if (old('is_paid_invoiced', $order->is_paid_invoiced) == 1) selected @endif>Sudah
                dibayar
            </option>
        </select>
        @error('is_paid_invoiced')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="is_productioned" class="form-label">Production</label>
        <select class="form-select mb-3" @error('is_productioned') is-invalid @enderror" id="is_productioned"
            name="is_productioned">
            <option value='0' @if (old('is_productioned', $order->is_productioned) == 0) selected @endif>Belum
                diproses Produksi
            </option>
            <option value='1' @if (old('is_productioned', $order->is_productioned) == 1) selected @endif>Sudah
                diproses Produksi
            </option>
        </select>
        @error('is_productioned')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="is_installed" class="form-label">Installation</label>
        <select class="form-select mb-3" @error('is_installed') is-invalid @enderror" id="is_installed"
            name="is_installed">
            <option value='0' @if (old('is_installed', $order->is_installed) == 0) selected @endif>Belum
                dilakukan pemasangan
            </option>
            <option value='1' @if (old('is_installed', $order->is_installed) == 1) selected @endif>Sudah
                dilakukan pemasangan
            </option>
        </select>
        @error('is_installed')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="is_final_invoice_sent" class="form-label">Final Invoice Sent</label>
        <select class="form-select mb-3" @error('is_final_invoice_sent') is-invalid @enderror"
            id="is_final_invoice_sent" name="is_final_invoice_sent">
            <option value='0' @if (old('is_final_invoice_sent', $order->is_final_invoice_sent) == 0) selected
                @endif>Belum
                dikirim Final Invoice
            </option>
            <option value='1' @if (old('is_final_invoice_sent', $order->is_final_invoice_sent) == 1) selected
                @endif>Sudah
                dikirim Final Invoice
            </option>
        </select>
        @error('is_final_invoice_sent')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <label for="is_final_invoice_paid" class="form-label">Fianl Invoice Paid</label>
        <select class="form-select mb-3" @error('is_final_invoice_paid') is-invalid @enderror"
            id="is_final_invoice_paid" name="is_final_invoice_paid">
            <option value='0' @if (old('is_final_invoice_paid', $order->is_final_invoice_paid) == 0) selected
                @endif>Belum
                dibayar Final Invoice
            </option>
            <option value='1' @if (old('is_final_invoice_paid', $order->is_final_invoice_paid) == 1) selected
                @endif>Sudah
                dibayar Final Invoice
            </option>
        </select>
        @error('is_final_invoice_paid')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
            <label for="status" class="form-label">Deskripsi Status: </label> @error('status')
            <div class="invalid-feedback d-inline">
                {{ $message }}
            </div>
            @enderror
            <input id="status" type="hidden" name="status" class="@error('status') is-invalid @enderror"
                value="{{ old('status', $order->status) }}">
            <trix-editor input="status"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Update Order</button>
    </form>
</div>

@endsection