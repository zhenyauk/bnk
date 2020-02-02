<?php

Route::get('/login', 'HomeController@index');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function(){

    Route::get('home', 'Admin\HomeController@index')->name('home');
    Route::get('/', 'Admin\HomeController@index')->name('home');
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('accounts', 'Admin\AccountController@index')->name('accounts');
    Route::get('accounts/{id}', 'Admin\AccountController@bills')->name('account.bills');
    Route::any('account', 'Admin\AccountController@show')->name('account.show');
    //import
    Route::get('import', 'ImportController@index');
    Route::post('import', 'ImportController@import')->name('import');

    Route::any('transactions', 'Admin\TransactionController@index')->name('transaction.show');
    Route::any('transactions/arhive', 'Admin\TransactionController@arhive')->name('transaction.arhive');;



});
