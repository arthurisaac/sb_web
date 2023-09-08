<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubCategoryItemController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin',], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('sub-categories-item', SubCategoryItemController::class);
    Route::resource('boxes', BoxController::class);
    Route::resource('app-settings', AppSettingController::class);
    Route::resource('sections', SectionsController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('faqs', FAQController::class);

    Route::resource('orders', OrderController::class);
    Route::post('orders-confirmation', [OrderController::class, 'confirm'])->name("orders-confirmation");
    Route::resource('users', UserController::class);
    //Route::get('orders', [OrderController::class, 'index'])->name('orders');
});

/*Route::get("qr", function () {
    return QrCode::size(300)->generate('https://techvblogs.com/');
});*/



