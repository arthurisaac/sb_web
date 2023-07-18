<?php

use App\Http\Controllers\api\AppSettingsController;
use App\Http\Controllers\api\BoxController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\OrderPaymentController;
use App\Http\Controllers\api\SectionController;
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

//Route::apiResource('categories', CategoryController::class);
Route::post('categories', [CategoryController::class, 'index']);
Route::post('all-boxes', [BoxController::class, 'index']);
Route::post('boxes-in-category', [BoxController::class, 'showBoxOfACategory']);

Route::post('save-order', [OrderController::class, 'store']);
Route::post('save-payment', [OrderPaymentController::class, 'store']);

Route::post('settings', [AppSettingsController::class, 'index']);

Route::post('sections', [SectionController::class, 'index']);

Route::post('check-number', [OrderController::class, 'checkNumber']);

Route::post('confirmed-order', [OrderController::class, 'madeConfirmation']);

Route::post('reserve-order', [OrderController::class, 'reserveOrder']);

Route::post('saved-box-order', [OrderController::class, 'getSavedOrders']);
