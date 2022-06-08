<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function unread_notif(){
      $data = Notifikasi::where('read_status', 0)
              ->count();
      return $data;
    }

    // Show all notif
    public static function all_notif($kat = "admin", $user_id = null) {
        $notif = null;
        if($kat == "admin") {
            $notif = Notifikasi::all();
        } else {
            $notif = Notifikasi::where('user_kategori', $kat)
                        ->where('notif_target', $user_id)
                        ->get();
        }

        return $notif;
    }

    // Change status notif
    public static function changeStatus($id) {
        $notif = Notifikasi::find($id);
        $notif->read_status = 1;
        $notif->save();
    }

    public static function createNotification($user_kat = 'admin', $kat, $target = 0) {
        Notifikasi::create([
            "user_kategori" => $user_kat,
            "notif_target" => $target,
            "notif_kategori" => $kat,
            "read_status" => 0
        ]);
    }

    public static function to_do_list(){
      $data = [
        'checkout' => self::total_checkout()
      ];
      return $data;
    }

    public function total_checkout(){
      $data = Checkout::where('status', 1)->count();
      return $data;
    }
}
