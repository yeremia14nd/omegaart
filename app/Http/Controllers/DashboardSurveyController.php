<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DashboardSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permit:superadmin,admin,teknisi,estimator')->only(['index', 'show', 'checkOrder', 'downloadFile']);
        $this->middleware('permit:superadmin,admin')->only(['create', 'store']);
        $this->middleware('permit:superadmin,admin,teknisi')->only(['edit', 'update']);
        $this->middleware('permit:superadmin,admin')->only('destroy');
    }

    public function index()
    {
        return view('dashboard.surveys.index', [
            'surveys' => Survey::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = Order::whereNull('is_survey_scheduled')->get();

        return view('dashboard.surveys.create', [
            'orders' => $order,
            'assigns' => User::where('role_id', '4')->get(),
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
        $validatedData = $request->validate([
            'order_id' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phoneNumber' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
            'description' => 'required',
            'assignTo' => 'required',
        ]);

        Survey::create($validatedData);
        Order::where('id', $request->order_id)->update(['is_survey_scheduled' => '1']);

        return redirect('/dashboard/surveys')->with('success', 'Survei baru sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        return view('dashboard.surveys.show', [
            'survey' => $survey,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        return view('dashboard.surveys.edit', [
            'survey' => $survey,
            'assigns' => User::where('role_id', '4')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'city' => 'required',
            'phoneNumber' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
            'description' => 'required',
            'assignTo' => 'required',
            'surveyFile' => 'image|file|max:10240|nullable',
        ]);

        $user = User::where('name', $request->assignTo)->first();
        $validatedData['assignTo'] = $user->name;


        if ($request->file('surveyFile')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['surveyFile'] = $request->file('surveyFile')->store('survey-files');
            Order::where('id', $survey->order_id)->update(['is_surveyed' => 1]);
        }

        Survey::where('id', $survey->id)->update($validatedData);
        Notifikasi::createNotification("estimator", "invoice");

        return redirect('/dashboard/surveys')->with('success', 'Survei sudah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        Order::where('id', $survey->order_id)->update([
            'is_survey_scheduled' => null,
            'is_surveyed' => null,
        ]);
        Survey::destroy($survey->id);

        return redirect('/dashboard/surveys')->with('success', 'Survei sudah dihapus!');
    }

    public function checkOrder(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();

        return response()->json([
            'name' => $order->user->name,
            'email' => $order->user->email,
            'address' => $order->user->address,
            'phoneNumber' => $order->user->phoneNumber,
        ]);
    }

    public function downloadFile($id)
    {
        $survey = Survey::where('id', $id)->first();
        $path = $survey->surveyFile;
        return Storage::download($path);
    }
}
