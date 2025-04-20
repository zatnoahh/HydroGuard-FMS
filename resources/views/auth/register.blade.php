<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFMS Register</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: url('../../dist/assets/img/background.png') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <div class="container py-5 vh-100 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center w-100">
            <!-- System Image Section -->
            <div class="text-center mb-2">
            <img src="../../dist/assets/img/HFMS-Logo.png" alt="System Logo" class="img-fluid" style="max-height:200px;">
            </div>

            <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center fw-bold">
                <i class="fas fa-user-plus me-2"></i>Register for HFMS
                </div>
                <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-user me-1"></i>Name</label>
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autofocus placeholder="Your full name">
                    @error('name')
                        <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i>Email Address</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required placeholder="you@example.com">
                    @error('email')
                        <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                    <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Password</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required placeholder="Create a secure password">
                    @error('password')
                        <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                    <label for="password-confirm" class="form-label"><i class="fas fa-lock me-1"></i>Confirm Password</label>
                    <input id="password-confirm" type="password"
                           class="form-control" name="password_confirmation" required placeholder="Re-enter password">
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-user-plus me-1"></i>Register
                    </button>

                    <a href="{{ route('login') }}" class="btn btn-link">
                        <i class="fas fa-arrow-left me-1"></i>Back to Login
                    </a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
