@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-primary mb-1">Flood Monitoring Dashboard</h1>
            <p class="text-muted mb-0">Real-time flood data and system overview</p>
        </div>
        <div class="text-end">
            <span class="badge bg-light text-dark fs-6">
                <i class="fas fa-clock me-1"></i>
                {{ now()->format('l, F j, Y - h:i A') }}
            </span>
        </div>
    </div>

    <!-- Alert Status Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body p-0">
                    <div class="row align-items-center">
                        <div class="col-md-8 p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-{{ $alertStatus['color'] }} rounded-circle p-2 me-3">
                                    <i class="fas fa-{{ $alertStatus['icon'] }} text-white fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">System Status: <span class="text-{{ $alertStatus['color'] }}">{{ $alertStatus['text'] }}</span></h3>
                                    <p class="text-muted mb-0">{{ $alertStatus['message'] }}</p>
                                </div>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-{{ $alertStatus['color'] }}" 
                                     role="progressbar" 
                                     style="width: {{ $waterLevelPercentage }}%" 
                                     aria-valuenow="{{ $waterLevelPercentage }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-muted">Normal</small>
                                <small class="text-muted">Warning</small>
                                <small class="text-muted">Danger</small>
                            </div>
                        </div>
                        <div class="col-md-4 bg-light p-4">
                            <div class="text-center">
                                <h1 class="display-4 fw-bold text-primary" id="latest-distance">{{ $latestDistance ?? 'N/A' }} <small class="fs-6">cm</small></h1>
                                <p class="text-muted mb-0">Current Water Level</p>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-history me-1"></i> View History
                                    </button>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-bell me-1"></i> Alert Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Sensor Activity -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-muted mb-0">SENSOR ACTIVITY</h6>
                        <i class="fas fa-satellite-dish text-primary"></i>
                    </div>
                    <h3 class="fw-bold">{{ $totalDistances }}</h3>
                    <p class="text-muted mb-0">Total readings collected</p>
                    <div class="mt-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-arrow-up me-1"></i> 12% from last week
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Relief Centers -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-muted mb-0">RELIEF CENTERS</h6>
                        <i class="fas fa-home text-success"></i>
                    </div>
                    <h3 class="fw-bold">{{ $totalCenters }}</h3>
                    <p class="text-muted mb-0">Available shelters</p>
                    <div class="mt-3">
                        <a href="{{ route('reliefCenters.index') }}" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-map-marker-alt me-1"></i> View Map
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Safety Resources -->
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-muted mb-0">SAFETY RESOURCES</h6>
                        <i class="fas fa-file-alt text-warning"></i>
                    </div>
                    <h3 class="fw-bold">{{ $totalGuidelines }}</h3>
                    <p class="text-muted mb-0">Guidelines available</p>
                    <div class="mt-3">
                        <a href="{{ route('safety_guidelines.index') }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-book-open me-1"></i> View Resources
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="row g-4">
        <!-- Water Level Chart -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Water Level Trends (Last 24 Hours)</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="chartRangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Last 24 Hours
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="chartRangeDropdown">
                            <li><a class="dropdown-item" href="#">Last 6 Hours</a></li>
                            <li><a class="dropdown-item" href="#">Last 24 Hours</a></li>
                            <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="waterLevelChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <button class="btn btn-outline-primary text-start py-3">
                            <i class="fas fa-bell me-2"></i> Send Flood Alert
                        </button>
                        <button class="btn btn-outline-success text-start py-3">
                            <i class="fas fa-plus-circle me-2"></i> Add New Sensor
                        </button>
                        <button class="btn btn-outline-info text-start py-3">
                            <i class="fas fa-file-export me-2"></i> Generate Report
                        </button>
                        <button class="btn btn-outline-warning text-start py-3">
                            <i class="fas fa-users me-2"></i> Manage Relief Centers
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Fetch latest distance
    function fetchLatestDistance() {
        axios.get('/api/latest-distance')
            .then(response => {
                document.getElementById('latest-distance').innerText = response.data.value + ' cm';
            })
            .catch(error => console.error('Error fetching latest distance:', error));
    }

    // Initialize water level chart
    const ctx = document.getElementById('waterLevelChart').getContext('2d');
    const waterLevelChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Water Level (cm)',
                data: {!! json_encode($chartData['values']) !!},
                backgroundColor: 'rgba(25, 118, 210, 0.1)',
                borderColor: 'rgba(25, 118, 210, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgba(25, 118, 210, 1)',
                pointRadius: 3,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Water Level (cm)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });

    // Update data every 5 seconds
    setInterval(() => {
        fetchLatestDistance();
        axios.get('/api/water-level-data')
            .then(response => {
                waterLevelChart.data.labels = response.data.labels;
                waterLevelChart.data.datasets[0].data = response.data.values;
                waterLevelChart.update();
            });
    }, 5000);
</script>
@endsection