<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/company','CompanyController');

Route::resource('products', 'ProductsController');

Route::resource('tiers', 'TiersController');

Route::resource('taxes', 'TaxesController');

Route::resource('currencies', 'CurrenciesController');

Route::resource('listPrices', 'ListPricesController');

Route::resource('warehouses', 'WarehousesController');

Route::resource('users', 'UsersController');

Route::resource('profile', 'ProfileController');

Route::resource('categoryProducts', 'CategoryProductsController');

Route::resource('sequences', 'SequenceController');

Route::resource('devis', 'DevisController');

Route::resource('receptions', 'ReceptionsController');

Route::resource('stock', 'StockController');

Route::resource('unityProducts', 'UnityProductsController');

Route::resource('replenishment', 'ReplenishmentController');

Route::resource('replenishmentRules', 'ReplenishmentRulesController');

Route::resource('bills', 'BillsController');

//routes pdf
Route::get('/devis/{id}/pdf','DevisController@pdf');
Route::get('/commandes/{id}/pdf','CommandesController@pdf');
Route::get('/bills/{id}/pdf','BillsController@pdf');
Route::get('/retour/{id}/pdf','RetourController@pdf');
Route::get('/receptions/{id}/pdf','ReceptionsController@pdf');



Route::get('/generatesequences','HomeController@generate_sequences')->name('generate.sequences');
Route::get('/validatebill/{id}','BillsController@validatebill')->name('validate.bill');
Route::get('/search', function(){
    return view('search');
});
Route::resource('commandes', 'CommandesController');
Route::get('confirm_purchase/{id}','DevisController@confirm_purchase');
Route::put('receives/{receive}','ReceptionsController@receive');
Route::resource('retour','RetourController');
Route::get('/hh', function(){
    return view('hh');
});
Route::get('/cancel_order/{id}','CommandesController@cancel_order')->name("cancel.order");
Route::get('/cancel_receipt/{id}','ReceptionsController@cancel_receipt')->name("cancel.receipt");
Route::get('/bill_cancel/{id}','BillsController@bill_cancel')->name('bill.cancel');
route::get('luanch/replishippement','ReplenishmentController@luanch_replishippement')->name('luanch.replishippement');
