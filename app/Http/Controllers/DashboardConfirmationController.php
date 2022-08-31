<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class DashboardConfirmationController extends Controller
{

  public function index()
  {
    return view('dashboard.payments.confirmation', [
      'checkout' => Checkout::all(),
    ]);
  }

  public function approved($id)
  {
    $checkout = Checkout::findOrFail($id);
    $status = 2;
    $checkout->update_status($status);
    return back()->with('success', 'Pembayaran sudah dikonfirmasi');
  }

  public function denied($id)
  {
    $checkout = Checkout::findOrFail($id);
    $status = 0;
    $checkout->update_status($status);
    return back()->with('success', 'Pembayaran ditolak!');
  }
}
