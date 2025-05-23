<?php

namespace App\Http\Controllers;

use App\Models\SafetyGuideline;
use Illuminate\Http\Request;

class SafetyGuidelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SafetyGuideline::query();
        
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }
        
        $safetyGuidelines = $query->paginate(10);
        
        return view('safety_guidelines.index', compact('safetyGuidelines'));
    }

        /**
     * Show the form for creating a new resource.
     */
    public function userIndex(Request $request)
    {
        $query = SafetyGuideline::query();
        
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }
        
        $safetyGuidelines = $query->paginate(10); // Use paginate() to enable pagination

        return view('user.safety_guidelines.index', compact('safetyGuidelines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('admin-access')) {
            return redirect()->route('safety_guidelines.index')->with('error', 'You do not have permission to access this page.');
        }

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
        if (!auth()->user()->can('admin-access')) {
            return redirect()->route('safety_guidelines.index')->with('error', 'You do not have permission to access this page.');
        }
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
