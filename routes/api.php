<?php

use App\Http\Controllers\api\RiderController;
use App\Http\Controllers\api\RideRequestController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// le middleware auth:api vérifie que l'utilisateur est connecté, et le middleware role:admin vérifie que l'utilisateur a le rôle admin.
Route::middleware(['auth:api', 'role:admin'])->get('/admin', function () {
    // ...
});

Route::post('ride-request', [RideRequestController::class, 'getLatestRequestForRider']);
Route::post('ride-request-pending', [RideRequestController::class, 'getPendingRequestForRider']);
Route::post('ride-request-current', [RideRequestController::class, 'getCurrentRequestForRider']);
Route::post('ride-accept-request', [RideRequestController::class, 'rideAcceptRequest']);
Route::post('ride-request-next-step', [RideRequestController::class, 'rideRequestNextStep']);
Route::post('ride-history-request', [RideRequestController::class, 'rideRequestHistory']);

Route::post('rider-available', [RiderController::class, 'availableRiders']);

Route::post('rider-position', [RiderController::class, 'updateRiderLocation']);
