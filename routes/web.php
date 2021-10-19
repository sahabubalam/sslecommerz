<?php

use Illuminate\Support\Facades\Route;
use App\Mail\SendEmailable;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use App\Http\Controllers\SslCommerzPaymentController;

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

Route::get('sendEmail',function(){
    
    $job=(new SendEmailJob())
                    ->delay(Carbon::now()->addSeconds(10));
                    dispatch($job);
                    
    return 'Email is send properly';
});

    // SSLCOMMERZ Start
   
    
    Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('example2');
    
    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
    
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
       
   
    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
    //SSLCOMMERZ END 