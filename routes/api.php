<?php

use App\Http\Controllers\Authentication\OtpVerificationController;
use App\Http\Controllers\Authentication\ChangePasswordController;
use App\Http\Controllers\Authentication\ForgetPasswordController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Role\RoleCreateController;
use App\Http\Controllers\Role\RoleDeleteController;
use App\Http\Controllers\Role\RoleGetAllController;
use App\Http\Controllers\Role\RoleGetOneController;
use App\Http\Controllers\Role\RoleUpdateController;
use App\Http\Controllers\User\UserCreateController;
use App\Http\Controllers\User\UserDeleteController;
use App\Http\Controllers\User\UserGetAllController;
use App\Http\Controllers\User\UserGetOneController;
use App\Http\Controllers\User\UserUpdateController;
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

Route::prefix('role')->group(function (): void {
	Route::post('create', [RoleCreateController::class, 'action']);
	Route::get('get', [RoleGetAllController::class, 'action']);
	Route::get('get/{id}', [RoleGetOneController::class, 'action']);
	Route::put('update/{id}', [RoleUpdateController::class, 'action']);
	Route::delete('delete/{id}', [RoleDeleteController::class, 'action']);
});

Route::prefix('user')->group(function (): void {
	Route::post('create', [UserCreateController::class, 'action']);
	Route::get('get', [UserGetAllController::class, 'action']);
	Route::get('get/{id}', [UserGetOneController::class, 'action']);
	Route::put('update/{id}', [UserUpdateController::class, 'action']);
	Route::delete('delete/{id}', [UserDeleteController::class, 'action']);
});
