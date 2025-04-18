<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Relief Monitoring System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Hero Section -->
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold">Hydroguard Flood Management System</h1>
        <p class="lead text-muted">Real-time distance monitoring using ESP32 sensors to ensure safety and manage relief centers effectively.</p>
        <div class="mt-4">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @endguest
        </div>
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
</html>
