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

	Route::group(['middleware' => 'suspend'], function () {

		Route::group(['prefix' => 'transaction'], function () {
			Route::get('/list', 'TransactionController@showTransactionList')->name('TransactionList');
			Route::get('/income', 'TransactionController@showIncomeCreateForm')->name('TransIn');//买
			Route::post('/income', 'TransactionController@buyFromUser')->name('doTransIn');
			Route::get('/outcome', 'TransactionController@showOutcomeCreateForm')->name('TransOut');//卖
			Route::post('/outcome', 'TransactionController@sellToUser')->name('doTransOut');
			Route::get('/buygov', 'TransactionController@showBuyGovCreateForm')->name('BuyGov');//从政府买
			Route::post('/buygov', 'TransactionController@buyFromGovernment')->name('doBuyGov');
			Route::get('/sellgov', 'TransactionController@showSellGovCreateForm')->name('SellGov');//向政府卖
			Route::post('/sellgov', 'TransactionController@sellToGovernment')->name('doSellGov');
			Route::post('/confirm', 'TransactionController@handleTransaction')->name('confirmTrans');
		});

		Route::group(['prefix' => 'resource'], function () {
			Route::get('/list', 'HomeController@showResource')->name('resource');
			Route::get('/{id}', 'HomeController@showIndividualResource');
			Route::get('/purchase', 'PurchaseController@showPurchaseForm')->name('purchaseForm');
			Route::post('/purchase', 'PurchaseController@TopUp')->name('doPurchase');
		});

		Route::group(['prefix' => 'technology'], function () {
			Route::get('/show', 'TechnologyController@showTechPage')->name('showTech');
			Route::get('/update', 'TechnologyController@updateTech')->name('updateTech');
		});
	});
	Route::group(['prefix' => 'announcement'], function () {
		Route::get('/', 'HomeController@showAnnouncement')->name('announcement');
	});

	Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
		Route::get('/', 'AdminController@showDashboard')->name('adminDashboard');
		Route::get('/announcement', 'AnnouncementController@showForm')->name('addAnnouncement');
		Route::post('/announcement', 'AnnouncementController@addAnnouncement');
		Route::get('/log', 'LogController@showLogs')->name('showLogs');
		Route::get('/refreshUserResource', 'AdminController@refreshUserResource');
		Route::get('/acquisition_price/list', 'ResourceController@listBots')->name('listBots');
		Route::post('/acquisition_price/update', 'ResourceController@updateBots')->name('updateBots');
		Route::get('/employment_price/list', 'ResourceController@listMiners')->name('listMiners');
		Route::post('/employment_price/update', 'ResourceController@updateMiners')->name('updateMiners');
		Route::get('/fiscal_year/show', 'RoundController@show')->name('showRound');
		Route::post('/fiscal_year/change_total', 'RoundController@changeTotal')->name('changeTotalRound');
		Route::post('/fiscal_year/change_current', 'RoundController@changeCurrent')->name('changeCurrentRound');
	});
});

