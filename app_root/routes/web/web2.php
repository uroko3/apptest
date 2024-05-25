<?php

use App\Http\Controllers\Names2\IndexController;
use Illuminate\Support\Facades\Route;

Route::domain('apptest.example.com')->group(function () {
	Route::get('/names2', [IndexController::class, 'index']);
});
	
