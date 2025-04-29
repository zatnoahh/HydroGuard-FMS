<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\DistanceController;
use App\Notifications\AlertNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Distance;
use App\Models\Threshold;
use Illuminate\Support\Facades\Mail; // Add this at the top if not added
use App\Mail\AlertEmail; // Import your new AlertEmail class


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

        if ($currentTime - $lastSavedTime >= 60) {
            // 👉 Save distance to DB
            $saved = Distance::create([
                'value' => $distance,
                'status' => $status
            ]);

            Cache::put('last_saved_time', $currentTime, 60);

            // 👉 If status is 'alert' and save success, send email (only once until status change)
            if ($saved && $status === 'alert') {
                $lastStatus = Cache::get('last_status', null);

                if ($lastStatus !== 'alert') {
                    Mail::to('syahmiizzat550@gmail.com')->send(new AlertEmail($distance));
                }

                // Update last_status in cache
                Cache::put('last_status', 'alert');
            } else {
                // Update last_status for other statuses (danger/warning/normal)
                Cache::put('last_status', $status);
            }
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