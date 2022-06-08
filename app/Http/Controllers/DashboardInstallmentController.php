<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Production;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DashboardInstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.installments.index', [
            'installments' => Installment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.installments.create', [
            'productions' => Production::where('isFinished', 1)->get(),
            'workers' => User::where('is_role', 4)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'production_id' => 'required',
            'start_installment' => 'required',
            'start_installment_time' => 'required',
            'address' => 'required',
            'city' => 'required',
            'worker' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Installment::create($validatedData);

        return redirect('/dashboard/installments')->with('success', 'Jadwal Pemasangan telah dibuat!');
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
        return view('dashboard.installments.edit', [
            'installment' => $installment,
            'workers' => User::where('is_role', 4)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Installment  $installment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installment $installment)
    {
        $rules = [
            'start_installment' => 'required',
            'start_installment_time' => 'required',
            'address' => 'required',
            'city' => 'required',
            'worker' => 'required',
            'file_asset' => 'image|file|max:10240|nullable',
            'is_installed' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('file_asset')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file_asset'] = $request->file('file_asset')->store('installment-files');
            if ($request->is_installed) {
                Order::where('id', $installment->production->order_id)->update(['is_productioned' => 1]);
            }
        }

        if ($request->is_installed) {
            Order::where('id', $installment->production->order_id)->update(['is_productioned' => 1]);
        }

        Installment::where('id', $installment->id)->update($validatedData);

        return redirect('/dashboard/installments')->with('success', 'Informasi Pemasangan telah diperbaharui!');
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

    public function checkProduction(Request $request)
    {
        $production = Production::where('id', $request->production_id)->first();

        return response()->json([
            'name' => $production->order->user->name,
            'address' => $production->survey->address,
            'city' => $production->survey->city,
        ]);
    }
}
