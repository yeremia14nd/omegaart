@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Selamat Datang, {{ auth()->user()->name }}</h1>
</div>

<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Kustomer</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users_count }} user</div>
          </div>
          <div class="col-auto">
            <i class="fa fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Produk</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products_count }} items</div>
          </div>
          <div class="col-auto">
            <i class="fa fa-box fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              To do List</div>
            @if ($todo['checkout'] == 0 && $todo['survey'] == 0)
            <div class="h5 mb-0 font-weight-bold text-gray-800">Tidak ada Order Atau Survei yang masuk</div>
            @else
            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ url('/dashboard/confirmation') }}"
                style="text-decoration:none">{{ $todo['checkout'] }} Pesanan menunggu
                dikonfirmasi.</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="{{ url('/dashboard/surveys') }}"
                style="text-decoration:none">{{ $todo['survey'] }} Survei menunggu surveyor.</a></div>
            @endif
          </div>
          <div class="col-auto">
            <i class="fa fa-sticky-note fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Kategori
            </div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $categories_count }} Kategori</div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fa fa-grid fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Total Order</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders_count }} Order</div>
          </div>
          <div class="col-auto">
            <i class="fa fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection