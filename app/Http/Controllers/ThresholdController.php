<?php

namespace App\Http\Controllers;

use App\Models\Threshold;
use App\Models\Distance;
use Illuminate\Http\Request;

class ThresholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $thresholds = Threshold::all();

        // Sort thresholds by custom priority
        $statusPriority = ['danger' => 1, 'alert' => 2, 'warning' => 3];

        $thresholds = $thresholds->sortBy(function ($item) use ($statusPriority) {
            return $statusPriority[$item->status] ?? 999;
        })->values();

        $thresholdValues = [
            'danger' => optional($thresholds->firstWhere('status', 'danger'))->value,
            'alert' => optional($thresholds->firstWhere('status', 'alert'))->value,
            'warning' => optional($thresholds->firstWhere('status', 'warning'))->value,
        ];

        // ✅ Fetch and filter distance data
        $query = Distance::query();

        // Filter by status (if provided)
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // Search by water level value
        if ($request->has('search') && $request->search !== null) {
            $query->where('value', 'like', '%' . $request->search . '%');
        }

        // Optional: Only get "danger", "alert", "warning" statuses
        $query->whereIn('status', ['danger', 'alert', 'warning']);

        $distances = $query->latest()->paginate(10);

        return view('threshold.index', compact('thresholds', 'thresholdValues', 'distances'));
    }
        


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('threshold.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'status' => 'required|string|max:255',
        //     'value' => 'required|numeric',
        // ]);

        // Threshold::create($request->all());

        // return redirect()->route('threshold.index')->with('success', 'Threshold created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Threshold $threshold)
    {
        return view('threshold.show', compact('threshold'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Threshold $threshold)
    {
        return view('threshold.edit', compact('threshold'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|numeric|min:0',
        ]);

        $threshold = Threshold::findOrFail($id);
        $threshold->value = $request->input('value');
        $threshold->save();
        

        return redirect()->route('threshold.index')->with('success', 'Threshold updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Threshold $threshold)
    {
        $threshold->delete();

        return redirect()->route('threshold.index')->with('success', 'Threshold deleted successfully.');
    }
}
