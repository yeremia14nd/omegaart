<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\User;
use App\Models\Order;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DashboardSurveyController extends Controller
{

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

    public function create()
    {
        $order = Order::whereNull('is_survey_scheduled')->get();

        return view('dashboard.surveys.create', [
            'orders' => $order,
            'assigns' => User::where('role_id', '4')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'address' => 'required',
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

    public function show(Survey $survey)
    {
        return view('dashboard.surveys.show', [
            'survey' => $survey,
        ]);
    }

    public function edit(Survey $survey)
    {
        return view('dashboard.surveys.edit', [
            'survey' => $survey,
            'assigns' => User::where('role_id', '4')->get(),
        ]);
    }

    public function update(Request $request, Survey $survey)
    {
        $validatedData = $request->validate([
            'address' => 'required',
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

    public function updateSurveyor(Survey $survey)
    {
        return view('dashboard.surveys.confirm-surveyor', [
            'survey' => $survey,
            'assigns' => User::where('role_id', '4')->get(),
        ]);
    }

    public function confirmSurveyor(Request $request, Survey $survey)
    {
        $validatedData = $request->validate([
            'assignTo' => 'required',
        ]);

        Survey::where('id', $survey->id)->update($validatedData);

        return redirect('/dashboard/surveys')->with('success', 'Surveyor sudah dikonfirmasi');
    }

    public function updateConfirmSurvey(Survey $survey)
    {
        return view('dashboard.surveys.confirm-survey', [
            'survey' => $survey,
        ]);
    }

    public function confirmSurvey(Request $request, Survey $survey)
    {
        $validatedData = $request->validate([
            'surveyFile' => 'required|image|file|max:10240|nullable',
        ]);

        if ($request->file('surveyFile')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['surveyFile'] = $request->file('surveyFile')->store('survey-files');
            Order::where('id', $survey->order_id)->update(['is_surveyed' => 1]);
        }

        Survey::where('id', $survey->id)->update($validatedData);
        Notifikasi::createNotification("estimator", "invoice");

        return redirect('/dashboard/surveys')->with('success', 'Survei sudah dikonfirmasi selesai');
    }

    public function confirmationSchedule(Request $request, Survey $survey)
    {
        $validatedData = $request->validate([
            'is_schedule_confirmed' => 'required',
        ]);

        Survey::where('id', $survey->id)->update($validatedData);

        return redirect('/dashboard/surveys')->with('success', 'Jadwal Survei sudah dikonfirmasi');
    }
}
