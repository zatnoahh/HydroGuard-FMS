@extends('layouts.master')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-primary mb-1">Flood Monitoring Dashboard</h1>
            <p class="text-muted mb-0">Real-time system overview and analytics</p>
        </div>
        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
            <i class="bi bi-arrow-repeat me-1"></i> Live updates
        </div>
    </div>

    
    <!-- Status Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Latest Reading and Danger Levels -->
        <div class="col-xl-6">
            <div class="row g-4">
                <!-- Latest Reading Card -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small">Latest Reading</h6>
                                    <h3 id="latest-distance" class="fw-bold mb-0">{{ $latestDistance->value ?? 'N/A' }} cm</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <a href="{{ route('distance.index') }}" class="text-decoration-none">
                                        <i class="bi bi-droplet text-primary fs-4"></i>
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-clock-history me-1"></i> Updated {{ $latestDistance ? $latestDistance->created_at->diffForHumans() : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Level Distribution Card -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="text-muted text-uppercase small">Danger Levels</h6>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="bullet bg-danger me-2"></span>
                                        <span>Danger: {{ $dangerLevels['danger'] ?? 0 }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="bullet bg-warning me-2"></span>
                                        <span>Alert: {{ $dangerLevels['alert'] ?? 0 }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="bullet bg-info me-2"></span>
                                        <span>Warning: {{ $dangerLevels['warning'] ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="chart-container" style="width: 80px; height: 80px;">
                                    <canvas id="dangerLevelChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Relief Centers and Safety Guidelines -->
        <div class="col-xl-6">
            <div class="row g-4">
                <!-- Relief Centers Card -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small">Relief Centers</h6>
                                    <h3 class="fw-bold mb-0">{{ $totalCenters }}</h3>
                                    <small class="text-muted">Active locations</small>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-building text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('reliefCenters.index') }}" class="btn btn-sm btn-outline-success">
                                    View Centers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safety Guidelines Card -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small">Safety Guidelines</h6>
                                    <h3 class="fw-bold mb-0">{{ $totalGuidelines }}</h3>
                                    <small class="text-muted">Available protocols</small>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-shield-check text-warning fs-4"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('safety_guidelines.index') }}" class="btn btn-sm btn-outline-warning">
                                    View Guidelines
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Alerts Row -->
    <div class="row g-4 mb-4">
        <!-- Water Level Trend -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0">Water Level Trend (Last 24 Hours)</h6>
                </div>
                <div class="card-body">
                    <canvas id="waterLevelChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Danger Alerts Card -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-octagon-fill text-danger me-2"></i>
                        <h6 class="mb-0 fw-semibold">Danger Alerts</h6>
                    </div>
                    <div class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                        <span class="bullet bg-danger me-1"></span>
                        {{ $dangerLevels['danger'] ?? 0 }} Alerts
                    </div>
                </div>
                <div class="card-body p-0">
                    @php
                        $dangerAlerts = $recentDistances->where('status', 'danger')->take(7);
                    @endphp

                    @if($dangerAlerts->count() > 0)
                    <div class="alert-list">
                        @foreach($dangerAlerts as $alert)
                        <a href="{{ route('distance.show', $alert->id) }}" class="alert-item d-block text-decoration-none">
                            <div class="d-flex align-items-start p-3 border-bottom hover-bg-light">
                                <div class="alert-icon bg-danger bg-opacity-10 text-danger rounded-circle p-2 me-3">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-semibold">Danger Water Level</span>
                                        <span class="badge bg-danger rounded-pill">{{ $alert->value }} cm</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">
                                            <i class="bi bi-clock-history me-1"></i>
                                            {{ $alert->created_at->diffForHumans() }}
                                        </small>
                                        <small class="text-muted">
                                            {{ $alert->created_at->format('M d') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-check-circle-fill text-success fs-1"></i>
                        </div>
                        <h6 class="fw-semibold">No Danger Alerts</h6>
                        <p class="text-muted small mb-0">All readings within safe parameters</p>
                    </div>
                    @endif
                    
                    @if($dangerAlerts->count() > 0)
                    <div class="card-footer bg-white border-top text-center py-2">
                        <a href="{{ route('distance.index', ['status' => 'danger']) }}" class="btn btn-sm btn-outline-danger">
                            View All Alerts
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Readings Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Recent Readings</h6>
            <a href="{{ route('distance.index') }}" class="btn btn-sm btn-outline-primary">
                View All
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Distance</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentDistances->take(10) as $distance)
                        <tr>
                            <td class="fw-bold">{{ $distance->value }} cm</td>
                            <td>
                                @if($distance->status === 'danger')
                                <span class="badge bg-danger text-white px-3 py-2 rounded-pill" style="min-width: 80px; text-align: center;">Danger</span>
                                @elseif($distance->status === 'alert')
                                <span class="badge bg-orange text-white px-3 py-2 rounded-pill" style="min-width: 80px; text-align: center;">Alert</span>
                                @else
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill" style="min-width: 80px; text-align: center;">Warning</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-muted small">
                                    {{ $distance->created_at->format('M j, Y') }}<br>
                                    {{ $distance->created_at->format('h:i A') }}
                                </div>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('distance.show', $distance->id) }}" class="btn btn-sm btn-outline-primary">
                                    Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Dashboard Scripts -->
<script>
    // Initialize charts
    document.addEventListener('DOMContentLoaded', function() {
        // Danger Level Distribution Chart
        const dangerCtx = document.getElementById('dangerLevelChart').getContext('2d');
        new Chart(dangerCtx, {
            type: 'doughnut',
            data: {
                labels: ['Danger', 'Alert', 'Warning'],
                datasets: [{
                    data: [
                        {{ $dangerLevels['danger'] ?? 0 }},
                        {{ $dangerLevels['alert'] ?? 0 }},
                        {{ $dangerLevels['warning'] ?? 0 }}
                    ],
                    backgroundColor: [
                        '#dc3545',
                        '#fd7e14',
                        '#0dcaf0'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });

        // Water Level Trend Chart

        const waterCtx = document.getElementById('waterLevelChart').getContext('2d');

        const gradientFillPlugin = {
            id: 'customFill',
            beforeDatasetsDraw(chart, args, pluginOptions) {
                const {
                    ctx,
                    chartArea: {top, bottom, left, right},
                    scales: {x, y},
                    data
                } = chart;

                const dataset = chart.data.datasets[0];
                const points = chart.getDatasetMeta(0).data;

                if (!points.length) return;

                ctx.save();
                const gradient = ctx.createLinearGradient(0, top, 0, bottom);
                gradient.addColorStop(0, 'rgba(13,110,253,0.4)');
                gradient.addColorStop(1, 'rgba(13,110,253,0)');

                ctx.beginPath();
                ctx.moveTo(points[0].x, points[0].y);

                for (let i = 1; i < points.length; i++) {
                    ctx.lineTo(points[i].x, points[i].y);
                }

                // Close path to "visual" bottom (which is actually chart bottom)
                ctx.lineTo(points[points.length - 1].x, bottom);
                ctx.lineTo(points[0].x, bottom);
                ctx.closePath();

                ctx.fillStyle = gradient;
                ctx.fill();
                ctx.restore();
            }
        };

        new Chart(waterCtx, {
            type: 'line',
            data: {
                labels: @json($hourlyAverages->pluck('hour')->map(fn($h) => $h . ':00')),
                datasets: [{
                    label: 'Average Water Level (cm)',
                    data: @json($hourlyAverages->pluck('avg_value')),
                    borderColor: '#0d6efd',
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#0d6efd',
                    fill: false // prevent default fill
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y.toFixed(2) + ' cm';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        reverse: true,
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Water Level (cm)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Hour of Day'
                        }
                    }
                }
            },
            plugins: [gradientFillPlugin] // use custom plugin here
        });

        // Live updates for latest reading
        function fetchLatestDistance() {
            axios.get('/api/latest-distance')
                .then(response => {
                    document.getElementById('latest-distance').innerText = response.data.value + ' cm';
                })
                .catch(error => console.error('Error:', error));
        }
        
        setInterval(fetchLatestDistance, 5000);
    });
</script>
@endsection