@extends('layouts.master')

@section('content')
<div class="container py-4">
    <!-- Page Title -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Dashboard</h1>
        <p class="text-muted">Overview of Sensor Readings & System Stats</p>
    </div>

    <!-- Status Cards -->
    <div class="row g-4 mb-5">
        <!-- Latest Distance -->
        <div class="col-md-3">
            <div class="card text-center border-start border-4 border-primary shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Latest Distance</h6>
                    <h3 class="fw-bold text-primary">{{ $latestDistance ?? 'N/A' }} cm</h3>
                </div>
            </div>
        </div>

        <!-- Total Distances -->
        <div class="col-md-3">
            <div class="card text-center border-start border-4 border-info shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Distances Saved</h6>
                    <h3 class="fw-bold text-info">{{ $totalDistances }}</h3>
                </div>
            </div>
        </div>

        <!-- Relief Centers -->
        <div class="col-md-3">
            <div class="card text-center border-start border-4 border-success shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Relief Centers</h6>
                    <h3 class="fw-bold text-success">{{ $totalCenters }}</h3>
                </div>
            </div>
        </div>

        <!-- Safety Guidelines -->
        <div class="col-md-3">
            <div class="card text-center border-start border-4 border-warning shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Safety Guidelines</h6>
                    <h3 class="fw-bold text-warning">{{ $totalGuidelines }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Readings Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recent Distance Readings</h5>
            <small class="text-white-50">Updated {{ now()->diffForHumans() }}</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Distance (cm)</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentDistances as $distance)
                            <tr>
                                <td><span class="badge bg-danger fs-6">{{ $distance->value }}</span></td>
                                <td>{{ $distance->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">No recent readings available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
