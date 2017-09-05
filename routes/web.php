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

Route::get('/', 'HomeController@index')->name('index');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::group(['middleware' => 'register'], function () {
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register');
});

Route::get('error', 'HomeController@showErrorPage')->name('error');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', 'UserController@index')->name('dashboard');

	Route::group(['prefix' => 'transaction'], function () {
		Route::get('/list', 'TransactionController@showTransactionList')->name('TransactionList');
		Route::get('/income', 'TransactionController@showIncomeCreateForm')->name('TransIn');//买
		Route::post('/income', 'TransactionController@buyFromUser')->name('doTransIn');
		Route::get('/outcome', 'TransactionController@showOutcomeCreateForm')->name('TransOut');//卖
		Route::post('/outcome', 'TransactionController@sellToUser')->name('doTransOut');
		Route::post('/confirm', 'TransactionController@handleTransaction')->name('confirmTrans');
		Route::get('/{id}', 'TransactionController@showTransaction');
	});

	Route::group(['prefix' => 'resource'], function () {
		Route::get('/list', 'HomeController@showResource')->name('resource');
		Route::get('/{id}', 'HomeController@showIndividualResource');
		Route::get('/purchase', 'PurchaseController@showPurchaseForm')->name('purchaseForm');
		Route::post('/purchase', 'PurchaseController@TopUp')->name('doPurchase');
	});

	Route::group(['prefix' => 'announcement'], function () {
		Route::get('/', 'HomeController@showAnnouncement')->name('announcement');
	});

	Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
		Route::get('/', 'AdminController@showDashboard')->name('adminDashboard');
	});
});

