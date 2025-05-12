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
                <div class="d-flex align-items-center">
                    <div class="badge bg-white text-primary rounded-pill px-3 py-2 me-3">
                        <span class="pulse-dot bg-success me-1"></span>
                        <span id="connection-status">Connected</span>
                    </div>                    
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
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-uppercase text-muted small fw-bold">Threshold Levels</h6>
                                @can('isAdmin')
                                    <a href="{{ route('threshold.index') }}" class="btn btn-primary btn-sm text-white">
                                    <i class="bi bi-gear me-1"></i> Manage Thresholds
                                    </a>
                                @endcan
                            </div>
                            
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
                                <i class="bi bi-exclamation-triangle me-1"></i> Active monitoring
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

        <!-- Danger Level History Section -->
<div class="card shadow-sm border-danger">
    <div class="card-header bg-danger text-white d-flex align-items-center justify-content-between flex-wrap py-2">
        <div class="d-flex align-items-center mb-2 mb-sm-0">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <h5 class="mb-0 fs-6 fw-semibold">DANGER LEVEL HISTORY</h5>
        </div>
        
        <div class="d-flex flex-wrap align-items-center gap-2">
            <!-- Compact Filter Dropdown -->
            <div class="dropdown">
                <button class="btn btn-xs btn-outline-light dropdown-toggle py-1 px-2 d-flex align-items-center" 
                        type="button" id="statusFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter me-1 fs-6"></i>
                    <span class="fs-7">
                        @if(request('status')) {{ ucfirst(request('status')) }} @else Status @endif
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="statusFilterDropdown">
                    <li><a class="dropdown-item small" href="{{ request()->fullUrlWithQuery(['status' => null]) }}">All Statuses</a></li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li><a class="dropdown-item small" href="{{ request()->fullUrlWithQuery(['status' => 'warning']) }}">Warning</a></li>
                    <li><a class="dropdown-item small" href="{{ request()->fullUrlWithQuery(['status' => 'alert']) }}">Alert</a></li>
                    <li><a class="dropdown-item small" href="{{ request()->fullUrlWithQuery(['status' => 'danger']) }}">Danger</a></li>
                </ul>
            </div>

            <!-- Compact Filter Form -->
            <form method="GET" action="{{ route('distance.index') }}" class="d-flex flex-wrap align-items-center gap-2">
                <div class="input-group input-group-xs" style="width: 120px;">
                    <span class="input-group-text bg-dark text-white border-dark py-1 px-2 fs-7">Date</span>
                    <input type="date" name="date" id="date" value="{{ request('date') }}" 
                           class="form-control form-control-xs py-1 px-2 fs-7">
                </div>

                <div class="input-group input-group-xs" style="width: 135px;">
                    <span class="input-group-text bg-dark text-white border-dark py-1 px-2 fs-7">Week</span>
                    <input type="week" name="week" id="week" value="{{ request('week') }}" 
                           class="form-control form-control-xs py-1 px-2 fs-7">
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-light btn-xs py-1 px-2 fs-7">
                        <i class="fas fa-search me-1"></i> Filter
                    </button>
                    
                    @if(request()->hasAny(['date', 'week', 'status']))
                    <a href="{{ route('distance.index') }}" class="btn btn-outline-light btn-xs py-1 px-2 fs-7">
                        <i class="fas fa-undo me-1"></i> Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No</th>
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
                                    <td>{{ ($distances->currentPage() - 1) * $distances->perPage() + $loop->iteration }}</td>
                                    <td><strong>{{ $distance->value }}</strong></td>
                                    <td>
                                        @php
                                            $status = strtolower($distance->status);
                                        @endphp
                                        @if ($status === 'warning')
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Warning</span>
                                        @elseif ($status === 'alert')
                                            <span class="badge bg-orange text-white px-3 py-2 rounded-pill">Alert</span>
                                        @elseif ($status === 'danger')
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Danger</span>
                                        @else
                                            <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">{{ $distance->status }}</span>
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

                                            @can('isAdmin')
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
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-tint-slash me-2"></i>
                                        No readings found for this filter
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-3 d-flex justify-content-center">
                    {{ $distances->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
            
        </div>

        <!-- Calendar Section -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Flood Event Calendar</h5>
                    <div class="btn-group btn-group-sm" role="group">
                        <button id="prev-btn" class="btn btn-outline-secondary">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button id="today-btn" class="btn btn-outline-primary">Today</button>
                        <button id="next-btn" class="btn btn-outline-secondary">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div id="calendar" class="fc"></div>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/calendar-data',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: ''
                },
                eventColor: '#0d6efd',
                eventTextColor: '#fff',
                height: 'auto',
                eventDisplay: 'block',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                
                dayMaxEvents: false, // ✅ Optional: explicitly disable
                eventDidMount: function(info) {
                    new bootstrap.Tooltip(info.el, {
                        title: info.event.extendedProps.description || 'No description',
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });


            calendar.render();
            
            // Custom navigation buttons
            document.getElementById('prev-btn').addEventListener('click', function() {
                calendar.prev();
            });
            
            document.getElementById('next-btn').addEventListener('click', function() {
                calendar.next();
            });
            
            document.getElementById('today-btn').addEventListener('click', function() {
                calendar.today();
            });
        });
        </script>
    </div>
</div>
@endsection
