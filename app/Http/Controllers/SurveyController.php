<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('surveys.index', [
            'title' => 'Survey List',
            'active' => 'survey',
            'surveys' => Survey::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //untuk tampilan buat form survey
    public function create(Request $request)
    {
        $order = session('order');

        if (session()->has('order')) {
            $product = Product::where('id', $order->product_id)->first();
            return view('surveys.create', [
                'title' => 'Survey Form',
                'active' => 'survey',
                'order' => $order,
                'product' => $product,
                'user' => $request->user(),
            ]);
        } else {
            Order::destroy($order->id);
            session()->forget('order');
            return redirect('/shop');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSurveyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurveyRequest $request)
    {
        //mencari product yang disurvey dari nama produk di request
        $name = $request->product;
        $product = Product::where('name', $name)->first();

        $validatedData = $request->validate([
            'product' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'phoneNumber' => 'required',
            'description' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
        ]);


        //ubah nama dari 'product' menjadi 'product_name'
        $validatedData['product_name'] = $validatedData['product'];

        $validatedData['user_id'] = $request->user()->id;
        $validatedData['product_id'] = $product->id;

        Survey::create($validatedData);
        return redirect('/surveys')->with('success', 'Survey has been scheduled');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        // dd($survey);
        if ($survey->user_id === auth()->user()->id) {
            return view('surveys.edit', [
                'title' => 'Upadate Schedule',
                'active' => 'survey',
                'survey' => $survey,
            ]);
        } else {
            return redirect('/surveys');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSurveyRequest  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'city' => 'required',
            'phoneNumber' => 'required',
            'description' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
        ]);

        Survey::where('id', $survey->id)->update($validatedData);

        return redirect('/surveys')->with('success', 'Survey has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
