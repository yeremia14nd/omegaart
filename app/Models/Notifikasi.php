<?php

namespace App\Models;

use App\Http\Controllers\SurveyController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifikasi extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  protected $table = 'notifikasi';

  protected $fillable = [
    'user_kategori',
    'notif_target',
    'notif_kategori',
    'read_status',
  ];

  // Show unread notif

  public static function unread_notif()
  {
    $data = Notifikasi::where('read_status', 0)->where('user_kategori', 'admin')
      ->count();
    return $data;
  }

  public static function unread_notif_teknisi()
  {
    $data = Notifikasi::where('read_status', 0)->where('user_kategori', 'teknisi')
      ->count();
    return $data;
  }

  public static function unread_notif_estimator()
  {
    $data = Notifikasi::where('read_status', 0)->where('user_kategori', 'estimator')
      ->count();
    return $data;
  }

  // Show all notif
  public static function all_notif($kat, $user_id = null)
  {
    $notif = null;
    if ($kat == "admin") {
      $notif = Notifikasi::where('user_kategori', $kat)
        ->get();
    } else {
      $notif = Notifikasi::where('user_kategori', $kat)
        ->get();
    }
    return $notif;
  }

  // Change status notif
  public static function changeStatus($id)
  {
    $notif = Notifikasi::find($id);
    $notif->read_status = 1;
    $notif->save();
  }

  public static function createNotification($user_kat = 'admin', $kat, $target = 0)
  {
    Notifikasi::create([
      "user_kategori" => $user_kat,
      "notif_target" => $target,
      "notif_kategori" => $kat,
      "read_status" => 0
    ]);
  }

  public static function to_do_list()
  {
    $data = [
      'checkout' => self::total_checkout(),
      'survey' => self::total_surveys()
    ];
    return $data;
  }

  public static function total_checkout()
  {
    $data = Checkout::where('status', 1)->count();
    return $data;
  }

  public static function total_surveys()
  {
    $data = Survey::where('assignTo', null)->count();
    return $data;
  }

  public static function surveys($id)
  {
   $data =  DB::table('orders AS o')
            ->join('surveys AS s', 's.order_id', '=', 'o.id')
            ->whereNotNull('s.assignTo')->whereNull('o.is_invoice_sent')->where('o.user_id', $id)
            ->count();

    $data_2 = DB::table('invoices AS iv')
      ->join('orders AS o', 'o.id', '=', 'iv.order_id')
      ->where('iv.is_validated', 1)->whereNull('o.is_paid_invoiced')->where('o.user_id', $id)
      ->count();
   return $data + $data_2;
  }
}
