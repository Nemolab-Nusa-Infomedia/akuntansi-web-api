<?php

use App\Http\Controllers\Authentication\LoginController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function (): void {
	Route::post('login', [LoginController::class, 'action']);
});