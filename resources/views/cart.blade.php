@extends('layouts.main')

@section('container')
  <div class="container">
    <div class="row">
      <div class="col col-md-8">
        @if(count($errors) > 0)
          @foreach($errors->all() as $error)
            <div class="alert alert-warning">{{ $error }}</div>
          @endforeach
        @endif
        @if ($message = Session::get('error'))
          <div class="alert alert-warning">
            <p>{{ $message }}</p>
          </div>
        @endif
        @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
        @endif
        <div class="card">
          <div class="card-header">
            Item
          </div>
          <div class="card-body">
            <table class="table table-stripped">
              <thead>
              <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @if(Auth::check())
                @foreach($itemcart->detail as $detail)
                  <tr>
                    <td>
                      {{ $no++ }}
                    </td>
                    <td>
                      {{ $detail->product->name }}
                    </td>
                    <td>
                      {{ number_format($detail->price, 2) }}
                    </td>
                    <td>
                      <div class="btn-group" role="group">
                        <form action="{{ route('cart.update',$detail->id) }}" method="post">
                          @method('patch')
                          @csrf()
                          <input type="hidden" name="param" value="kurang">
                          <button class="btn btn-primary btn-sm">
                            -
                          </button>
                        </form>
                        <button class="btn btn-outline-primary btn-sm" disabled="true">
                          {{ number_format($detail->quantity, 2) }}
                        </button>
                        <form action="{{ route('cart.update',$detail->id) }}" method="post">
                          @method('patch')
                          @csrf()
                          <input type="hidden" name="param" value="tambah">
                          <button class="btn btn-primary btn-sm">
                            +
                          </button>
                        </form>
                      </div>
                    </td>
                    <td>
                      {{ number_format($detail->subtotal, 2) }}
                    </td>
                    <td>
                      <form action="{{ route('cart.destroy', $detail->id) }}" method="post"
                            style="display:inline;">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-sm btn-danger mb-2">
                          Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @else
              @if(session('cart'))
              <?php $total = 0 ?>
                @foreach($cartsession as $cartse)
                <?php $total += $cartse['price'] * $cartse['quantity'] ?>
                  <tr>
                    <td>
                      {{ $no++ }}
                    </td>
                    <td>
                      {{ $cartse['name'] }}
                    </td>
                    <td>
                      {{ number_format($cartse['price'], 2) }}
                    </td>
                    <td>
                      <div class="btn-group" role="group">
                        <form action="{{ route('cart.quantity',$cartse['id']) }}" method="post">
                          @method('patch')
                          @csrf()
                          <input type="hidden" name="param" value="kurang">
                          <button class="btn btn-primary btn-sm">
                            -
                          </button>
                        </form>
                        <button class="btn btn-outline-primary btn-sm" disabled="true">
                          {{ number_format($cartse['quantity'], 2) }}
                        </button>
                        <form action="{{ route('cart.quantity', $cartse['id']) }}" method="post">
                          @method('patch')
                          @csrf()
                          <input type="hidden" name="param" value="tambah">
                          <button class="btn btn-primary btn-sm update-cart">
                            +
                          </button>
                        </form>
                      </div>
                    </td>
                    <td>
                      {{ number_format(($cartse['price'] * $cartse['quantity']), 2) }}
                    </td>
                    <td class="actions" data-th="">
                      <form action="{{ route('cart.remove', $cartse['id']) }}" method="post">
                        @method('delete')
                        @csrf()
                        <button class="btn btn-sm btn-danger mb-2" data-id="{{ $cartse['id'] }}">Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @endif
              @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="card">
          <div class="card-header">
            Ringkasan
          </div>
          <div class="card-body">
            @if(Auth::check())
              <table class="table">
                <tr>
                  <td>No Invoice</td>
                  <td class="text-right">
                    {{ $itemcart->no_invoice }}
                  </td>
                </tr>
                <tr>
                  <td>Subtotal</td>
                  <td class="text-right">
                    {{ number_format($itemcart->subtotal, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td class="text-right">
                    {{ number_format($itemcart->total, 2) }}
                  </td>
                </tr>
              </table>
            @else
              <table class="table">
                <tr>
                  <td>Subtotal</td>
                  <td class="text-right">
                    @if(session('cart'))
                    {{ number_format($total, 2) }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td class="text-right">
                    @if(session('cart'))
                    {{ number_format($total, 2) }}
                    @endif
                  </td>
                </tr>
              </table>
            @endif
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col">
                <button class="btn btn-primary btn-block">Checkout</button>
              </div>
              <div class="col">
                @if(Auth::check())
                  <form action="{{ route('cart.kosongkan', $itemcart->id) }}" method="post">
                    @method('patch')
                    @csrf()
                    <button type="submit" class="btn btn-danger btn-block">Kosongkan</button>
                  </form>
                @else
                  <form action="{{ route('cart.empty') }}" method="post">
                    @method('post')
                    @csrf()
                    <button type="submit" class="btn btn-danger btn-block">Kosongkan</button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
