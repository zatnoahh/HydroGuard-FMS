<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\DistanceController;

use App\Models\Distance;
use App\Models\Threshold;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/distance', [DistanceController::class, 'store']);

Route::post('/distance', function (Request $request) {
    $distance = $request->input('distance');

    if ($distance == 0) {
        return response()->json(['message' => 'Distance is zero, not processed']);
    }

    Cache::put('latest_distance', $distance, 60);

    $thresholds = Threshold::pluck('value', 'status'); // Flip it

    $status = null;

    if (isset($thresholds['danger']) && $distance <= $thresholds['danger']) {
        $status = 'danger';
    } elseif (isset($thresholds['alert']) && $distance <= $thresholds['alert']) {
        $status = 'alert';
    } elseif (isset($thresholds['warning']) && $distance <= $thresholds['warning']) {
        $status = 'warning';
    }

    if ($status) {
        $lastSavedTime = Cache::get('last_saved_time', 0);
        $currentTime = now()->timestamp;

        // Check if 60 seconds have passed since the last save = can be change
        if ($currentTime - $lastSavedTime >= 60) {// 60 second before saved new data to table
            Distance::create([
                'value' => $distance,
                'status' => $status
            ]);
            Cache::put('last_saved_time', $currentTime, 60);
        }
    }

    return response()->json(['message' => 'Distance processed']);
});



Route::get('/latest-distance', function () {
    return response()->json(['value' => Cache::get('latest_distance', '--')]);
});

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});