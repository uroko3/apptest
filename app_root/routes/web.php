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
    return view('home');
});


Route::get('/home', function () {
	return view('home');
})->middleware(['home']);

Route::get('/auth/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/auth/register', 'Auth\RegisterController@register');

Route::get('/auth/login', 'Auth\LoginController@showLoginForm');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::get('/auth/logout', 'Auth\LoginController@logout');

Route::get('/form', 'TestController@form');
Route::post('/form', 'TestController@confirm');
Route::post('/form/complete', 'TestController@complete');

Route::group(['prefix' => 'gitlab'], function(){
	Route::get('', 'GitlabController@index')->name('gitlab');
	Route::get('oauth', 'GitlabController@oauth')->name('aouth');
	Route::get('ggg', 'GitlabController@ggg');
	Route::get('password', 'GitlabController@password');
});


