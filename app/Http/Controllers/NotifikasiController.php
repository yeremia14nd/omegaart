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

  public function checkout_read($id)
  {
    Notifikasi::changeStatus($id);
    return redirect('/dashboard/confirmation');
  }
}
