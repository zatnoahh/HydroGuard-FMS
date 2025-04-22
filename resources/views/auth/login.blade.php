<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFMS Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            background: url('../../dist/assets/img/background.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        
        .logo-container {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        
        .logo-container img {
            height: 60px;
            transition: transform 0.3s ease;
        }
        
        .logo-container img:hover {
            transform: scale(1.05);
        }
        
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.9);
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .card-header {
            background: linear-gradient(135deg, #1976D2, #2196F3);
            padding: 1.5rem;
            text-align: center;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #2196F3;
            box-shadow: 0 0 0 0.25rem rgba(33, 150, 243, 0.25);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #388E3C, #4CAF50);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 142, 60, 0.3);
        }
        
        .form-label {
            font-weight: 500;
            color: #424242;
        }
        
        .form-check-label {
            color: #616161;
        }
        
        .links-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
        }
        
        .link-text {
            color: #2196F3;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .link-text:hover {
            color: #0D47A1;
            text-decoration: underline;
        }
        
        .input-group-text {
            background-color: transparent;
            border-right: none;
        }
        
        .input-with-icon {
            border-left: none;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .logo-container {
                position: relative;
                top: auto;
                left: auto;
                text-align: center;
                margin-bottom: 20px;
            }

            .logo-container img {
                height: 80px; /* Increased size */
            }
            
            .links-container {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Logo positioned top left -->
    <div class="logo-container">
        <img src="../../dist/assets/img/HFMS-Logo.png" alt="HFMS Logo" class="img-fluid" style="height: 160px;">
    </div>
    
    <!-- Centered login card -->
    <div class="login-container">
        <div class="card shadow-lg">
            <div class="card-header text-white">
                <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Welcome to HFMS</h4>
                <small class="opacity-75">Sign in to continue</small>
            </div>

            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="fas fa-envelope text-primary"></i></span>
                            <input id="email" type="email"
                                   class="form-control input-with-icon @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="email" autofocus
                                   placeholder="Enter your email">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="fas fa-lock text-primary"></i></span>
                            <input id="password" type="password"
                                   class="form-control input-with-icon @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="Enter your password">
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        
                        @if (Route::has('password.request'))
                            <a href="#" class="link-text small">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-login btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center mt-4">
                        <p class="mb-0">Don't have an account? 
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="link-text">Sign up</a>
                            @endif
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>