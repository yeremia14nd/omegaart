@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Staf</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/staffs/create" class="btn btn-primary m-2">Tambah Staf Baru</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Staf</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Alamat</th>
                <th scope="col">Telepon</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staffs as $staff)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $staff->name }}</td>
                <td>{{ $staff->userName}}</td>
                <td>{{ $staff->email}}</td>
                <td>{{ $staff->address}}</td>
                <td>{{ $staff->phoneNumber}}</td>
                <td>@if ($staff->role_id == 1)
                    Super Admin
                    @elseif($staff->role_id == 2)
                    Admin
                    @elseif($staff->role_id == 3)
                    Estimator
                    @elseif($staff->role_id == 4)
                    Teknisi
                    @else
                    Belum ada Role
                    @endif</td>
                <td>
                    <a href="/dashboard/staffs/{{ $staff->userName }}" class="badge bg-info" title="Lihat detail">
                        <span data-feather="eye"></span>
                    </a>
                    <a href="/dashboard/staffs/{{ $staff->userName }}/edit" class="badge bg-warning" title="Edit">
                        <span data-feather="edit"></span>
                    </a>
                    <form action="/dashboard/staffs/{{ $staff->userName }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Apakah anda yakin ingin menghapus Staf ini?')" title="Hapus"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection