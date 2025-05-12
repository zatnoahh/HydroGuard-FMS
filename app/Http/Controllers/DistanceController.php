<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Distance;
use App\Models\Threshold;
use Carbon\Carbon;

class DistanceController extends Controller
{   

    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        $query = Distance::query()->where('value', '<=', 50.00)->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', strtolower($request->status));
        }

        // Filter by specific date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter by week (expects format: YYYY-Www, e.g., 2025-W19)
        if ($request->filled('week')) {
            try {
                $week = $request->week;
                [$year, $weekNumber] = explode('-W', $week);
                $startOfWeek = Carbon::now()->setISODate($year, $weekNumber)->startOfWeek();
                $endOfWeek = (clone $startOfWeek)->endOfWeek();

                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            } catch (\Exception $e) {
                // Invalid format, ignore
            }
        }

        $distances = $query->paginate(10);
        $thresholds = Threshold::pluck('value', 'status');

        return view('distance.index', compact('distances', 'thresholds'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('admin-access')) {
            return redirect()->route('distance.index')->with('error', 'You do not have permission to access this page.');
        }

        return view('distance.create');
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'distance' => 'required|numeric',
        ]);

        Distance::create(['distance' => $request->distance]);

        return response()->json(['message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Distance $distance)
    {
        return view('distance.show', compact('distance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distance $distance)
    {
        if (!auth()->user()->can('admin-access')) {
            return redirect()->route('distance.index')->with('error', 'You do not have permission to access this page.');
        }
        return view('distance.edit', compact('distance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distance $distance)
    {
        $request->validate([
            'value' => 'required|numeric',
        ]);

        $distance->update($request->all());
        return redirect()->route('distance.index')->with('success', 'Distance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distance $distance)
    {
        $distance->delete();
        return redirect()->route('distance.index')->with('success', 'Distance deleted successfully.');
    }

    /**
     * Calendar data for the calendar view.
     */
    public function getCalendarData()
    {
        // Group by date and status
        $data = Distance::selectRaw('DATE(created_at) as date, status, COUNT(*) as total')
            ->groupBy('date', 'status')
            ->orderBy('date', 'asc')
            ->get();

        $events = [];

        foreach ($data as $record) {
            $color = match (strtolower($record->status)) {
                'warning' => '#ffc107', // yellow
                'alert' => '#fd7e14',   // orange
                'danger' => '#dc3545',  // red
                default => '#0d6efd'    // fallback (blue)
            };

            $events[] = [
                'title' => ucfirst($record->status) . ' - ' . $record->total,
                'start' => $record->date,
                'allDay' => true,
                'color' => $color
            ];
        }

        return response()->json($events);
    }


}
