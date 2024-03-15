<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::post('payment/process', [PaymentController::class, 'index'])->name('payment.process');
    Route::get('payment/token', [PaymentController::class, 'token'])->name('payment.token');
    
    Route::get('/apartments/sponsors', [ApartmentController::class, 'sponsors'])->name('apartments.sponsors');
    Route::resource('/apartments', ApartmentController::class);
});