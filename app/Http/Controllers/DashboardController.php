<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distance;
use App\Models\ReliefCenter;
use App\Models\SafetyGuideline;
use App\Models\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        // Current water level data
        $latestDistance = Distance::latest()->first();
        $totalDistances = Distance::count();
        
        // System resources
        $totalCenters = ReliefCenter::count();
        $totalGuidelines = SafetyGuideline::count();
        
        // Recent readings for table
        // $recentDistances = Distance::with('sensor')
        //     ->latest()
        //     ->take(10)
        //     ->get()
        //     ->map(function ($reading) {
        //         // Determine status based on value
        //         if ($reading->value > 150) {
        //             $reading->status = 'danger';
        //             $reading->status_color = 'danger';
        //             $reading->status_icon = 'exclamation-triangle';
        //         } elseif ($reading->value > 100) {
        //             $reading->status = 'warning';
        //             $reading->status_color = 'warning';
        //             $reading->status_icon = 'exclamation-circle';
        //         } else {
        //             $reading->status = 'normal';
        //             $reading->status_color = 'success';
        //             $reading->status_icon = 'check-circle';
        //         }
        //         return $reading;
        //     });
        
        // Recent alerts
        // $recentAlerts = Alert::latest()->take(3)->get();
        
        // Chart data (last 24 hours)
        $chartData = $this->getChartData();
        
        // System status
        $alertStatus = $this->getSystemStatus($latestDistance);
        $waterLevelPercentage = min(100, max(0, ($latestDistance->value / 200) * 100));
        
        return view('dashboard', compact(
            'latestDistance',
            'totalDistances',
            'totalCenters',
            'totalGuidelines',
            // 'recentDistances',
            // 'recentAlerts',
            'chartData',
            'alertStatus',
            'waterLevelPercentage'
        ));
    }
    
    protected function getChartData()
    {
        $readings = Distance::where('created_at', '>=', now()->subDay())
            ->orderBy('created_at')
            ->get();
            
        $labels = $readings->map(function ($reading) {
            return $reading->created_at->format('H:i');
        });
        
        $values = $readings->pluck('value');
        
        return [
            'labels' => $labels,
            'values' => $values
        ];
    }
    
    protected function getSystemStatus($latestReading)
    {
        if (!$latestReading) {
            return [
                'text' => 'Offline',
                'color' => 'secondary',
                'icon' => 'power-off',
                'message' => 'No recent sensor data available'
            ];
        }
        
        if ($latestReading->value > 150) {
            return [
                'text' => 'Danger',
                'color' => 'danger',
                'icon' => 'exclamation-triangle',
                'message' => 'Immediate action required - flood risk high'
            ];
        } elseif ($latestReading->value > 100) {
            return [
                'text' => 'Warning',
                'color' => 'warning',
                'icon' => 'exclamation-circle',
                'message' => 'Potential flood risk - monitor closely'
            ];
        }
        
        return [
            'text' => 'Normal',
            'color' => 'success',
            'icon' => 'check-circle',
            'message' => 'No immediate flood risk detected'
        ];
    }
}