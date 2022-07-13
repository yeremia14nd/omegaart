<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
  public function notif()
  {
    $data = [
      'data' => Notifikasi::all_notif('admin'),
      'unread' => Notifikasi::unread_notif()
    ];
    return $data;
  }

  public function notif_teknisi()
  {
    $data = [
      'data' => Notifikasi::all_notif('teknisi'),
      'unread' => Notifikasi::unread_notif_teknisi()
    ];
    return $data;
  }

  public function notif_estimator()
  {
    $data = [
      'data' => Notifikasi::all_notif('estimator'),
      'unread' => Notifikasi::unread_notif_estimator()
    ];
    return $data;
  }

  public function checkout_read($id, $kategori)
  {
    Notifikasi::changeStatus($id);
    if ($kategori == 'checkout') {
      return redirect('/dashboard/confirmation');
    } elseif ($kategori == 'survey') {
      return redirect('/dashboard/surveys');
    } elseif ($kategori == 'invoice') {
      return redirect('dashboard/invoices');
    } elseif ($kategori == 'invoice_order') {
      return redirect('dashboard/payments');
    } elseif ($kategori == 'produksi') {
      return redirect('dashboard/productions');
    } elseif ($kategori == 'installments'){
      return redirect('dashboard/installments/create');
    }
  }

  public function notif_customer(){
    $data = [
      'unread' => Notifikasi::surveys(Auth::id())
    ];
    return $data;
  }
}
