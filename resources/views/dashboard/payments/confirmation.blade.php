@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Confirmation List</h1>
  </div>

  @if (session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Customer</th>
        <th scope="col">Alamat Pengiriman</th>
        <th scope="col">Tipe Pembayaran</th>
        <th scope="col">Total</th>
        <th scope="col">Bukti Pembayaran</th>
        <th scope="col">Status Order</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($checkout as $row)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $row->user->name }}</td>
          <td>{{ $row->shipping_address }}</td>
          @if($row->payment_type == 'bank_transfer')
            <td>Bank Transfer</td>
          @elseif($row->payment_type == 'credit_card')
            <td>Credit Card</td>
          @elseif($row->payment_type == 'Shopee Pay')
            <td>Shopee Pay</td>
          @elseif($row->payment_type == 'gopay')
            <td>Gopay</td>
          @endif
          <td>Rp. {{ number_format($row->cart->total, 2) }}</td>
          <td>
            @if(isset($row->payment_photo))
              <a href="{{ asset('storage/' . $row->payment_photo) }}" target="_blank"><img
                  src="{{ asset('storage/' . $row->payment_photo) }}" alt="" width="150"></a>
            @else
              Bukti Belum diupload
            @endif
          </td>
          @if($row->status == 1)
            <td>Menunggu Konfirmasi</td>
          @elseif($row->status == 2)
            <td>Sudah di Konfirmasi</td>
          @elseif($row->status == 0)
            <td>Ditolak</td>
          @endif
          <td>
            <form action="{{ route('confirmation.approved', $row->id) }}" method="post" class="d-inline">
              @method('patch')
              @csrf
              <button class="badge bg-success border-0"
                      onclick="return confirm('Konfirmasi Bukti Pembayaran ?')"><span
                  data-feather="edit"></span></button>
            </form>
            @if($row->status == 1)
              <form action="{{ route('confirmation.denied', $row->id) }}" method="post" class="d-inline">
                @method('patch')
                @csrf
                <button class="badge bg-danger border-0"
                        onclick="return confirm('Tolak Bukti Pembayaran ?')"><span
                    data-feather="x-circle"></span></button>
              </form>
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection
