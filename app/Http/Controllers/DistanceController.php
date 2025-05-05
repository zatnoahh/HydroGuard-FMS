<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Distance;
use App\Models\Threshold;

class DistanceController extends Controller
{   

    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        // Start the query
        $query = Distance::query()->where('value', '<=', 50.00)->latest();

        // Apply status filter if present
        if ($request->filled('status')) {
            $query->where('status', strtolower($request->status));
        }

        // Paginate the final query
        $distances = $query->paginate(10);

        // Fetch thresholds (for display or logic)
        $thresholds = Threshold::pluck('value', 'status');

        return view('distance.index', compact('distances', 'thresholds'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
}
