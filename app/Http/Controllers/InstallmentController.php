<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Http\Requests\StoreInstallmentRequest;
use App\Http\Requests\UpdateInstallmentRequest;
use App\Models\Notifikasi;

class InstallmentController extends Controller
{

    public function index()
    {
        $installments = Installment::where('user_id', auth()->user()->id)->get();
        return view('installments.index', [
            'title' => 'Daftar Pemasangan',
            'active' => 'installment',
            'installments' => $installments,
        ]);
    }

    public function edit(Installment $installment)
    {
        return view('installments.edit', [
            'title' => 'Ulasan Pemasangan',
            'active' => 'installment',
            'installment' => $installment,
        ]);
    }

    public function update(UpdateInstallmentRequest $request, Installment $installment)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        // dd($installment);
        Installment::where('id', $installment->id)->update($validatedData);

        return redirect('/installments')->with('success', 'Ulasan sudah terkirim');
    }

    public function confirmationSchedule(UpdateInstallmentRequest $request, Installment $installment)
    {
        $validatedData = $request->validate([
            'is_customer_confirm_date' => 'required',
        ]);

        Installment::where('id', $installment->id)->update($validatedData);
        Notifikasi::createNotification("teknisi", "installments");

        return redirect('/installments')->with('success', 'Jadwal Pemasangan sudah dikonfirmasi');
    }
}
