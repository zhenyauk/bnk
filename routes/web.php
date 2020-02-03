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
    Route::any('transactions/arhive', 'Admin\TransactionController@arhive')->name('transaction.arhive');
    Route::any('transactions/in', 'Admin\TransactionController@getIn')->name('transaction.in');
    Route::any('transactions/out', 'Admin\TransactionController@getOut')->name('transaction.out');

    //Платеж
    Route::any('payment/add', 'Admin\PaymentController@add')->name('payment.add');

    Route::get('payment/between', 'Admin\PaymentBetweenController@index')->name('between.index');



    Route::any('test', 'TestController@index')->name('test');;



});
