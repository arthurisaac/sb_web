<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SliderMainPageController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubCategoryItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
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
    Route::resource('sliders-main-page', SliderMainPageController::class);
    Route::resource('reservations', ReservationController::class);

    Route::post('reservation-confirmation', [OrderController::class, 'confirmReservation'])->name("reservation-confirmation");
    Route::post('reservation-reject', [OrderController::class, 'rejectReservation'])->name("reservation-reject");
    Route::post('reservation-consume', [OrderController::class, 'consumeReservation'])->name("reservation-consume");
    Route::post('reservation-change-box', [OrderController::class, 'changeBoxReservation'])->name("reservation-change-box");
    //Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('basic', function() {
        $data = array('name'=>"Sondo Arthur");

        Mail::send('emails.simple', $data, function($message) {
            $path = "images/qrcode_" . time() . ".png";
            QrCode::format('png')->generate('Welcome to Makitweb', public_path($path) );

            $message->to('arthur@convergence.studio', 'Tutorials Point')
                ->subject('Laravel Basic Testing Mail');

            $message->attach(public_path($path));
            $message->from('r.thur.light@gmail.com','Virat Gandhi');
        });
    });
});

Route::get("qr", function () {
    //return \QrCode::size(300)->generate('https://techvblogs.com/');

});



