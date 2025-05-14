@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            </div>
            @endif

            <!-- Vertical Profile Card -->
            <div class="card shadow-sm border-0">
                <!-- Profile Header -->
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex align-items-center">
                        <!-- Avatar -->
                        <div class="avatar-container me-3">
                            <div class="avatar bg-primary text-white">
                                @if($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="Profile" class="img-fluid rounded-circle">
                                @else
                                    <span class="initials">{{ substr($user->name, 0, 1) }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- User Info -->
                        <div class="user-info">
                            <h3 class="mb-1">{{ $user->name }}</h3>
                            <p class="text-muted mb-2">{{ $user->email }}</p>
                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Profile Body -->
                <div class="card-body pt-0">
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profile
                        </a>
                    </div>

                    <!-- Vertical Details List -->
                    <div class="profile-details">
                        <!-- Name -->
                        <div class="detail-item border-bottom py-3">
                            <div class="d-flex justify-content-between">
                                <div class="detail-label">
                                    <i class="bi bi-person text-muted me-2"></i>
                                    <span class="text-muted">Full Name</span>
                                </div>
                                <div class="detail-value fw-semibold">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="detail-item border-bottom py-3">
                            <div class="d-flex justify-content-between">
                                <div class="detail-label">
                                    <i class="bi bi-envelope text-muted me-2"></i>
                                    <span class="text-muted">Email</span>
                                </div>
                                <div class="detail-value fw-semibold">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="detail-item border-bottom py-3">
                            <div class="d-flex justify-content-between">
                                <div class="detail-label">
                                    <i class="bi bi-phone text-muted me-2"></i>
                                    <span class="text-muted">Phone</span>
                                </div>
                                <div class="detail-value fw-semibold">
                                    {{ $user->phone_number ?? 'Not provided' }}
                                </div>
                            </div>
                        </div>

                        <!-- Role -->
                        <!-- <div class="detail-item py-3">
                            <div class="d-flex justify-content-between">
                                <div class="detail-label">
                                    <i class="bi bi-shield-check text-muted me-2"></i>
                                    <span class="text-muted">Account Type</span>
                                </div>
                                <div class="detail-value">
                                    <span class="badge bg-primary bg-opacity-10 text-primary text-capitalize">
                                        {{ $user->role }}
                                    </span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-clock-history me-1"></i>
                        Updated {{ $user->updated_at->diffForHumans() }}
                    </small>
                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Avatar Styles */
    .avatar-container {
        width: 80px;
        height: 80px;
    }
    
    .avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
        border: 3px solid white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .avatar .initials {
        line-height: 1;
    }
    
    /* Detail Items */
    .profile-details {
        background-color: #f9fafb;
        border-radius: 8px;
        padding: 0 15px;
    }
    
    .detail-item {
        transition: background-color 0.2s;
    }
    
    .detail-item:hover {
        background-color: rgba(78, 115, 223, 0.03);
    }
    
    .detail-label {
        display: flex;
        align-items: center;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .avatar-container {
            width: 60px;
            height: 60px;
        }
        
        .user-info h3 {
            font-size: 1.25rem;
        }
        
        .card-footer {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
    }
</style>
@endsection