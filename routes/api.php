<?php

use App\Http\Controllers\Authentication\OtpVerificationController;
use App\Http\Controllers\Authentication\ChangePasswordController;
use App\Http\Controllers\Authentication\ForgetPasswordController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Authentication\LoginController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function (): void {
	Route::post('register', [RegisterController::class, 'action']);
	Route::post('login', [LoginController::class, 'action']);
	Route::post('forget-password', [ForgetPasswordController::class, 'action']);
	Route::post('otp-verification', [OtpVerificationController::class, 'action'])->middleware('jwt');
	Route::post('change-password', [ChangePasswordController::class, 'action'])->middleware('jwt');
});