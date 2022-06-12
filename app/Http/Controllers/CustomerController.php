<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function total_pemesanan()
    {
      $id = Auth::id();
      $data = Survey::totalsurvey($id);
      return $data;
    }
}
