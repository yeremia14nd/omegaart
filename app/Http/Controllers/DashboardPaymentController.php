<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


class DashboardPaymentController extends Controller
{

    public function index()
    {
        return view('dashboard.payments.index', [
            'payments' => Payment::all()
        ]);
    }

    public function show(Payment $payment)
    {
        return view('dashboard.payments.show', [
            'payment' => $payment,
        ]);
    }

    public function edit(Payment $payment)
    {
        return view('dashboard.payments.edit', [
            'payment' => $payment,
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $rules = [
            'has_paid_down_payment' => 'required',
            'has_paid_full' => 'required',
            'is_confirmed' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->has_paid_full && $request->is_confirmed) {
            Order::where('id', $payment->invoice->order_id)->update([
                'is_final_invoice_sent' => 1,
                'is_final_invoice_paid' => 1,
                'status' => 'LUNAS',
            ]);
        }

        Payment::where('id', $payment->id)->update($validatedData);

        if ($request->is_confirmed) {
            Invoice::where('id', $payment->invoice_id)->update(['is_paid_confirmed' => 1]);
        }

        return redirect('/dashboard/payments')->with('success', 'Pembayaran sudah dikonfirmasi');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->image_asset) {
            Storage::delete($payment->image_asset);
        }
        Payment::destroy($payment->id);

        return redirect('/dashboard/payments')->with('success', 'Pembayaran sudah dihapus');
    }

    public function downloadFile($id)
    {
        $payment = Payment::where('id', $id)->first();
        $path = $payment->image_asset;
        return Storage::download($path);
    }
}
