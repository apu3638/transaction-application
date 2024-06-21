<?php

use \Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/v1/transaction', 'namespace' => 'V1', 'middleware' => ['throttle:60,5']], function () {
    Route::post('/mock','TransactionController@mock');
    Route::post('/store','TransactionController@store');
    Route::get('/update','TransactionController@update');
});

