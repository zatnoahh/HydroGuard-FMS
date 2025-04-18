<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     /**
//      * Display the dashboard.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function index()
//     {
//         return view('dashboard');
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Distance;
use App\Models\ReliefCenter;
use App\Models\SafetyGuideline;

class DashboardController extends Controller
{
    public function index()
    {
        $latestDistance = Cache::get('latest_distance');
        $totalDistances = Distance::count();
        $totalCenters = ReliefCenter::count();
        $totalGuidelines = SafetyGuideline::count();
        $recentDistances = Distance::latest()->take(5)->get();

        return view('dashboard', compact(
            'latestDistance',
            'totalDistances',
            'totalCenters',
            'totalGuidelines',
            'recentDistances'
        ));
    }
}

