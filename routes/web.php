<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/request-otp', [OtpController::class, 'requestOtp']);