<?php

use App\Http\Controllers\Names3\IndexController;
use Illuminate\Support\Facades\Route;

Route::domain('apptest.example.com')->group(function () {
	Route::get('/names3', [IndexController::class, 'index']);
});
