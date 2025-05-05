@extends('layouts.master')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0"><i class="bi bi-building text-primary me-2"></i> Relief Centers</h1>
            <small class="text-muted">Manage all registered relief centers and their details.</small>
        </div>
        <a href="{{ route('reliefCenters.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Relief Center
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col ms-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Centers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($reliefCenters) }}</div>
                        </div>
                        <div class="col-auto me-2">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col ms-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Capacity</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reliefCenters->sum('capacity') }}</div>
                        </div>
                        <div class="col-auto me-2">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col ms-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Average Capacity</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ round($reliefCenters->avg('capacity'), 1) }}</div>
                        </div>
                        <div class="col-auto me-2">
                            <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col ms-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Centers with High Capacity</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ $reliefCenters->where('capacity', '>', 100)->count() }}
                    </div>
                </div>
                <div class="col-auto me-2">
                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Filter Section with Live Search -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="mb-0">Relief Centers</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <!-- Live Search Box -->
                        <div class="input-group">
                            <input type="text" id="liveSearchInput" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
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
                        <th>Name</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Services</th>
                        <th>Contact</th>
                        <th style="width: 15%;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reliefCenters as $reliefCenter)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('reliefCenters.show', $reliefCenter->id) }}" class="font-weight-bold text-dark">
                                    {{ $reliefCenter->name }}
                                </a>
                            </td>
                            <td>{{ $reliefCenter->location }}</td>
                            <td>{{ $reliefCenter->capacity }}</td>
                            <td>{{ $reliefCenter->service }}</td>
                            <td>{{ $reliefCenter->contact_info }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('reliefCenters.show', $reliefCenter->id) }}" 
                                    class="btn btn-primary btn-sm action-btn me-1" 
                                    title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('reliefCenters.edit', $reliefCenter->id) }}" 
                                    class="btn btn-primary btn-sm action-btn me-1" 
                                    title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" 
                                        action="{{ route('reliefCenters.destroy', $reliefCenter->id) }}" 
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
                            <td colspan="4" class="text-center text-muted py-4">No relief centers available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JavaScript for Live Search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('liveSearchInput');
    const tableRows = document.querySelectorAll('table tbody tr');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        tableRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchTerm) ? '' : 'none';
        });
    });
    
    // Trigger search if there's an initial value
    if (searchInput.value) {
        searchInput.dispatchEvent(new Event('input'));
    }
});
</script>
@endsection
