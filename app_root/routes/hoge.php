<?php

// RouteServiceProvider.phpにprefix=hogeの設定をしているので/hogeの記述は必要なし
Route::get('/', 'App\Http\Controllers\HogeController@index');
Route::get('/index', 'App\Http\Controllers\HogeController@index');