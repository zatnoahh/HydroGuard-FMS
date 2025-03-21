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

Route::post('/distance', function (Request $request) {
    $distance = $request->input('distance'); // Get distance from ESP32

    // Store the latest distance in cache (expires in 60 seconds)
    Cache::put('latest_distance', $distance, 60);


    // Save to database if distance is greater than or equal to 30
    // if ($distance >= 30.00) {
    //     Distance::create(['value' => $distance]); 
    // }

    return response()->json(['message' => 'Distance cached successfully']);
});



// Route::get('/latest-distance', function () {
//     return Distance::latest()->first();
// });

Route::get('/latest-distance', function () {
    return response()->json(['value' => Cache::get('latest_distance', 'No Data')]);
});


