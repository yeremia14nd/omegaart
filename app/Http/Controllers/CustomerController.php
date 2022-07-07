<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function total_pemesanan()
    {
      $id = Auth::id();
      $data = Survey::totalsurvey($id);
      $data_2 = Invoice::totalinvoice($id);
      return $data->total + $data_2->total;
    }

  public function total_invoice()
  {
    $id = Auth::id();
    $data = Invoice::totalinvoice($id);
    return $data;
  }
}
