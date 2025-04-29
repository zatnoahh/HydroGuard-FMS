<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\ReliefCenterController;
use App\Http\Controllers\SafetyGuidelineController;
use App\Notifications\AlertNotification;
use Illuminate\Support\Facades\Notification;
use App\Mail\AlertEmail;
use Illuminate\Support\Facades\Mail;



Route::get('/', function () {
    return view('welcome');
});

Route::resource('distance', App\Http\Controllers\DistanceController::class);
Route::resource('reliefCenters', App\Http\Controllers\ReliefCenterController::class);
Route::resource('safety_guidelines', App\Http\Controllers\SafetyGuidelineController::class);
Route::resource('threshold', App\Http\Controllers\ThresholdController::class);
Route::get('/user/safety_guidelines', [SafetyGuidelineController::class, 'userIndex'])->name('user.safety_guidelines.index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// Route::get('/test-alert-email', function () {
//     $fakeDistance = 35; // Assume water level = 35 cm (example)

//     Notification::route('mail', 'syahmiizzat550@gmail.com')
//         ->notify(new AlertNotification($fakeDistance));

//     return 'Test Alert Email Sent!';
// });

Route::get('/test-alert-email', function () {
    $testDistance = 35; // Example distance value

    Mail::to('syahmiizzat550@gmail.com')->send(new AlertEmail($testDistance));

    return "Test Alert Email Sent!";
});