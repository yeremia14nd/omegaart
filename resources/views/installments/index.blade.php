@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Pemasangan</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Tanggal Pemasangan</th>
                        <th scope="col">Waktu Pemasangan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Teknisi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($installments as $installment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>Order Id: {{ $installment->production->order_id }}</td>
                        <td>{{ $installment->production->order->product->name }}</td>
                        <td>{{ $installment->start_installment }}</td>
                        <td>{{ $installment->start_installment_time }}</td>
                        <td>{{ $installment->address }}</td>
                        <td>{{ $installment->worker }}</td>
                        <td>@if($installment->description)
                            <span class="badge badge-pill badge-success text-dark">Produk terpasang <i
                                    class="bi bi-check-circle-fill"></i></br>Ulasan terkirim</span>
                            @elseif($installment->is_installed)
                            <span class="badge badge-pill badge-success text-dark">Sudah Terpasang <i
                                    class="bi bi-check-circle-fill"></i></span>
                            <a href="/installments/{{ $installment->id }}/edit" class="badge bg-success">Silahkan beri
                                ulasan</a>
                            @elseif ($installment->is_customer_confirm_date)
                            <span class="badge badge-pill badge-success text-dark">Sudah Konfirmasi Jadwal <i
                                    class="bi bi-check-circle-fill"></i></br>Menunggu Pemasangan</span>
                            @else
                            <form action="/installments/{{ $installment->id}}/confirmation" method="post">
                                @method('put')
                                @csrf
                                <div class="d-grid gap-2">
                                    <input type="hidden"
                                        class="form-control @error('is_customer_confirm_date') is-invalid @enderror "
                                        id="is_customer_confirm_date" name="is_customer_confirm_date" value='1'>
                                    <button type="submit"
                                        onclick="return confirm('Apakah anda yakin ingin konfirmasi jadwal pemasangan ini?')"
                                        class="badge bg-success border-0">Konfirmasi Jadwal</button>
                                </div>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection