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
        <h1 class="h2">Daftar History</h1>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">No Invoice</th>
            <th scope="col">Harga Total</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Keterangan</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($history_list as $row)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $row->no_invoice }}</td>
              <td>Rp. {{ number_format($row->total) }}</td>
              <td>
                @if($row->payment_type == 'empty')
                  Belum Membayar
                  @elseif($row->payment_type == 'bank_transfer')
                    Bank Transfer
                  @elseif($row->payment_type == 'credit_card')
                    Credit Card
                  @elseif($row->payment_type == 'Shopee Pay')
                    Shopee Pay
                  @elseif($row->payment_type == 'gopay')
                    Gopay
                @endif
              </td>
              <td>
                @if($row->status == 2)
                  Sudah Dikonfirmasi
                @else
                Menunggu Konfirmasi
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
