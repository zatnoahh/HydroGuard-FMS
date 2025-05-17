@extends('layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Left Side - Profile Preview -->
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person-circle text-primary me-2"></i>Profile Preview
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="avatar-preview mx-auto mb-3">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="Profile" class="img-fluid rounded-circle">
                            @else
                                <div class="initials-avatar bg-primary text-white">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ ucfirst($user->role) }}</span>
                    </div>

                    <div class="profile-preview-details">
                        <div class="detail-item border-bottom py-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Phone</span>
                                <span class="fw-semibold">{{ $user->phone_number ?? 'Not provided' }}</span>
                            </div>
                        </div>
                        <div class="detail-item border-bottom py-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Updated</span>
                                <span class="fw-semibold">{{ $user->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="detail-item py-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Member Since</span>
                                <span class="fw-semibold">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h5 fw-bold mb-0">
                                <i class="bi bi-person-gear text-primary me-2"></i>Edit Profile
                            </h2>
                            <p class="text-muted small mb-0">Update your account information</p>
                        </div>
                        <a href="{{ route('profile.show') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <div>
                                    <h6 class="mb-1">Please fix these issues:</h6>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Left Column Fields -->
                            <div class="col-md-6">
                                <!-- Name Field -->
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-semibold">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-person text-muted"></i>
                                        </span>
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name', $user->name) }}" required autofocus>
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>

                                <!-- Phone Field -->
                                <div class="mb-4">
                                    <label for="phone_number" class="form-label fw-semibold">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-telephone text-muted"></i>
                                        </span>
                                        <input id="phone_number" type="text" class="form-control" name="phone_number"
                                               value="{{ old('phone_number', $user->phone_number) }}"
                                               placeholder="Optional">
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column Fields -->
                            <div class="col-md-6">
                                <!-- Password Section -->
                                <div class="border-start ps-4">
                                    <h5 class="mb-3 fw-semibold text-primary">
                                        <i class="bi bi-shield-lock me-2"></i>Password Settings
                                    </h5>
                                    <p class="small text-muted mb-4">Leave blank to keep current password</p>

                                    <!-- Enable Password Change -->
                                    <div class="form-check form-switch mb-4">
                                        <input class="form-check-input" type="checkbox" id="enablePasswordChange">
                                        <label class="form-check-label fw-semibold" for="enablePasswordChange">
                                            Change Password
                                        </label>
                                    </div>

                                    <!-- New Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label fw-semibold">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="bi bi-lock text-muted"></i>
                                            </span>
                                            <input id="password" type="password" class="form-control" name="password" disabled>
                                            <button class="btn btn-outline-secondary toggle-password" type="button" disabled>
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div class="form-text small">Minimum 8 characters</div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="bi bi-lock text-muted"></i>
                                            </span>
                                            <input id="password_confirmation" type="password" class="form-control" 
                                                   name="password_confirmation" disabled>
                                            <button class="btn btn-outline-secondary toggle-password" type="button" disabled>
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-circle me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });

    // Enable/disable password fields
    const enablePasswordChangeCheckbox = document.getElementById('enablePasswordChange');
    const passwordFields = document.querySelectorAll('#password, #password_confirmation');
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    
    enablePasswordChangeCheckbox.addEventListener('change', function() {
        const isEnabled = this.checked;
        passwordFields.forEach(field => field.disabled = !isEnabled);
        togglePasswordButtons.forEach(button => button.disabled = !isEnabled);
    });
});
</script>

<style>
    .card {
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #f8f9fa;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .initials-avatar {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: bold;
    }
    
    .profile-preview-details {
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
    
    .form-check-input:checked {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }
    
    .form-switch .form-check-input {
        width: 2.5em;
        height: 1.5em;
    }
    
    @media (max-width: 992px) {
        .border-start {
            border-left: none !important;
            padding-left: 0 !important;
            border-top: 1px solid #dee2e6;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }
        .col-lg-4 {
            margin-bottom: 1.5rem;
        }
    }
</style>
@endsection