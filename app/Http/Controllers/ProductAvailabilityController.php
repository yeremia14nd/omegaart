<?php

namespace App\Http\Controllers;

use App\Models\ProductAvailability;
use App\Http\Requests\StoreProductAvailabilityRequest;
use App\Http\Requests\UpdateProductAvailabilityRequest;

class ProductAvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProductAvailabilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductAvailabilityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAvailability  $productAvailability
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAvailability $productAvailability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAvailability  $productAvailability
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAvailability $productAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductAvailabilityRequest  $request
     * @param  \App\Models\ProductAvailability  $productAvailability
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductAvailabilityRequest $request, ProductAvailability $productAvailability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAvailability  $productAvailability
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAvailability $productAvailability)
    {
        //
    }
}
