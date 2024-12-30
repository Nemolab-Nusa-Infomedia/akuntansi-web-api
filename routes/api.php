<?php

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
});