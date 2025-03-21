<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distance;

class DistanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'distance' => 'required|numeric',
        ]);

        Distance::create(['distance' => $request->distance]);

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function index()
    {
        $distances = Distance::latest()->get(); // Fetch only saved data
        return view('distance', compact('distances'));
    }
}