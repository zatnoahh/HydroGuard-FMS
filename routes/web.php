<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\ReliefCenterController;
use App\Http\Controllers\SafetyGuidelineController;



Route::get('/', function () {
    return view('welcome');
});

Route::resource('distance', App\Http\Controllers\DistanceController::class);
Route::resource('reliefCenters', App\Http\Controllers\ReliefCenterController::class);
Route::resource('safety_guidelines', App\Http\Controllers\SafetyGuidelineController::class);
Route::resource('threshold', App\Http\Controllers\ThresholdController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
