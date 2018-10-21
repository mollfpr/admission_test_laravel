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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/download', 'HomeController@download')->name('download');

/** TOPUP */
Route::get('/topup', 'TopupController@create')->name('topup');
Route::post('/topup', 'TopupController@store')->name('topup.store');

/** WITHDRAW */
Route::get('/withdraw', 'WithdrawController@create')->name('withdraw');
Route::post('/withdraw', 'WithdrawController@store')->name('withdraw.store');

/** TRANSFER */
Route::get('/transfer', 'TransferController@create')->name('transfer');
Route::post('/transfer', 'TransferController@store')->name('transfer.store');
