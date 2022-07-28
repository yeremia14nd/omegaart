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
    <a href="/dashboard/invoices/create" class="btn btn-primary m-2">Buat Invoice Baru</a>
    <table class="table table-striped table-sm">
        @if ($invoices->has([0]))
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order Id</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Estimator</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">File</th>
                <th scope="col">Validasi Invoice</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>Order Id: {{ $invoice->order_id }}</td>
                <td>{{ $invoice->order->product->name }}</td>
                <td>{{ $invoice->order->user->name}}</td>
                <td>{{ $invoice->created_by}}</td>
                <td>Rp. {{ number_format($invoice->total_price_product / 1, 0) }}</td>
                <td>{{ $invoice->description}}</td>
                <td><a href="/dashboard/invoices/download/{{ $invoice->id }}">{{ $invoice->fileAsset }}</a>
                </td>
                <td>
                    @if ($invoice->is_validated)
                    Sudah divalidasi!
                    @elseif($invoice->is_validated === 0)
                    Ditolak. Silahkan direvisi.
                    @else
                    <form action="/dashboard/invoices/{{ $invoice->id}}/validation" method="post">
                        @method('put')
                        @csrf
                        <div class="d-grid gap-2">
                            <input type="hidden" class="form-control @error('is_validated') is-invalid @enderror "
                                id="is_validated" name="is_validated" value='1'>
                            <button type="submit" class="badge bg-success border-0"
                                onclick="return confirm('Apakah anda yakin ingin menvalidasi invoice ini?')">Validasi
                                Invoice</button>
                        </div>
                    </form>
                    @endif
                </td>
                <td>
                    <a href="/dashboard/invoices/{{ $invoice->id }}" class="badge bg-info" title="Lihat detail">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/invoices/{{ $invoice->id }}/edit" class="badge bg-warning" title="Edit">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/invoices/{{ $invoice->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Apakah anda yakin ingin menghapus Invoice ini?')"
                            title="Hapus"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <h3 class="my-3 text-muted">Belum ada Invoice</h3>
        @endif
    </table>
</div>
@endsection