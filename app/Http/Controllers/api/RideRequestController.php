<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RideRequestResource;
use App\Models\RideRequest;
use Illuminate\Http\Request;

class RideRequestController extends Controller
{
    public function getLatestRequestForRider(Request $request)
    {
        $request->validate([
            'rider' => 'required',
        ]);
        $rider = $request->get('rider');

        $requests = RideRequest::with('client')->where('rider', $rider)->first();
        return new RideRequestResource($requests);
    }

    public function getPendingRequestForRider(Request $request)
    {
        $request->validate([
            'rider' => 'required',
        ]);
        $rider = $request->get('rider');

        $requests = RideRequest::with('client')
            ->where('rider', $rider)
            ->where('ride_status', 0)
            ->get();
        return new RideRequestResource($requests);
    }

    public function getCurrentRequestForRider(Request $request)
    {
        $request->validate([
            'rider' => 'required',
        ]);
        $rider = $request->get('rider');

        $requests = RideRequest::with('client')
            ->where('rider', $rider)
            ->where('ride_status', 1)
            ->get();
        return new RideRequestResource($requests);
    }

    public function rideAcceptRequest(Request $request)
    {
        $request->validate([
            'rider' => 'required',
            'ride_status' => 'required',
            'ride_id' => 'required',
        ]);

        $rideRequest = RideRequest::with('client')->find($request->get('ride_id'));
        $rideRequest->ride_status = (int) $request->get("ride_status");
        $rideRequest->save();

        return new RideRequestResource($rideRequest);
    }

    public function rideRequestNextStep(Request $request)
    {
        $request->validate([
            'rider' => 'required',
            'ride_id' => 'required',
        ]);
        $rider = $request->get('rider');

        $rideRequest = RideRequest::with('client')->find($request->get('ride_id'));
        $rideRequest->step = $rideRequest->step + 1;
        if ($rideRequest->step + 1 > 2) {
            $rideRequest->ride_status = 2;
        }
        $rideRequest->save();

        return new RideRequestResource($rideRequest);
    }

    public function rideRequestHistory(Request $request)
    {
        $request->validate([
            'rider' => 'required',
        ]);
        $rider = $request->get('rider');

        $requests = RideRequest::with('client')
            ->where('rider', $rider)
            ->get();

        return new RideRequestResource($requests);
    }
}
