<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
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
        return view('dashboard.surveys.create', [
            'products' => Product::all(),
            'users' => User::where('is_role', '5')->get(),
            'assigns' => User::where('is_role', '4')->get(),
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
        $user = User::where('id', $request->user_id)->first();

        $product = Product::where('id', $request->product_id)->first();

        $validatedData = $request->validate([
            'user_id' => 'required',
            'email' => 'required',
            'product_id' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phoneNumber' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
            'description' => 'required',
        ]);

        $validatedData['name'] = $user->name;
        $validatedData['product_name'] = $product->name;

        // dd($validatedData);

        Survey::create($validatedData);

        return redirect('/dashboard/surveys')->with('success', 'New Survey has been scheduled');
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
            'assigns' => User::where('is_role', '4')->get(),
            'products' => Product::all(),

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
        $product = Product::where('id', $request->product_id)->first();

        $validatedData = $request->validate([
            'name' => 'required',
            'product_id' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phoneNumber' => 'required',
            'surveyDate' => 'required',
            'surveyTime' => 'required',
            'description' => 'required',
            'assignTo' => 'required',
            'surveyFile' => 'file|max:10240|nullable',
        ]);

        $validatedData['product_name'] = $product->name;

        $user = User::where('name', $request->assignTo)->first();
        $validatedData['assignTo'] = $user->name;


        if ($request->file('surveyFile')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['surveyFile'] = $request->file('surveyFile')->store('survey-files');
        }

        Survey::where('id', $survey->id)->update($validatedData);

        return redirect('/dashboard/surveys')->with('success', 'Survey has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {

        Survey::destroy($survey->id);

        return redirect('/dashboard/surveys')->with('success', 'Survey has been deleted');
    }
}
