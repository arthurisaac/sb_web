<?php

use App\Http\Controllers\api\BoxController;
use App\Http\Controllers\api\CategoryController;
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
})->middleware('auth')->name('home');

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin',], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('boxes', BoxController::class);
});



