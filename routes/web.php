<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\ReliefCenterController;
use App\Http\Controllers\SafetyGuidelineController;
use App\Notifications\AlertNotification;
use Illuminate\Support\Facades\Notification;
use App\Mail\AlertEmail;
use Illuminate\Support\Facades\Mail;
use App\Services\WhatsAppService;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('distance', App\Http\Controllers\DistanceController::class);
    Route::resource('reliefCenters', App\Http\Controllers\ReliefCenterController::class);
    Route::resource('safety_guidelines', App\Http\Controllers\SafetyGuidelineController::class);
    Route::resource('threshold', App\Http\Controllers\ThresholdController::class);

    Route::get('/user/safety_guidelines', [SafetyGuidelineController::class, 'userIndex'])->name('user.safety_guidelines.index');
    Route::get('/calendar-data', [DistanceController::class, 'getCalendarData']);

    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});

Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/threshold', [App\Http\Controllers\ThresholdController::class, 'index'])->name('threshold.index');
    Route::resource('users', UserController::class);
});


