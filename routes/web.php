<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Online payment with paytabs
Route::get('/payment/paytabs/request', 'Web\PaytabsController@paymentRequest')->name('payment.paytabs.request');

// Update order done
Route::post('/payment/paytabs/response', 'Web\PaytabsController@paymentResponse')->name('payment.paytabs.response');