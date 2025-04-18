<?php

namespace App\Http\Controllers;

use App\Models\SafetyGuideline;
use Illuminate\Http\Request;

class SafetyGuidelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $safetyGuidelines = SafetyGuideline::all();
        return view('safety_guidelines.index', compact('safetyGuidelines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('safety_guidelines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        SafetyGuideline::create($request->all());

        return redirect()->route('safety_guidelines.index')->with('success', 'Safety guideline created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SafetyGuideline $safetyGuideline)
    {
        return view('safety_guidelines.show', compact('safetyGuideline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SafetyGuideline $safetyGuideline)
    {
        return view('safety_guidelines.edit', compact('safetyGuideline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SafetyGuideline $safetyGuideline)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $safetyGuideline->update($request->all());

        return redirect()->route('safety_guidelines.index')->with('success', 'Safety guideline updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SafetyGuideline $safetyGuideline)
    {
        $safetyGuideline->delete();

        return redirect()->route('safety_guidelines.index')->with('success', 'Safety guideline deleted successfully.');
    }
}
