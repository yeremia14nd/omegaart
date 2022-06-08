<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Http\Requests\StoreInstallmentRequest;
use App\Http\Requests\UpdateInstallmentRequest;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installments = Installment::where('user_id', auth()->user()->id)->get();
        return view('installments.index', [
            'title' => 'Daftar Pemasangan',
            'active' => 'installment',
            'installments' => $installments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInstallmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstallmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function show(Installment $installment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function edit(Installment $installment)
    {
        return view('installments.edit', [
            'title' => 'Ulasan Pemasangan',
            'active' => 'installment',
            'installment' => $installment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstallmentRequest  $request
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstallmentRequest $request, Installment $installment)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        Installment::where('id', $installment->id)->update($validatedData);

        return redirect('/installments')->with('success', 'Ulasan sudah terkirim');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Installment $installment)
    {
        //
    }

    public function confirmationSchedule(UpdateInstallmentRequest $request, Installment $installment)
    {
        $validatedData = $request->validate([
            'is_customer_confirm_date' => 'required',
        ]);

        Installment::where('id', $installment->id)->update($validatedData);

        return redirect('/installments')->with('success', 'Jadwal Pemasangan sudah dikonfirmasi');
    }
}
