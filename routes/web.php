<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RideRequestController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin',], function () {
    Route::resource('sliders', SliderController::class);
    Route::resource('cities', CityController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('delivery-men', RiderController::class);
});

Route::group(['middleware' => 'auth', 'prefix' => 'commons'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('ride-request', RideRequestController::class);
});

Route::group(['middleware' => 'auth', 'prefix' => 'rider'], function () {
    Route::resource('products', ProductController::class);
});


