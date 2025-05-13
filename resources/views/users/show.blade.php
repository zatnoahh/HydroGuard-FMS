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
                                <i class="fas fa-user me-2"></i>
                                User Details
                            </h3>
                        </div>
                        <span class="badge bg-white text-primary px-3 py-2">
                            Role: {{ $user->role }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Main Information Section -->
                    <div class="text-center mb-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="icon-container bg-primary bg-opacity-10 text-primary rounded-circle">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        </div>
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>

                    <!-- Detail Cards -->
                    <div class="row g-3 mb-4">
                        <!-- Contact Information Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-info-circle me-1"></i> Contact Information
                                    </h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Email</small>
                                            <p class="mb-0 fw-bold">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone-alt text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Phone</small>
                                            <p class="mb-0 fw-bold">{{ $user->phone_number ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="text-uppercase text-muted small fw-bold mb-3">
                                        <i class="fas fa-user-tag me-1"></i> Additional Information
                                    </h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-calendar-alt text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Joined On</small>
                                            <p class="mb-0 fw-bold">{{ $user->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-shield text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Role</small>
                                            <p class="mb-0 fw-bold">{{ $user->role }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between pt-3 border-top">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                        @can('isAdmin')
                        <div class="btn-group">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
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
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
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
