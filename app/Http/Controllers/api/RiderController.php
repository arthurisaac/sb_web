<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResouce;
use App\Models\Rider;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function updateRiderLocation(Request $request)
    {
        $request->validate([
            'rider' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $rider = Rider::query()->where("user_id", $request->get('rider'))->first();
        $rider->latitude = $request->get('latitude');
        $rider->longitude = $request->get('longitude');
        $rider->save();

        return new ApiResouce($rider);
    }

    public function availableRiders() {
        $riders = Rider::with('user')->get();
        return new ApiResouce($riders);
    }
}
