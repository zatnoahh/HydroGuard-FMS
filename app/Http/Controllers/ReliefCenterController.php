<?php

namespace App\Http\Controllers;

use App\Models\ReliefCenter;
use Illuminate\Http\Request;

class ReliefCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ReliefCenter::query();
        //Search functionality
        $search = request()->query('search');
        if ($search) {
            $reliefCenters = ReliefCenter::where('name', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->paginate(10);
        } else {
            $reliefCenters = ReliefCenter::paginate(10);
        }

        $totalcenters = ReliefCenter::count();
        $totalcapacity = ReliefCenter::sum('capacity');
        $averagecapacity = ReliefCenter::avg('capacity');

        return view('reliefCenters.index', compact('reliefCenters', 'totalcenters', 'totalcapacity', 'averagecapacity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('admin-access')) {
            return redirect()->route('reliefCenters.index')->with('error', 'You do not have permission to access this page.');
        }
        return view('reliefCenters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'capacity' => 'required',
        ]);

        ReliefCenter::create($request->all());
        return redirect()->route('reliefCenters.index')->with('success', 'Relief Center created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReliefCenter $reliefCenter)
    {
        return view('reliefCenters.show', compact('reliefCenter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReliefCenter $reliefCenter)
    {
        if (!auth()->user()->can('admin-access')) {
            return redirect()->route('reliefCenters.index')->with('error', 'You do not have permission to access this page.');
        }
        return view('reliefCenters.edit', compact('reliefCenter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReliefCenter $reliefCenter)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'capacity' => 'required',
        ]);

        $reliefCenter->update($request->all());
        return redirect()->route('reliefCenters.index')->with('success', 'Relief Center updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReliefCenter $reliefCenter)
    {
        $reliefCenter->delete();
        return redirect()->route('reliefCenters.index')->with('success', 'Relief Center deleted successfully.');
    }
}
