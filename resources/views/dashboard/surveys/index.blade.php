@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Survei</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    @canany(['superadmin', 'admin'])
    <a href="/dashboard/surveys/create" class="btn btn-primary m-2">Tambah Survei Baru</a>
    @endcanany
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Produk Survei</th>
                <th scope="col">Tanggal Survei</th>
                <th scope="col">Waktu Survei</th>
                <th scope="col">Konfirmasi Survei</th>
                <th scope="col">Surveyor</th>
                <th scope="col">Alamat</th>
                <th scope="col">File Survei</th>
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
                <td>
                    @if ($survey->is_schedule_confirmed)
                    <span class="badge badge-pill badge-success text-dark">Sudah Konfirmasi Jadwal
                        </br>Menunggu Survey</span>
                    @else
                    <form action="/surveys/{{ $survey->id}}/confirmationSchedule" method="post">
                        @method('put')
                        @csrf
                        <div class="d-grid gap-2">
                            <input type="hidden"
                                class="form-control @error('is_schedule_confirmed') is-invalid @enderror "
                                id="is_schedule_confirmed" name="is_schedule_confirmed" value='1'>
                            <button type="submit"
                                onclick="return confirm('Apakah anda yakin ingin konfirmasi jadwal survei ini?')"
                                class="badge bg-success border-0">Konfirmasi Jadwal</button>
                        </div>
                    </form>
                    @endif
                </td>
                <td>@if ($survey->assignTo)
                    {{ $survey->assignTo }}
                    @else
                    <a href="/dashboard/surveys/{{ $survey->id }}/confirmSurveyor" class="badge bg-primary">Silahkan
                        Pilih
                        Surveyor</a>
                    @endif
                </td>
                <td>{{ $survey->address }}</td>
                <td>@if ($survey->surveyFile)
                    <img id="image" src="{{ asset('storage/' . $survey->surveyFile) }}" class="img-fluid" width="50"
                        alt="{{ $survey->surveyFile }}">
                    @else
                    <a href="/dashboard/surveys/{{ $survey->id }}/confirmSurvey" class="badge bg-primary"
                        onclick="return confirm('Apakah anda ingin konfirmasi survei selesai? Silahkan Upload File Gambar Survei')">Konfirmasi
                        Survei
                        Selesai <br>Silahkan Upload</a>
                    @endif
                </td>

                <td>
                    <a href="/dashboard/surveys/{{ $survey->id }}" class="badge bg-info" title="Lihat detail">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/surveys/{{ $survey->id }}/edit" class="badge bg-warning" title="Edit">
                        <span data-feather="edit"></span>
                    </a>
                    @canany(['superadmin', 'admin'])
                    <form action="/dashboard/surveys/{{ $survey->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Apakah anda yakin ingin menghapus survei?')" data-toggle="tooltip"
                            data-placement="top" title="Hapus"><span data-feather="x-circle"></span></button>
                    </form>
                    @endcanany
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection