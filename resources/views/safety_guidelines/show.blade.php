@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card Header with Category Badge -->
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-header bg-gradient-{{ 
                    $safetyGuideline->category == 'before a flood' ? 'info' : 
                    ($safetyGuideline->category == 'during a flood' ? 'warning' : 
                    ($safetyGuideline->category == 'after a flood' ? 'success' : 'primary'))
                }} text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">
                                <i class="fas fa-shield-alt me-2"></i>
                                Safety Guideline
                            </h3>
                        </div>
                        <span class="badge bg-white text-{{ 
                            $safetyGuideline->category == 'before a flood' ? 'info' : 
                            ($safetyGuideline->category == 'during a flood' ? 'warning' : 
                            ($safetyGuideline->category == 'after a flood' ? 'success' : 'primary'))
                        }} px-3 py-2 text-capitalize">
                            {{ $safetyGuideline->category }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Main Title Section -->
                    <div class="text-center mb-4">
                        <div class="icon-container bg-{{ 
                            $safetyGuideline->category == 'before a flood' ? 'info' : 
                            ($safetyGuideline->category == 'during a flood' ? 'warning' : 
                            ($safetyGuideline->category == 'after a flood' ? 'success' : 'primary'))
                        }}-subtle text-{{ 
                            $safetyGuideline->category == 'before a flood' ? 'info' : 
                            ($safetyGuideline->category == 'during a flood' ? 'warning' : 
                            ($safetyGuideline->category == 'after a flood' ? 'success' : 'primary'))
                        }} rounded-circle p-4 mb-3 d-inline-block">
                            <i class="fas fa-shield-alt fa-3x"></i>
                        </div>
                        <h2 class="mb-3">{{ $safetyGuideline->title }}</h2>
                    </div>

                    <!-- Guideline Details -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="text-uppercase text-muted small fw-bold mb-3">
                                <i class="fas fa-align-left me-1"></i> Description
                            </h5>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($safetyGuideline->description)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-tags me-1"></i> Category Details
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-{{ 
                                            $safetyGuideline->category == 'before a flood' ? 'cloud-rain' : 
                                            ($safetyGuideline->category == 'during a flood' ? 'water' : 
                                            ($safetyGuideline->category == 'after a flood' ? 'sun' : 'info-circle'))
                                        }} text-{{ 
                                            $safetyGuideline->category == 'before a flood' ? 'info' : 
                                            ($safetyGuideline->category == 'during a flood' ? 'warning' : 
                                            ($safetyGuideline->category == 'after a flood' ? 'success' : 'primary'))
                                        }} me-3 fs-4"></i>
                                        <div>
                                            <small class="text-muted">Guideline Phase</small>
                                            <p class="mb-0 fw-bold text-capitalize">{{ $safetyGuideline->category }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-calendar-alt me-1"></i> Last Updated
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-primary me-3 fs-4"></i>
                                        <div>
                                            <small class="text-muted">Modified Date</small>
                                            <p class="mb-0 fw-bold">{{ $safetyGuideline->updated_at->format('F j, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                        @can('isAdmin')
                        <div class="btn-group">
                            <a href="{{ route('safety_guidelines.edit', $safetyGuideline->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a>
                            <form action="{{ route('safety_guidelines.destroy', $safetyGuideline->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this safety guideline?')">
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
    .icon-container {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e6a000 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
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
    
    .bg-info-subtle {
        background-color: rgba(13, 202, 240, 0.1);
    }
    
    .bg-warning-subtle {
        background-color: rgba(255, 193, 7, 0.1);
    }
    
    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1);
    }
    
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1);
    }
</style>
@endsection