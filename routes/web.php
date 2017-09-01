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
	return Redirect('login');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', 'UserController@index')->name('dashboard');

	Route::group(['prefix' => 'transaction'], function(){
		Route::get('/', 'TransactionController@showTransLanding')->name('TransLanding');
		Route::get('/list', 'TransactionController@showTransactionList')->name('TransactionList');
		Route::get('/income', 'TransactionController@showIncomeCreateForm')->name('TransIn');
		Route::get('/outcome', 'TransactionController@showOutcomeCreateForm')->name('TransOut');
	});

	Route::group(['prefix' => 'resource'], function(){
		Route::get('/list', 'HomeController@showResource')->name('resource');
		Route::get('/{id}', 'HomeController@showIndividualResource');
	});


});

