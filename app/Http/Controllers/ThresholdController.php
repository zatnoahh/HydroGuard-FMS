<?php

namespace App\Http\Controllers;

use App\Models\Threshold;
use Illuminate\Http\Request;

class ThresholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thresholds = Threshold::all();
    
        // Sort by custom priority
        $statusPriority = ['danger' => 1, 'alert' => 2, 'warning' => 3];
    
        $thresholds = $thresholds->sortBy(function ($item) use ($statusPriority) {
            return $statusPriority[$item->status] ?? 999;
        })->values(); // Reset collection keys after sort
    
        $thresholdValues = [
            'danger' => optional($thresholds->firstWhere('status', 'danger'))->value,
            'alert' => optional($thresholds->firstWhere('status', 'alert'))->value,
            'warning' => optional($thresholds->firstWhere('status', 'warning'))->value,
        ];
    
        return view('threshold.index', compact('thresholds', 'thresholdValues'));
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
