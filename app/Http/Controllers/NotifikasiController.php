<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
  public function notif()
  {
    $data = [
      'data' => Notifikasi::all_notif(),
      'unread' => Notifikasi::unread_notif()
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
    }
  }
}
