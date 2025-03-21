<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistanceController;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/distance', [DistanceController::class, 'index']);

