@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 fw-bold mb-0">
                        <i class="bi bi-person-gear text-primary me-2"></i>Edit Profile
                    </h2>
                    <p class="text-muted small mb-0">Update your account information</p>
                </div>
                <a href="{{ route('profile.show') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Profile
                </a>
            </div>

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

            <!-- Profile Edit Form -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

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

                        <!-- Password Section -->
                        <div class="border-top pt-4 mt-4">
                            <h5 class="mb-3 fw-semibold text-primary">
                                <i class="bi bi-shield-lock me-2"></i>Password Settings
                            </h5>
                            <p class="small text-muted mb-4">Leave these fields blank to keep your current password.</p>

                            <!-- Enable Password Change -->
                            <div class="form-check mb-4">
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

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
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
});
    document.addEventListener('DOMContentLoaded', function() {
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
    
    .form-label {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    
    .input-group-text {
        transition: all 0.2s;
    }
    
    .input-group:focus-within .input-group-text {
        background-color: #e9ecef;
    }
    
    .toggle-password {
        border-left: 0;
    }
    
    @media (max-width: 576px) {
        .d-flex.justify-content-between {
            flex-direction: column-reverse;
            gap: 1rem;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>
@endsection