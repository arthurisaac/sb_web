<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SectionsController;
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
    Route::resource('app-settings', AppSettingController::class);
    Route::resource('sections', SectionsController::class);
    Route::resource('experiences', ExperienceController::class);
});



