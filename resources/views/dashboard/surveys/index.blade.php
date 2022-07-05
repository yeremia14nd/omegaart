@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Survey</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/surveys/create" class="btn btn-primary m-2">Tambah Survey Baru</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Produk Survey</th>
                <th scope="col">Tanggal Survey</th>
                <th scope="col">Waktu Survey</th>
                <th scope="col">Surveyor</th>
                <th scope="col">Alamat</th>
                <th scope="col">File Survey</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surveys as $survey)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $survey->order->user->name }}</td>
                <td>{{ $survey->order->product->name }}</td>
                <td>{{ $survey->surveyDate }}</td>
                <td>{{ $survey->surveyTime }}</td>
                <td>@if ($survey->assignTo)
                    {{ $survey->assignTo }}
                    @else
                    <a href="/dashboard/surveys/{{ $survey->id }}/edit" class="badge bg-primary">Silahkan Pilih
                        Surveyor</a>
                    @endif
                </td>
                <td>{{ $survey->address }}</td>
                <td>@if ($survey->surveyFile)
                    <img id="image" src="{{ asset('storage/' . $survey->surveyFile) }}" class="img-fluid" width="50"
                        alt="{{ $survey->surveyFile }}">
                    @else
                    <a href="/dashboard/surveys/{{ $survey->id }}/edit" class="badge bg-primary">Konfirmasi Survey
                        Selesai <br>Silahkan Upload</a>
                    @endif
                </td>
                <td>
                    <a href="/dashboard/surveys/{{ $survey->id }}" class="badge bg-info">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/surveys/{{ $survey->id }}/edit" class="badge bg-warning">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/surveys/{{ $survey->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Are you sure to delete this survey?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection