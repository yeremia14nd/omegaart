@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pemasangan</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/installments/create" class="btn btn-primary m-2">Tambah Jadwal Pemasangan</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order Id</th>
                <th scope="col">Produksi Id</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Tanggal pemasangan</th>
                <th scope="col">Waktu pemasangan</th>
                <th scope="col">Konfirmasi Customer</th>
                <th scope="col">Alamat</th>
                <th scope="col">Teknisi</th>
                <th scope="col">Status</th>
                <th scope="col">Foto pemasangan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($installments as $installment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>Order Id: {{ $installment->production->order_id }}</td>
                <td>Production Id: {{ $installment->production->id }}</td>
                <td>{{ $installment->production->order->user->name }}</td>
                <td>{{ $installment->production->order->product->name }}</td>
                <td>{{ $installment->start_installment }}</td>
                <td>{{ $installment->start_installment_time }}</td>
                <td class="{{ $installment->is_customer_confirm_date == '1' ? 'bg-success fw-bold' : 'table-danger' }}">
                    {{
                    $installment->is_customer_confirm_date == '1' ? 'Customer sudah konfirmasi' : 'Customer belum
                    konfirmasi' }}</td>
                <td>{{ $installment->address }}</td>

                <td>{{ $installment->worker }}</td>
                <td class="{{ $installment->is_installed == '1' ? 'bg-success fw-bold' : 'table-danger' }}">{{
                    $installment->is_installed == '1' ? 'Sudah terpasang' : 'Belum terpasang' }}</td>
                <td>@if ($installment->file_asset)
                    <img id="image" src="{{ asset('storage/' . $installment->file_asset) }}" class="img-fluid"
                        width="50" alt="{{ $installment->file_asset }}">
                    @else
                    <a href="/dashboard/installments/{{ $installment->id }}/confirmInstallment"
                        class="badge bg-primary">Konfirmasi Pemasangan Selesai <br> Silahkan Unggah Foto</a>
                    @endif
                </td>
                <td>
                    <a href="/dashboard/installments/{{ $installment->id }}" class="badge bg-info" title="Lihat detail">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/installments/{{ $installment->id }}/edit" class="badge bg-warning" title="Edit">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/installments/{{ $installment->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Apakah anda yakin ingin menghapus pemasangan?')"
                            title="Hapus"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection