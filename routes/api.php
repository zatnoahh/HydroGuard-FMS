<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\DistanceController;

use App\Models\Distance;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/distance', [DistanceController::class, 'store']);



// Route::post('/distance', function (Request $request) {
//     $distance = $request->input('distance'); // Get distance from ESP32

//     // Store the latest distance in cache (expires in 60 seconds)
//     Cache::put('latest_distance', $distance, 60);


//     // Save to database if distance is greater than or equal to 30
//     // if ($distance >= 30.00) {
//     //     Distance::create(['value' => $distance]); 
//     // }

//     return response()->json(['message' => 'Distance cached successfully']);
// });

Route::post('/distance', function (Request $request) {
    $distance = $request->input('distance'); // Get distance from ESP32

    // Store latest distance in cache for real-time display
    Cache::put('latest_distance', $distance, 60);

    // Get the last saved timestamp from cache
    $lastSavedTime = Cache::get('last_saved_time', 0);
    $currentTime = now()->timestamp; // Get current timestamp

    // Save to database only if distance <= 20 and at least 30 sec minute has passed
    if ($distance <= 20.00 && ($currentTime - $lastSavedTime >= 30)) {
        Distance::create(['value' => $distance]); 
        Cache::put('last_saved_time', $currentTime, 30); // Update last saved time
    }

    return response()->json(['message' => 'Distance cached successfully']);
});

Route::get('/latest-distance', function () {
    return response()->json(['value' => Cache::get('latest_distance', 'N/A')]);
});

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});
// Route::post('/distance', function (Request $request) {
//     $distance = $request->input('distance');

//     // Log the distance (check storage/logs/laravel.log)
//     \Log::info('Distance Received: ' . $distance);

//     // Save to database (Optional)
//     \App\Models\Distance::create(['value' => $distance]);

//     return response()->json(['message' => 'Distance received!', 'distance' => $distance]);
// });