<?php

use App\Http\Controllers\AccountTransactionController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupTransferController;
use App\Http\Controllers\GroupTurnController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SliderMainPageController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubCategoryItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubAccountController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\UserTransferController;
use App\Models\UserTransaction;
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
    Route::resource('users-accounts', UserSubAccountController::class);
    Route::resource('sliders-main-page', SliderMainPageController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('account-transactions', AccountTransactionController::class);
    Route::resource('user-transfer', UserTransferController::class);
    Route::resource('groups-transactions', GroupTransferController::class);
    Route::resource('groups', GroupController::class);
    Route::post('group-add-members', [GroupController::class, 'addMembers'])->name('group.add-member');

    Route::resource('group-account', GroupUserController::class);
    Route::resource('group-turn', GroupTurnController::class);
    Route::resource('group-transactions', GroupTransferController::class);
    Route::post('group-turns-for-user', [GroupTransferController::class, 'groupTurns'])->name('group-turn.free-turns');

    Route::post('user-account-edit', [UserSubAccountController::class, 'editUserAccount'])->name('user-account-edit');

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



