@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card Header with Status Indicator -->
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-header bg-gradient-{{ $distance->status === 'danger' ? 'danger' : ($distance->status === 'alert' ? 'warning' : 'info') }} text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">
                                <i class="fas fa-tint me-2"></i>
                                Water Level Reading
                            </h3>
                        </div>
                        <span class="badge bg-white text-{{ $distance->status === 'danger' ? 'danger' : ($distance->status === 'alert' ? 'warning' : 'info') }} px-3 py-2">
                            {{ ucfirst($distance->status) }} Level
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Water Level Visualization -->
                    <div class="text-center mb-4">
                        <div class="water-level-indicator mx-auto mb-3" style="width: 120px; height: 120px;">
                            <div class="gauge-body">
                                <div class="gauge-fill" style="height: {{ min(100, ($distance->value / 300) * 100) }}%"></div>
                            </div>
                            <div class="gauge-value">{{ $distance->value }} cm</div>
                        </div>
                        <h5 class="text-muted">Current Water Level</h5>
                    </div>

                    <!-- Detail Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-info-circle me-1"></i> Reading Details
                                    </h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-ruler-vertical text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Measurement</small>
                                            <p class="mb-0 fw-bold">{{ $distance->value }} cm</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-bell text-{{ $distance->status === 'danger' ? 'danger' : ($distance->status === 'alert' ? 'warning' : 'info') }} me-3"></i>
                                        <div>
                                            <small class="text-muted">Status</small>
                                            <p class="mb-0 fw-bold">{{ ucfirst($distance->status) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-clock me-1"></i> Time & Date
                                    </h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar-day text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Date</small>
                                            <p class="mb-0 fw-bold">{{ $distance->created_at->format('F j, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-stopwatch text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Time</small>
                                            <p class="mb-0 fw-bold">{{ $distance->created_at->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="{{ route('distance.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                        @can('isAdmin')
                        <div class="btn-group">
                            <form action="{{ route('distance.destroy', $distance->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reading?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash-alt me-2"></i> Delete
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .water-level-indicator {
        position: relative;
        background-color: #f8f9fa;
        border-radius: 50%;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
        border: 8px solid #e9ecef;
    }
    
    .gauge-body {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .gauge-fill {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #0d6efd;
        border-radius: 0 0 50% 50%;
        transition: height 0.5s ease;
    }
    
    .gauge-value {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        color: #212529;
    }
    
    .bg-gradient-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #fd7e14 0%, #e36209 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
    }
    
    .card {
        border-radius: 0.5rem;
    }
</style>
@endsection