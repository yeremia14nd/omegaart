<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Production;
use App\Models\Order;
use App\Models\User;
use App\Models\Survey;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DashboardProductionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permit:superadmin,admin,teknisi')->only(['index', 'show', 'edit', 'update', 'downloadFile', 'updateConfirmProduction', 'confirmProduction', 'checkOrder']);
        $this->middleware('permit:superadmin,admin')->only(['create', 'store', 'destroy']);
    }

    public function index()
    {
        return view('dashboard.productions.index', [
            'productions' => Production::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.productions.create', [
            'orders' => Order::where('is_paid_invoiced', 1)->where('is_productioned', null)->get(),
            'workers' => User::where('role_id', 4)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $survey = Survey::where('order_id', $request->order_id)->first();

        $rules = [
            'order_id' => 'required',
            'start_production' => 'required',
            'work_duration' => 'required',
            'worker_name' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['survey_id'] = $survey->id;
        $validatedData['isFinished'] = 0;
        $validatedData['onInstallment'] = 0;

        Production::create($validatedData);
        Order::where('id', $request->order_id)->update(['is_productioned' => 0]);
        Notifikasi::createNotification("teknisi", "produksi");

        return redirect('/dashboard/productions')->with('success', 'Produksi sudah dibuat');
    }

    public function show(Production $production)
    {
        return view('dashboard.productions.show', [
            'production' => $production,
        ]);
    }

    public function edit(Production $production)
    {
        return view('dashboard.productions.edit', [
            'production' => $production,
            'surveyor' => $production->survey->assignTo,
            'workers' => User::where('role_id', 4)->get(),
        ]);
    }

    public function update(Request $request, Production $production)
    {
        $rules = [
            'start_production' => 'required',
            'work_duration' => 'required',
            'worker_name' => 'required',
            'file_asset' => 'image|file|max:10240|nullable',
            'isFinished' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('file_asset')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file_asset'] = $request->file('file_asset')->store('production-files');
            if ($request->isFinished) {
                Order::where('id', $production->order_id)->update(['is_productioned' => 1]);
            }
        }

        if ($request->isFinished) {
            Order::where('id', $production->order_id)->update(['is_productioned' => 1]);
        }

        Production::where('id', $production->id)->update($validatedData);

        return redirect('/dashboard/productions')->with('success', 'Produksi sudah diperbaharui');
    }

    public function updateConfirmProduction(Production $production)
    {
        return view('dashboard.productions.confirm-production', [
            'production' => $production,
        ]);
    }

    public function confirmProduction(Request $request, Production $production)
    {
        $rules = [
            'file_asset' => 'required|image|file|max:10240',
            'isFinished' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('file_asset')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file_asset'] = $request->file('file_asset')->store('production-files');
            if ($request->isFinished) {
                Order::where('id', $production->order_id)->update(['is_productioned' => 1]);
            }
        }

        if ($request->isFinished) {
            Order::where('id', $production->order_id)->update(['is_productioned' => 1]);
        }

        Production::where('id', $production->id)->update($validatedData);
        Notifikasi::createNotification("admin", "produksi");

        return redirect('/dashboard/productions')->with('success', 'Produksi sudah dikonfirmasi selesai!');
    }

    public function destroy(Production $production)
    {
        if ($production->file_asset) {
            Storage::delete($production->file_asset);
        }
        Production::destroy($production->id);

        return redirect('/dashboard/productions')->with('success', 'Produksi sudah dihapus!');
    }

    public function checkOrder(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $survey = Survey::where('order_id', $order->id)->first();

        return response()->json([
            'name' => $order->user->name,
            'surveyor' => $survey->assignTo,
        ]);
    }

    public function downloadFile($id)
    {
        $production = Production::where('id', $id)->first();
        $path = $production->file_asset;
        return Storage::download($path);
    }
}
