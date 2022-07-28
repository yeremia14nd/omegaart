@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Survei</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Kembali
                ke Semua Survei</a>
            <div class="row">
                <div class="col-md">
                    <h1 class="mb-2 text-muted">Produk: {{ $survey->order->product->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>Nama Customer</td>
                            <td>: {{ $survey->order->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $survey->address }}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>: {{ $survey->city }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $survey->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Survei</td>
                            <td>: {{ $survey->surveyDate }}</td>
                        </tr>
                        <tr>
                            <td>Waktu Survei</td>
                            <td>: {{ $survey->surveyTime }}</td>
                        </tr>
                        <tr>
                            <td>Surveyor Bertugas</td>
                            <td>: @if ($survey->assignTo)
                                {{ $survey->assignTo }}
                                @else
                                <a href="/dashboard/surveys/{{ $survey->id}}/edit" class="badge bg-primary">Pilih
                                    Surveyor</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Survei File</td>
                            <td>: @if ($survey->surveyFile)
                                <a href="/dashboard/surveys/download/{{ $survey->id }}">{{ $survey->surveyFile
                                    }}</a>
                                @else
                                <a href="/dashboard/surveys/{{ $survey->id}}/edit" class="badge bg-primary">Upload</a>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <h5>Deskripsi</h5>
                    <p>{!! $survey->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection