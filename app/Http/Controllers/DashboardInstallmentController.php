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

    public function index()
    {
        return view('dashboard.installments.index', [
            'installments' => Installment::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.installments.create', [
            'productions' => Production::where('isFinished', 1)->where('onInstallment', 0)->get(),
            'workers' => User::where('role_id', 4)->get(),
        ]);
    }

    public function store(Request $request)
    {

        $rules = [
            'production_id' => 'required',
            'user_id' => 'required',
            'start_installment' => 'required',
            'start_installment_time' => 'required',
            'address' => 'required',
            'worker' => 'required',
        ];

        Production::where('id', $request->production_id)->update(['onInstallment' => 1]);

        $validatedData = $request->validate($rules);

        Installment::create($validatedData);

        return redirect('/dashboard/installments')->with('success', 'Jadwal Pemasangan sudah dibuat');
    }

    public function show(Installment $installment)
    {
        return view('dashboard.installments.show', [
            'installment' => $installment,
        ]);
    }

    public function edit(Installment $installment)
    {
        return view('dashboard.installments.edit', [
            'installment' => $installment,
            'workers' => User::where('role_id', 4)->get(),
        ]);
    }

    public function update(Request $request, Installment $installment)
    {
        $rules = [
            'start_installment' => 'required',
            'start_installment_time' => 'required',
            'address' => 'required',
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
            Order::where('id', $installment->production->order_id)->update(['is_installed' => 1]);
        }

        Installment::where('id', $installment->id)->update($validatedData);

        return redirect('/dashboard/installments')->with('success', 'Informasi Pemasangan sudah diperbaharui');
    }

    public function updateConfirmInstallment(Installment $installment)
    {
        return view('dashboard.installments.confirm-installment', [
            'installment' => $installment,
        ]);
    }

    public function confirmInstallment(Request $request, Installment $installment)
    {
        $rules = [
            'file_asset' => 'required|image|file|max:10240',
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
            Order::where('id', $installment->production->order_id)->update(['is_installed' => 1]);
        }

        Installment::where('id', $installment->id)->update($validatedData);

        return redirect('/dashboard/installments')->with('success', 'Konfirmasi produk sudah terpasang');
    }

    public function destroy(Installment $installment)
    {
        if ($installment->file_asset) {
            Storage::delete($installment->file_asset);
        }
        Production::where('id', $installment->production_id)->update(['onInstallment' => 0]);
        Order::where('id', $installment->production->order_id)->update(['is_installed' => null]);

        Installment::destroy($installment->id);

        return redirect('/dashboard/installments')->with('success', 'Pemasangan sudah dihapus!');
    }

    public function checkProduction(Request $request)
    {
        $production = Production::where('id', $request->production_id)->first();

        return response()->json([
            'name' => $production->order->user->name,
            'user_id' => $production->order->user->id,
            'address' => $production->survey->address,
        ]);
    }
}
