@extends('layouts.master')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Hyfroguard Flood Management System</h1>
        <p class="lead text-muted">Real-time monitoring using ESP32 and ultrasonic sensors. Ensuring safety and managing relief centers efficiently.</p>
        <div class="mt-4">
            <a href="{{ route('safety_guidelines.index') }}" class="btn btn-primary me-2">View Safety Guidelines</a>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a>
            @endguest
        </div>
    </div>

    <!-- Status Cards -->
    <div class="row text-center mb-5">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted">Latest Distance Reading</h5>
                    <h2 class="text-primary">{{ Cache::get('latest_distance', 'N/A') }} cm</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Safety Guidelines</h5>
                    <h2 class="text-success">{{ \App\Models\SafetyGuideline::count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="alert alert-info text-center shadow-sm">
                <!-- Need help or more information? <a href="{{ route('safety_guidelines.index') }}" class="alert-link">Check our safety guidelines</a>. -->
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-4 text-muted bg-light mt-auto border-top">
    <small>&copy; {{ now()->year }} Smart Relief Monitoring System. All rights reserved.</small>
</footer>
@endsection
