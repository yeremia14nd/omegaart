<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
  public function index()
  {
    $id = Auth::id();
    return view('history.index', [
      'title' => 'History List',
      'active' => 'history',
      'history_list' => Checkout::history($id)
    ]);
  }
}
