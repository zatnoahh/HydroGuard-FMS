@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card Header with Icon -->
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">
                                <i class="fas fa-home me-2"></i>
                                Relief Center Details
                            </h3>
                        </div>
                        <span class="badge bg-white text-primary px-3 py-2">
                            Capacity: {{ $reliefCenter->capacity }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Main Information Section -->
                    <div class="text-center mb-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="icon-container bg-primary bg-opacity-10 text-primary rounded-circle">
                                <i class="fas fa-home fa-3x"></i>
                            </div>
                        </div>
                        <h4 class="mb-1">{{ $reliefCenter->name }}</h4>
                        <p class="text-muted">{{ $reliefCenter->service }}</p>
                    </div>

                    <!-- Detail Cards -->
                    <div class="row g-3 mb-4">
                        <!-- Location Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-map-marker-alt me-1"></i> Location Details
                                    </h6>
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="fas fa-map-pin text-primary mt-1 me-3"></i>
                                        <div>
                                            <small class="text-muted">Full Address</small>
                                            <p class="mb-0 fw-bold">{{ $reliefCenter->location }}</p>
                                        </div>
                                    </div>
                                    <!-- Map placeholder - you can add actual map integration here -->
                                    <div class="ratio ratio-16x9 bg-light rounded mt-2">
                                        <div class="d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-map-marked-alt fa-2x me-2"></i>
                                            Map View
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Services & Contact Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-info-circle me-1"></i> Center Information
                                    </h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-users text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Capacity</small>
                                            <p class="mb-0 fw-bold">{{ $reliefCenter->capacity }} people</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-concierge-bell text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Services Provided</small>
                                            <p class="mb-0 fw-bold">{{ $reliefCenter->service }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone-alt text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Contact Information</small>
                                            <p class="mb-0 fw-bold">{{ $reliefCenter->contact_info }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="{{ route('reliefCenters.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                        <div class="btn-group">
                            <a href="{{ route('reliefCenters.edit', $reliefCenter->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a>
                            <form action="{{ route('reliefCenters.destroy', $reliefCenter->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this relief center?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash-alt me-2"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-container {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* padding: 0; Ensure no extra padding affects centering */
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    }
    
    .card {
        border-radius: 0.5rem;
    }
    
    .btn-group .btn {
        border-radius: 0;
    }
    
    .btn-group .btn:first-child {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    
    .btn-group .btn:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
</style>
@endsection