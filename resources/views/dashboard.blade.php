@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4 text-center">Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Latest Distance</h5>
                    <p class="card-text">{{ $latestDistance ?? 'N/A' }} cm</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Distances Saved</h5>
                    <p class="card-text">{{ $totalDistances }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Relief Centers</h5>
                    <p class="card-text">{{ $totalCenters }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Safety Guidelines</h5>
                    <p class="card-text">{{ $totalGuidelines }}</p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-xl font-semibold mb-3">Recent Distance Readings</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Value (cm)</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentDistances as $distance)
                    <tr>
                        <td>{{ $distance->value }}</td>
                        <td>{{ $distance->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No recent readings available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

