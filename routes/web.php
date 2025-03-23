<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistanceController;



Route::get('/', function () {
    return view('welcome');
});

Route::resource('distance', App\Http\Controllers\DistanceController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
