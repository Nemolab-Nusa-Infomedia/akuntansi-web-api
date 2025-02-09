<?php

use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionCreateController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionDeleteController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionGetAllController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionGetOneController;
use App\Http\Controllers\PaymentSubscription\PaymentSubscriptionUpdateController;
use App\Http\Controllers\TransactionCategory\TransactionCategoryCreateController;
use App\Http\Controllers\TransactionCategory\TransactionCategoryDeleteController;
use App\Http\Controllers\TransactionCategory\TransactionCategoryGetAllController;
use App\Http\Controllers\TransactionCategory\TransactionCategoryGetOneController;
use App\Http\Controllers\TransactionCategory\TransactionCategoryUpdateController;
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
use App\Http\Controllers\ProductRestock\ProductRestockCreateController;
use App\Http\Controllers\ProductRestock\ProductRestockDeleteController;
use App\Http\Controllers\ProductRestock\ProductRestockGetAllController;
use App\Http\Controllers\ProductRestock\ProductRestockGetOneController;
use App\Http\Controllers\ProductRestock\ProductRestockUpdateController;
use App\Http\Controllers\CashflowType\CashflowTypeCreateController;
use App\Http\Controllers\CashflowType\CashflowTypeDeleteController;
use App\Http\Controllers\CashflowType\CashflowTypeGetAllController;
use App\Http\Controllers\CashflowType\CashflowTypeGetOneController;
use App\Http\Controllers\CashflowType\CashflowTypeUpdateController;
use App\Http\Controllers\Subscription\SubscriptionCreateController;
use App\Http\Controllers\Subscription\SubscriptionDeleteController;
use App\Http\Controllers\Subscription\SubscriptionGetAllController;
use App\Http\Controllers\Subscription\SubscriptionGetOneController;
use App\Http\Controllers\Subscription\SubscriptionUpdateController;
use App\Http\Controllers\Authentication\OtpVerificationController;
use App\Http\Controllers\Authentication\ChangePasswordController;
use App\Http\Controllers\Authentication\ForgetPasswordController;
use App\Http\Controllers\ContactType\ContactTypeCreateController;
use App\Http\Controllers\ContactType\ContactTypeDeleteController;
use App\Http\Controllers\ContactType\ContactTypeGetAllController;
use App\Http\Controllers\ContactType\ContactTypeGetOneController;
use App\Http\Controllers\ContactType\ContactTypeUpdateController;
use App\Http\Controllers\UserCompany\UserCompanyCreateController;
use App\Http\Controllers\UserCompany\UserCompanyDeleteController;
use App\Http\Controllers\UserCompany\UserCompanyGetAllController;
use App\Http\Controllers\UserCompany\UserCompanyGetOneController;
use App\Http\Controllers\UserCompany\UserCompanyUpdateController;
use App\Http\Controllers\Transaction\TransactionCreateController;
use App\Http\Controllers\Transaction\TransactionDeleteController;
use App\Http\Controllers\Transaction\TransactionGetAllController;
use App\Http\Controllers\Transaction\TransactionGetOneController;
use App\Http\Controllers\Transaction\TransactionUpdateController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Cashflow\CashflowCreateController;
use App\Http\Controllers\Cashflow\CashflowDeleteController;
use App\Http\Controllers\Cashflow\CashflowGetAllController;
use App\Http\Controllers\Cashflow\CashflowGetOneController;
use App\Http\Controllers\Cashflow\CashflowUpdateController;
use App\Http\Controllers\Company\CompanyCreateController;
use App\Http\Controllers\Company\CompanyDeleteController;
use App\Http\Controllers\Company\CompanyGetAllController;
use App\Http\Controllers\Company\CompanyGetOneController;
use App\Http\Controllers\Contact\ContactCreateController;
use App\Http\Controllers\Contact\ContactDeleteController;
use App\Http\Controllers\Contact\ContactGetAllController;
use App\Http\Controllers\Contact\ContactGetOneController;
use App\Http\Controllers\Contact\ContactUpdateController;
use App\Http\Controllers\Company\CompanyUpdateController;
use App\Http\Controllers\Product\ProductCreateController;
use App\Http\Controllers\Product\ProductDeleteController;
use App\Http\Controllers\Product\ProductGetAllController;
use App\Http\Controllers\Product\ProductGetOneController;
use App\Http\Controllers\Product\ProductUpdateController;
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
	Route::post('create', [ProductCreateController::class, 'action']);
	Route::get('get', [ProductGetAllController::class, 'action']);
	Route::get('get/{id}', [ProductGetOneController::class, 'action']);
	Route::put('update/{id}', [ProductUpdateController::class, 'action']);
	Route::delete('delete/{id}', [ProductDeleteController::class, 'action']);

	Route::prefix('category')->group(function (): void {
		Route::post('create', [ProductCategoryCreateController::class, 'action']);
		Route::get('get', [ProductCategoryGetAllController::class, 'action']);
		Route::get('get/{id}', [ProductCategoryGetOneController::class, 'action']);
		Route::put('update/{id}', [ProductCategoryUpdateController::class, 'action']);
		Route::delete('delete/{id}', [ProductCategoryDeleteController::class, 'action']);
	});

	Route::prefix('restock')->group(function (): void {
		Route::post('create', [ProductRestockCreateController::class, 'action']);
		Route::get('get', [ProductRestockGetAllController::class, 'action']);
		Route::get('get/{id}', [ProductRestockGetOneController::class, 'action']);
		Route::put('update/{id}', [ProductRestockUpdateController::class, 'action']);
		Route::delete('delete/{id}', [ProductRestockDeleteController::class, 'action']);
	});
});

Route::prefix('transaction')->group(function (): void {
	Route::post('create', [TransactionCreateController::class, 'action']);
	Route::get('get', [TransactionGetAllController::class, 'action']);
	Route::get('get/{id}', [TransactionGetOneController::class, 'action']);
	Route::put('update/{id}', [TransactionUpdateController::class, 'action']);
	Route::delete('delete/{id}', [TransactionDeleteController::class, 'action']);

	Route::prefix('category')->group(function (): void {
		Route::post('create', [TransactionCategoryCreateController::class, 'action']);
		Route::get('get', [TransactionCategoryGetAllController::class, 'action']);
		Route::get('get/{id}', [TransactionCategoryGetOneController::class, 'action']);
		Route::put('update/{id}', [TransactionCategoryUpdateController::class, 'action']);
		Route::delete('delete/{id}', [TransactionCategoryDeleteController::class, 'action']);
	});
});

Route::prefix('cashflow')->group(function (): void {
	Route::post('create', [CashflowCreateController::class, 'action']);
	Route::get('get', [CashflowGetAllController::class, 'action']);
	Route::get('get/{id}', [CashflowGetOneController::class, 'action']);
	Route::put('update/{id}', [CashflowUpdateController::class, 'action']);
	Route::delete('delete/{id}', [CashflowDeleteController::class, 'action']);

	Route::prefix('type')->group(function (): void {
		Route::post('create', [CashflowTypeCreateController::class, 'action']);
		Route::get('get', [CashflowTypeGetAllController::class, 'action']);
		Route::get('get/{id}', [CashflowTypeGetOneController::class, 'action']);
		Route::put('update/{id}', [CashflowTypeUpdateController::class, 'action']);
		Route::delete('delete/{id}', [CashflowTypeDeleteController::class, 'action']);
	});
});

Route::prefix('contact')->group(function (): void {
	Route::post('create', [ContactCreateController::class, 'action']);
	Route::get('get', [ContactGetAllController::class, 'action']);
	Route::get('get/{id}', [ContactGetOneController::class, 'action']);
	Route::put('update/{id}', [ContactUpdateController::class, 'action']);
	Route::delete('delete/{id}', [ContactDeleteController::class, 'action']);

	Route::prefix('type')->group(function (): void {
		Route::post('create', [ContactTypeCreateController::class, 'action']);
		Route::get('get', [ContactTypeGetAllController::class, 'action']);
		Route::get('get/{id}', [ContactTypeGetOneController::class, 'action']);
		Route::put('update/{id}', [ContactTypeUpdateController::class, 'action']);
		Route::delete('delete/{id}', [ContactTypeDeleteController::class, 'action']);
	});
});
