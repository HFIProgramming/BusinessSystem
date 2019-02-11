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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', 'UserController@index')->name('dashboard');

	Route::group(['middleware' => 'suspend'], function () {

		Route::group(['prefix' => 'transaction'], function () {
			Route::get('/list', 'TransactionController@showTransactionList')->name('TransactionList');
			Route::get('/income', 'TransactionController@showIncomeCreateForm')->name('TransIn');//买
			Route::post('/income', 'TransactionController@buyFromUser')->name('doTransIn');
			Route::get('/outcome', 'TransactionController@showOutcomeCreateForm')->name('TransOut');//卖
			Route::post('/outcome', 'TransactionController@sellToUser')->name('doTransOut');
			Route::post('/confirm', 'TransactionController@handleTransaction')->name('confirmTrans');
		});

		Route::group(['prefix' => 'resource'], function () {
			Route::get('/list', 'HomeController@showResource')->name('resource');
			Route::get('/{id}', 'HomeController@showIndividualResource');
			Route::get('/purchase', 'PurchaseController@showPurchaseForm')->name('purchaseForm');
			Route::post('/purchase', 'PurchaseController@TopUp')->name('doPurchase');
			Route::get('/build', 'PurchaseController@showBuildForm')->name('buildForm');
			Route::post('/build', 'PurchaseController@buildArchitecture')->name('build');
		});

		Route::group(['prefix' => 'loan'], function () {
			Route::get('/create', 'LoanController@displayCreateForm')->name('loanForm');
			Route::get('/list', 'LoanController@listLoans')->name('listLoans');
			Route::post('/create', 'LoanController@grantLoan')->name('grantLoan');
			Route::post('/handle', 'LoanController@handleLoan')->name('handleLoan');
			Route::post('/redeem', 'LoanController@redeemLoan')->name('redeemLoan');
		});

		Route::group(['prefix' => 'auction'], function () {
			Route::get('/create', 'AuctionController@showBidForm')->name('createAuctionBid');
			Route::post('/create', 'AuctionController@submitBid')->name('submitAuctionBid');
			Route::get('/list', 'AuctionController@listBids')->name('listAuctionBid');
		});

		Route::group(['prefix' => 'acquisition'], function () {
			Route::get('/create', 'AcquisitionController@showBidForm')->name('createAcquisitionBid');
			Route::post('/create', 'AcquisitionController@submitBids')->name('submitAcquisitionBids');
			Route::get('/list', 'AcquisitionController@listBids')->name('listAcquisitionBids');
		});
	});

	Route::group(['prefix' => 'announcement'], function () {
		Route::get('/', 'HomeController@showAnnouncement')->name('announcement');
	});

	Route::group(['prefix' => 'zones'], function () {
		Route::get('/', 'HomeController@showZones')->name('zones');
	});

	Route::group(['prefix' => 'bills'], function () {
		Route::get('/', 'HomeController@showBills')->name('bills');
	});

	Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
		Route::get('/', 'AdminController@showDashboard')->name('adminDashboard');
		Route::get('/announcement', 'AnnouncementController@showForm')->name('addAnnouncement');
		Route::post('/announcement', 'AnnouncementController@addAnnouncement');
		Route::get('/log', 'LogController@showLogs')->name('showLogs');
		Route::get('/refreshUserResource', 'AdminController@refreshUserResource');
		Route::get('/company_stat', 'AdminController@showCompanyStats')->name('companyStats');
		Route::get('/bank_stat', 'AdminController@showBankStats')->name('bankStats');
		Route::get('/godLogin', 'AdminController@godLogin');
		Route::group(['prefix' => 'fiscal_year'], function () {
			Route::get('/show', 'RoundController@show')->name('showRound');
			Route::post('/change_total', 'RoundController@changeTotal')->name('changeTotalRound');
			Route::post('/change_current', 'RoundController@changeCurrent')->name('changeCurrentRound');
			Route::get('/submit_EOY', 'RoundController@submitYear')->name('submitYear');
		});
		Route::group(['prefix' => 'auction'], function () {
			Route::get('/showControl', 'AuctionController@showAuctionControlPanel')->name('auctionControl');
			Route::post('/setStatus', 'AuctionController@setStatus')->name('setAuctionStatus');
			Route::post('/setAmount', 'AuctionController@setAmount')->name('setAuctionAmount');
			Route::get('/doTransactions', 'AuctionController@doTransactions')->name('doAuctionTransactions');
		});
		Route::group(['prefix' => 'acquisition'], function () {
			Route::get('/showControl', 'AcquisitionController@showAcquisitionControlPanel')->name('AcquisitionControl');
			Route::get('/setStatus', 'AcquisitionController@setStatus')->name('setAcquisitionStatus');
			Route::post('/setAmount', 'AcquisitionController@setAmount')->name('setAcquisitionAmount');
			Route::get('/doTransactions', 'AcquisitionController@doTransactions')->name('doAcquisitionTransactions');
		});
	});
});