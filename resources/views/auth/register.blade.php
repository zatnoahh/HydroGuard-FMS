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
        
        .register-container {
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
            max-width: 500px;
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
        
        .btn-register {
            background: linear-gradient(135deg, #388E3C, #4CAF50);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 142, 60, 0.3);
        }
        
        .btn-back {
            color: #2196F3;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .btn-back:hover {
            color: #0D47A1;
            text-decoration: underline;
        }
        
        .form-label {
            font-weight: 500;
            color: #424242;
        }
        
        .input-group-text {
            background-color: transparent;
            border-right: none;
        }
        
        .input-with-icon {
            border-left: none;
        }
        
        .password-strength {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background 0.3s ease;
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
            
            .btn-container {
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
    
    <!-- Centered register card -->
    <div class="register-container">
        <div class="card shadow-lg">
            <div class="card-header text-white">
                <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Create Your Account</h4>
                <small class="opacity-75">Join HFMS to access flood management services</small>
            </div>

            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="fas fa-user text-primary"></i></span>
                            <input id="name" type="text"
                                   class="form-control input-with-icon @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" 
                                   required autofocus
                                   placeholder="Enter your full name">
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="fas fa-envelope text-primary"></i></span>
                            <input id="email" type="email"
                                   class="form-control input-with-icon @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" 
                                   required
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
                                   name="password" required
                                   placeholder="Create a password"
                                   oninput="checkPasswordStrength(this.value)">
                        </div>
                        <div class="password-strength">
                            <div class="strength-meter" id="password-strength-meter"></div>
                        </div>
                        <small class="text-muted">Use at least 8 characters with a mix of letters, numbers & symbols</small>
                        @error('password')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="fas fa-lock text-primary"></i></span>
                            <input id="password-confirm" type="password"
                                   class="form-control input-with-icon"
                                   name="password_confirmation" required
                                   placeholder="Re-enter your password">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4 btn-container">
                        <button type="submit" class="btn btn-register">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </button>

                        <a href="{{ route('login') }}" class="btn-back">
                            <i class="fas fa-arrow-left me-1"></i>Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Password Strength Indicator -->
    <script>
        function checkPasswordStrength(password) {
            const meter = document.getElementById('password-strength-meter');
            let strength = 0;
            
            // Check length
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            // Check for mixed case
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
            
            // Check for numbers
            if (password.match(/([0-9])/)) strength += 1;
            
            // Check for special chars
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
            
            // Update meter
            const width = strength * 20;
            let color = '#ff3e36'; // Red
            
            if (strength > 2) color = '#ffa500'; // Orange
            if (strength > 3) color = '#2ecc71'; // Green
            
            meter.style.width = width + '%';
            meter.style.background = color;
        }
    </script>
</body>
</html>