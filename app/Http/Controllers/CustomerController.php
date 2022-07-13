<?php

namespace App\Http\Controllers;

use App\Models\Installment;
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
      $data_3 = Installment::totalinstallments($id);
      return $data->total + $data_2->total + $data_3->total;
    }

  public function total_invoice()
  {
    $id = Auth::id();
    $data = Invoice::totalinvoice($id);
    return $data;
  }

  public function total_installments()
  {
    $id = Auth::id();
    $data = Installment::totalinstallments($id);
    return $data;
  }
}
