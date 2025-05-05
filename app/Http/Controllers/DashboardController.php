<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distance;
use App\Models\ReliefCenter;
use App\Models\SafetyGuideline;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Current readings data
        $latestDistance = Distance::latest()->first();
        $totalDistances = Distance::count();
        
        // Additional metrics
        $totalCenters = ReliefCenter::count();
        $totalGuidelines = SafetyGuideline::count();
        
        // Recent readings (last 10)
        $recentDistances = Distance::latest()->take(100)->get(); // <- changed from 10 to 100
        
        // Danger level statistics
        $dangerLevels = Distance::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');
        
        // Historical data for charts
        $hourlyAverages = Distance::selectRaw('
                HOUR(created_at) as hour, 
                AVG(value) as avg_value,
                COUNT(*) as readings_count
                ')
        ->where('created_at', '>=', now()->subDay())
        ->groupBy(DB::raw('HOUR(created_at)'))
        ->orderBy('hour')
        ->get();
        
        return view('dashboard', compact(
            'latestDistance',
            'totalDistances',
            'totalCenters',
            'totalGuidelines',
            'recentDistances',
            'dangerLevels',
            'hourlyAverages'
        ));
    }
}
