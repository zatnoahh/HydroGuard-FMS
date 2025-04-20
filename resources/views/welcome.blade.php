<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HFMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/solid.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/regular.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/svg-with-js.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/v4-shims.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/v4-shims.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/v4-shims.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/v4-shims.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/v4-shims.min.css" rel="stylesheet">

    <style>
        body {
            background: url('../../dist/assets/img/background.png') no-repeat center center fixed;
            background-size: cover;
        }
    </style>


</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Hero Section -->
    <div class="container py-5 text-center">
        <div class="container-fluid px-0 py-0">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Logo (Top Left) -->
                <div class="flex-shrink-0">
                <img src="../../dist/assets/img/HFMS-Logo.png" alt="System Logo" class="img-fluid" style="max-height: 120px;">
                </div>

                <!-- Login/Register Buttons (Top Right) -->
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary d-flex align-items-center text-white" data-bs-toggle="tooltip" title="Login to your account">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-secondary d-flex align-items-center text-white" data-bs-toggle="tooltip" title="Create a new account">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                    @endguest
                </div>
            </div>
        </div>


        <h1 class="display-4 fw-bold">Hydroguard Flood Management System</h1>
        <p class="lead text-muted">Real-time distance monitoring using ESP32 sensors to ensure safety and manage relief centers effectively.</p>
        @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-success d-flex align-items-center" data-bs-toggle="tooltip" title="View your dashboard">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                @endauth
    </div>

    <!-- Status Cards -->
    <div class="container mb-5">
        <div class="row g-4 text-center">
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Latest Distance Reading</h5>
                        <h2 class="text-primary">{{ Cache::get('latest_distance', 'N/A') }} cm</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Relief Centers</h5>
                        <h2 class="text-success">{{ \App\Models\ReliefCenter::count() }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="container mb-5">
        <div class="alert alert-info text-center shadow-sm">
            Need help or more information? <a href="{{ route('safety_guidelines.index') }}" class="alert-link">Check our safety guidelines</a>.
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted bg-white border-top mt-auto">
        <small>&copy; {{ now()->year }} Hydroguard Flood Management System. All rights reserved.</small>
    </footer>

    <!-- Bootstrap JS (Optional, if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

</html>
