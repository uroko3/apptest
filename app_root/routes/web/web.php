<?php

use App\Http\Controllers\Names\IndexController;
use Illuminate\Support\Facades\Route;

Route::domain('apptest.example.com')->group(function () {
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

	Route::get('/form2', 'FormController@index');
	Route::post('/form2', 'FormController@postValidates');
	
	

	Route::get('/names', [IndexController::class, 'index']);

});


Route::domain('hoge.example.com')->group(function () {
	Route::get('/', function () {
		dd('hoge route');
	});
});
