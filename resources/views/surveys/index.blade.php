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
            <h1 class="h2">Daftar Survey Anda</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Tanggal Survey</th>
                        <th scope="col">Waktu Survey</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $survey->order->product->name }}</td>
                        <td>{{ $survey->address }}</td>
                        <td>{{ $survey->city }}</td>
                        <td>{{ $survey->description }}</td>
                        <td>{{ $survey->surveyDate }}</td>
                        <td>{{ $survey->surveyTime }}</td>
                        <td>
                            @if ($survey->order->is_surveyed)
                            <span class="badge badge-pill badge-success text-dark">Sudah disurvey <i
                                    class="bi bi-check-circle-fill"></i></br> Menunggu Invoice</span>
                            @else
                            <a href="/surveys/{{ $survey->id }}/edit" class="badge bg-warning">
                                <span data-feather="edit"></span> Ubah Jadwal
                            </a>
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