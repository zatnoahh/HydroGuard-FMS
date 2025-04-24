@extends('layouts.master')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0"><i class="bi bi-sliders text-primary me-2"></i> Manage Threshold</h1>
            <small class="text-muted">Manage all thresholds and their details.</small>
        </div>
    </div>

    <!-- Threshold Information & History -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="bg-light rounded-3 p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-uppercase text-muted small fw-bold">Threshold Levels</h6>
                    </div>
                    
                    <div class="threshold-levels">
                        <div class="threshold-item danger-item mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="d-flex align-items-center">
                                    <span class="threshold-dot bg-danger me-2"></span>
                                    <span class="fw-semibold">Danger Level</span>
                                </span>
                                <span class="fw-bold">{{ $thresholdValues['danger'] ?? 'N/A' }} cm</span>
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
                                <span class="fw-bold">{{ $thresholdValues['alert'] ?? 'N/A' }} cm</span>
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
                                <span class="fw-bold">{{ $thresholdValues['warning'] ?? 'N/A' }} cm</span>
                            </div>
                            <div class="progress mt-1" style="height: 4px;">
                                <div class="progress-bar bg-warning" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="update-frequency small text-muted text-center mt-3">
                        <i class="bi bi-exclamation-triangle me-1"></i> Active monitoring
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <img src="../../dist/assets/img/threshold.jpg" alt="Threshold Illustration" class="img-fluid rounded-3 shadow-sm" style="max-width: 50%; height: 90%;">
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Status</th>
                        <th>Value (cm)</th>
                        <th>Updated At</th>
                        <th style="width: 15%;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($thresholds as $index => $threshold)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($threshold->status === 'danger')
                                    <span class="badge bg-danger text-white text-uppercase">{{ $threshold->status }}</span>
                                @elseif ($threshold->status === 'alert')
                                    <span class="badge bg-orange text-white text-uppercase">{{ $threshold->status }}</span>
                                @elseif ($threshold->status === 'warning')
                                    <span class="badge bg-warning text-dark text-uppercase">{{ $threshold->status }}</span>
                                @else
                                    <span class="badge bg-secondary text-white text-uppercase">{{ $threshold->status }}</span>
                                @endif
                            </td>
                            <td>{{ $threshold->value }}</td>
                            <td>{{ $threshold->updated_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('threshold.edit', $threshold->id) }}" 
                                       class="btn btn-primary btn-sm action-btn me-1" 
                                       title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> No thresholds set yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
