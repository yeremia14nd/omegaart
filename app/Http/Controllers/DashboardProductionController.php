<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Order;
use App\Models\User;
use App\Models\Survey;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DashboardProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.productions.index', [
            'productions' => Production::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.productions.create', [
            'orders' => Order::where('is_paid_invoiced', 1)->where('is_productioned', null)->get(),
            'workers' => User::where('role_id', 4)->get(),
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

        return redirect('/dashboard/productions')->with('success', 'Produksi telah dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        return view('dashboard.productions.show', [
            'production' => $production,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        return view('dashboard.productions.edit', [
            'production' => $production,
            'surveyor' => $production->survey->assignTo,
            'workers' => User::where('role_id', 4)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
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

        return redirect('/dashboard/productions')->with('success', 'Produksi telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
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

        return redirect('/dashboard/productions')->with('success', 'Produksi telah dikonfirmasi selesai!');
    }

    public function destroy(Production $production)
    {
        if ($production->file_asset) {
            Storage::delete($production->file_asset);
        }
        Production::destroy($production->id);

        return redirect('/dashboard/productions')->with('success', 'Produksi dihapus');
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
