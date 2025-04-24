@extends('layouts.master')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0"><i class="bi bi-droplet-half text-primary me-2"></i> Live Water Level Monitoring</h1>
            <small class="text-muted">Monitor live water levels and danger history.</small>
        </div>
    </div>
    
    <!-- Live Water Level Monitoring Card -->
    <div class="card shadow-lg border-0 mb-4 overflow-hidden">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-water me-3 fs-4 animate-pulse"></i>
                    <h5 class="mb-0 fw-semibold">Water Level Reading</h5>
                </div>
                <div class="badge bg-white text-primary rounded-pill px-3 py-2">
                    <span class="pulse-dot bg-success me-1"></span>
                    <span id="connection-status">Connected</span>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row align-items-center">
                    <!-- Live Reading Visualization -->
                    <div class="col-md-6 mb-4 mb-md-0 d-flex justify-content-center">
                        <div class="d-flex flex-column align-items-center">
                            <h6 class="text-uppercase text-muted mb-3 small fw-bold text-center">Current Water Level <br> from sensor</h6>
                        
                            
                            <div class="position-relative mb-3">
                                <div class="water-level-gauge">
                                    <div class="gauge-body">
                                        <div class="gauge-fill" id="water-level-fill"></div>
                                    </div>
                                    <div class="gauge-value" id="water-level-value">--</div>
                                </div>
                                <!-- <div class="gauge-threshold-markers">
                                    <div class="threshold-marker warning-marker" style="bottom: {{ ($thresholds['warning'] ?? 0)/300*100 }}%"></div>
                                    <div class="threshold-marker alert-marker" style="bottom: {{ ($thresholds['alert'] ?? 0)/300*100 }}%"></div>
                                    <div class="threshold-marker danger-marker" style="bottom: {{ ($thresholds['danger'] ?? 0)/300*100 }}%"></div>
                                </div> -->
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-center">
                                    <div class="text-muted small">Status</div>
                                    <div class="fw-bold" id="water-status">Loading...</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-muted small">Last Update</div>
                                    <div class="fw-bold" id="last-update">Just now</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Threshold Information & History -->
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-4 h-100">
                            <h6 class="text-uppercase text-muted mb-3 small fw-bold">Threshold Levels</h6>
                            
                            <div class="threshold-levels mb-4">
                                <div class="threshold-item danger-item mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="d-flex align-items-center">
                                            <span class="threshold-dot bg-danger me-2"></span>
                                            <span class="fw-semibold">Danger Level</span>
                                        </span>
                                        <span class="fw-bold">{{ $thresholds['danger'] ?? 'N/A' }} cm</span>
                                    </div>
                                    <div class="progress mt-1" style="height: 4px;">
                                        <div class="progress-bar bg-danger" style="width: 100%"></div>
                                    </div>
                                </div>
                                
                                <div class="threshold-item alert-item mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="d-flex align-items-center">
                                            <span class="threshold-dot bg-orange me-2"></span>
                                            <span class="fw-semibold">Alert Level</span>
                                        </span>
                                        <span class="fw-bold">{{ $thresholds['alert'] ?? 'N/A' }} cm</span>
                                    </div>
                                    <div class="progress mt-1" style="height: 4px;">
                                        <div class="progress-bar bg-orange" style="width: 100%"></div>
                                    </div>
                                </div>
                                
                                <div class="threshold-item warning-item">
                                    <div class="d-flex justify-content-between">
                                        <span class="d-flex align-items-center">
                                            <span class="threshold-dot bg-warning me-2"></span>
                                            <span class="fw-semibold">Warning Level</span>
                                        </span>
                                        <span class="fw-bold">{{ $thresholds['warning'] ?? 'N/A' }} cm</span>
                                    </div>
                                    <div class="progress mt-1" style="height: 4px;">
                                        <div class="progress-bar bg-warning" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="update-frequency small text-muted">
                                <i class="bi bi-arrow-repeat me-1"></i> Updating every 2 seconds
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Axios Script to Auto-fetch Reading -->
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script>
                let lastUpdateTime = new Date();
                
                function updateWaterLevel(value) {
                    // Update numeric value
                    document.getElementById('water-level-value').textContent = value + ' cm';
                    
                    // Update gauge visualization (assuming max 300cm for visualization)
                    // const fillPercentage = Math.min(100, (value / 300) * 100);
                    // document.getElementById('water-level-fill').style.height = `${fillPercentage}%`;
                    
                    // Update status text and colors
                    let statusElement = document.getElementById('water-status');
                    if (value <= {{ $thresholds['danger'] ?? 0 }}) {
                        statusElement.textContent = 'DANGER';
                        statusElement.className = 'fw-bold text-danger';
                        document.getElementById('water-level-fill').className = 'gauge-fill danger-fill';
                    } else if (value <= {{ $thresholds['alert'] ?? 0 }}) {
                        statusElement.textContent = 'ALERT';
                        statusElement.className = 'fw-bold text-warning';
                        document.getElementById('water-level-fill').className = 'gauge-fill alert-fill';
                    } else if (value <= {{ $thresholds['warning'] ?? 0 }}) {
                        statusElement.textContent = 'WARNING';
                        statusElement.className = 'fw-bold text-info';
                        document.getElementById('water-level-fill').className = 'gauge-fill warning-fill';
                    } else {
                        statusElement.textContent = 'NORMAL';
                        statusElement.className = 'fw-bold text-success';
                        document.getElementById('water-level-fill').className = 'gauge-fill safe-fill';
                    }
                    
                    // Update timestamp
                    lastUpdateTime = new Date();
                    document.getElementById('last-update').textContent = formatTime(lastUpdateTime);
                }
                
                function formatTime(date) {
                    const now = new Date();
                    const diff = Math.floor((now - date) / 1000);
                    
                    if (diff < 10) return 'Just now';
                    if (diff < 60) return `${diff} seconds ago`;
                    if (diff < 120) return '1 minute ago';
                    if (diff < 3600) return `${Math.floor(diff/60)} minutes ago`;
                    return date.toLocaleTimeString();
                }
                
                function fetchDistance() {
                    axios.get('/api/latest-distance')
                        .then(response => {
                            updateWaterLevel(response.data.value);
                            document.getElementById('connection-status').textContent = 'Connected';
                            document.querySelector('.pulse-dot').className = 'pulse-dot bg-success me-1';
                        })
                        .catch(error => {
                            console.error('Error fetching distance:', error);
                            document.getElementById('connection-status').textContent = 'Disconnected';
                            document.querySelector('.pulse-dot').className = 'pulse-dot bg-danger me-1';
                            document.getElementById('water-level-value').textContent = '--';
                            document.getElementById('water-status').textContent = 'OFFLINE';
                            document.getElementById('water-status').className = 'fw-bold text-muted';
                        });
                }
                
                // Initial fetch and set interval
                fetchDistance();
                setInterval(fetchDistance, 2000);
                
                // Update "last updated" time every minute
                setInterval(() => {
                    document.getElementById('last-update').textContent = formatTime(lastUpdateTime);
                }, 60000);
            </script>
        </div>


        <!-- Danger Readings Table -->
        <div class="card shadow rounded-3 border-0 overflow-hidden">
            <div class="card-header bg-danger text-white d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                <h5 class="mb-0">Danger Level History</h5>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>No</th>
                                <th>Water Level (cm)</th>
                                <th>Status</th>
                                <th>Day/Date</th>
                                <th>Time</th>
                                <th style="width: 15%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($distances as $distance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $distance->value }}</strong></td>
                                <td>
                                    @php
                                        $status = strtolower($distance->status);
                                    @endphp
                                    @if ($status === 'warning')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">Warning</span>
                                    @elseif ($status === 'alert')
                                        <span class="badge bg-orange text-white px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">Alert</span>
                                    @elseif ($status === 'danger')
                                        <span class="badge bg-danger text-white px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">Danger</span>
                                    @else
                                        <span class="badge bg-secondary text-white px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">{{ $distance->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $distance->created_at->format('l') }}</span>
                                        <span class="text-muted">{{ $distance->created_at->format('d M Y') }}</span>
                                    </div>
                                </td>
                                <td>{{ $distance->created_at->format('h:i A') }}</td>                                
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('distance.show', $distance->id) }}" 
                                        class="btn btn-primary btn-sm action-btn me-1" 
                                        title="View">
                                        <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form method="POST" 
                                            action="{{ route('distance.destroy', $distance->id) }}" 
                                            onsubmit="return confirm('Are you sure you want to delete this?')"
                                            class="d-inline">
                                            @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="btn btn-danger btn-sm action-btn" 
                                                    title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No danger readings available yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3 d-flex justify-content-center">
                    {{ $distances->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
</div>
@endsection
