<?php

use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionCreateController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionDeleteController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionGetAllController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionGetOneController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionUpdateController;
use App\Http\Controllers\CompanyCategory\CompanyCategoryCreateController;
use App\Http\Controllers\CompanyCategory\CompanyCategoryDeleteController;
use App\Http\Controllers\CompanyCategory\CompanyCategoryGetAllController;
use App\Http\Controllers\CompanyCategory\CompanyCategoryGetOneController;
use App\Http\Controllers\CompanyCategory\CompanyCategoryUpdateController;
use App\Http\Controllers\ProductCategory\ProductCategoryCreateController;
use App\Http\Controllers\ProductCategory\ProductCategoryDeleteController;
use App\Http\Controllers\ProductCategory\ProductCategoryGetAllController;
use App\Http\Controllers\ProductCategory\ProductCategoryGetOneController;
use App\Http\Controllers\ProductCategory\ProductCategoryUpdateController;
use App\Http\Controllers\Subscription\SubscriptionCreateController;
use App\Http\Controllers\Subscription\SubscriptionDeleteController;
use App\Http\Controllers\Subscription\SubscriptionGetAllController;
use App\Http\Controllers\Subscription\SubscriptionGetOneController;
use App\Http\Controllers\Subscription\SubscriptionUpdateController;
use App\Http\Controllers\Authentication\OtpVerificationController;
use App\Http\Controllers\Authentication\ChangePasswordController;
use App\Http\Controllers\Authentication\ForgetPasswordController;
use App\Http\Controllers\UserCompany\UserCompanyCreateController;
use App\Http\Controllers\UserCompany\UserCompanyDeleteController;
use App\Http\Controllers\UserCompany\UserCompanyGetAllController;
use App\Http\Controllers\UserCompany\UserCompanyGetOneController;
use App\Http\Controllers\UserCompany\UserCompanyUpdateController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Company\CompanyCreateController;
use App\Http\Controllers\Company\CompanyDeleteController;
use App\Http\Controllers\Company\CompanyGetAllController;
use App\Http\Controllers\Company\CompanyGetOneController;
use App\Http\Controllers\Company\CompanyUpdateController;
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

	Route::prefix('company')->group(function (): void {
		Route::post('create', [UserCompanyCreateController::class, 'action']);
		Route::get('get', [UserCompanyGetAllController::class, 'action']);
		Route::get('get/{id}', [UserCompanyGetOneController::class, 'action']);
		Route::put('update/{id}', [UserCompanyUpdateController::class, 'action']);
		Route::delete('delete/{id}', [UserCompanyDeleteController::class, 'action']);
	});
});

Route::prefix('company')->group(function (): void {
	Route::post('create', [CompanyCreateController::class, 'action']);
	Route::get('get', [CompanyGetAllController::class, 'action']);
	Route::get('get/{id}', [CompanyGetOneController::class, 'action']);
	Route::put('update/{id}', [CompanyUpdateController::class, 'action']);
	Route::delete('delete/{id}', [CompanyDeleteController::class, 'action']);

	Route::prefix('category')->group(function (): void {
		Route::post('create', [CompanyCategoryCreateController::class, 'action']);
		Route::get('get', [CompanyCategoryGetAllController::class, 'action']);
		Route::get('get/{id}', [CompanyCategoryGetOneController::class, 'action']);
		Route::put('update/{id}', [CompanyCategoryUpdateController::class, 'action']);
		Route::delete('delete/{id}', [CompanyCategoryDeleteController::class, 'action']);
	});
});

Route::prefix('subscription')->group(function (): void {
	Route::post('create', [SubscriptionCreateController::class, 'action']);
	Route::get('get', [SubscriptionGetAllController::class, 'action']);
	Route::get('get/{id}', [SubscriptionGetOneController::class, 'action']);
	Route::put('update/{id}', [SubscriptionUpdateController::class, 'action']);
	Route::delete('delete/{id}', [SubscriptionDeleteController::class, 'action']);

	Route::prefix('payment')->group(function (): void {
		Route::post('create', [PaymentSubscriptionCreateController::class, 'action']);
		Route::get('get', [PaymentSubscriptionGetAllController::class, 'action']);
		Route::get('get/{id}', [PaymentSubscriptionGetOneController::class, 'action']);
		Route::put('update/{id}', [PaymentSubscriptionUpdateController::class, 'action']);
		Route::delete('delete/{id}', [PaymentSubscriptionDeleteController::class, 'action']);
	});
});

Route::prefix('product')->group(function (): void {
	Route::prefix('category')->group(function (): void {
		Route::post('create', [ProductCategoryCreateController::class, 'action']);
		Route::get('get', [ProductCategoryGetAllController::class, 'action']);
		Route::get('get/{id}', [ProductCategoryGetOneController::class, 'action']);
		Route::put('update/{id}', [ProductCategoryUpdateController::class, 'action']);
		Route::delete('delete/{id}', [ProductCategoryDeleteController::class, 'action']);
	});
});
