<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Survey;
use App\Models\Order;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $order = Order::where('user_id', auth()->user()->id)->get()->modelKeys();

        $survey = Survey::whereIn('order_id', $order)->get();

        return view('surveys.index', [
            'title' => 'Survei List',
            'active' => 'survey',
            'surveys' => $survey,
        ]);
    }

    public function create(Request $request)
    {
        $order = session('order');

        if (session()->has('order')) {
            // $product = Product::where('id', $order->product_id)->first();
            return view('surveys.create', [
                'title' => 'Survei Form',
                'active' => 'survey',
                'order' => $order,
                'product' => $order->product,
                'user' => $request->user(),
            ]);
        } else {
            Order::destroy($order->id);
            session()->forget('order');
            return redirect('/shop');
        }
    }

    public function store(StoreSurveyRequest $request)
    {
        //mencari product yang disurvey dari nama produk di request
        // $name = $request->product;
        // $product = Product::where('name', $name)->first();

        $validatedData = $request->validate([
            // 'product' => 'required',
            // 'name' => 'required|max:255',
            // 'email' => 'required|email',
            'address' => 'required',
            'phoneNumber' => 'required',
            'description' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
        ]);

        $validatedData['order_id'] = $request->order_id;

        //ubah nama dari 'product' menjadi 'product_name'
        // $validatedData['product_name'] = $validatedData['product'];

        // $validatedData['user_id'] = $request->user()->id;
        // $validatedData['product_id'] = $product->id;

        Order::where('id', $request->order_id)->update(['is_survey_scheduled' => '1']);

        Notifikasi::createNotification("admin", "survey");
        Notifikasi::createNotification("teknisi", "survey");

        Survey::create($validatedData);
        return redirect('/surveys')->with('success', 'Survei sudah dijadwal');
    }

    public function edit(Survey $survey)
    {
        // dd($survey);
        if ($survey->order->user_id === auth()->user()->id) {
            return view('surveys.edit', [
                'title' => 'Upadate Schedule',
                'active' => 'survey',
                'survey' => $survey,
            ]);
        } else {
            return redirect('/surveys');
        }
    }

    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'phoneNumber' => 'required',
            'description' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
        ]);

        Survey::where('id', $survey->id)->update($validatedData);

        return redirect('/surveys')->with('success', 'Jadwal survei berhasil diubah');
    }

    public function total_surveys()
    {
        $id = Auth::id();
        $data = Survey::totalsurvey($id);
        return $data;
    }
}
