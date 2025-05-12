@extends('layouts.master')

@section('content')
<div class="container py-4">
    <!-- Hero Section -->
    <div class="text-center mb-5 py-4 bg-light rounded-3">
        <h1 class="fw-bold display-5 mb-3">Flood Safety Guidelines</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            Essential safety information to protect yourself and your family before, during, and after flood events.
        </p>
        <!-- <div class="mt-3">
            <span class="badge bg-primary me-2">Before</span>
            <span class="badge bg-warning text-dark me-2">During</span>
            <span class="badge bg-success me-2">After</span>
            <span class="badge bg-info text-dark">Special Cases</span>
        </div> -->
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="mb-0 text-primary"><i class="fas fa-life-ring me-2"></i>Safety Resources</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                        <!-- Category Filter -->
                        <div class="dropdown flex-grow-1 flex-md-grow-0">
                            <button class="btn btn-outline-primary w-100 dropdown-toggle d-flex align-items-center justify-content-between" 
                                    type="button" id="categoryFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>
                                    <i class="fas fa-filter me-2"></i>
                                    @if(request('category'))
                                        {{ ucfirst(request('category')) }}
                                    @else
                                        All Categories
                                    @endif
                                </span>
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="categoryFilter">
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ request()->fullUrlWithQuery(['category' => null]) }}">
                                    <i class="fas fa-layer-group me-2 text-muted"></i> All Categories
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ request()->fullUrlWithQuery(['category' => 'before a flood']) }}">
                                    <i class="fas fa-cloud-rain me-2 text-primary"></i> Before a Flood
                                </a></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ request()->fullUrlWithQuery(['category' => 'during a flood']) }}">
                                    <i class="fas fa-water me-2 text-warning"></i> During a Flood
                                </a></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ request()->fullUrlWithQuery(['category' => 'after a flood']) }}">
                                    <i class="fas fa-sun me-2 text-success"></i> After a Flood
                                </a></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="{{ request()->fullUrlWithQuery(['category' => 'special consideration']) }}">
                                    <i class="fas fa-star me-2 text-info"></i> Special Cases
                                </a></li>
                            </ul>
                        </div>
                        
                        <!-- Search Box -->
                        <form method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" 
                                       placeholder="Search safety tips..." value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guidelines List -->
    @if($safetyGuidelines->count() > 0)
    <div class="row g-4">
        @foreach($safetyGuidelines as $safetyGuideline)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm-hover transition-all">
                <div class="card-body d-flex flex-column p-4">
                    <!-- Category Badge -->
                    <div class="mb-3">
                        <span class="badge rounded-pill py-2 px-3 
                            @if($safetyGuideline->category == 'Before a Flood') bg-primary
                            @elseif($safetyGuideline->category == 'During a Flood') bg-warning text-dark
                            @elseif($safetyGuideline->category == 'After a Flood') bg-success
                            @else bg-info text-dark
                            @endif">
                            <i class="fas 
                                @if($safetyGuideline->category == 'Before a Flood') fa-cloud-rain
                                @elseif($safetyGuideline->category == 'During a Flood') fa-water
                                @elseif($safetyGuideline->category == 'After a Flood') fa-sun
                                @else fa-star
                                @endif me-1">
                            </i>
                            {{ $safetyGuideline->category }}
                        </span>
                    </div>
                    
                    <!-- Content -->
                    <h3 class="card-title h5 mb-3">{{ $safetyGuideline->title }}</h3>
                    <p class="card-text text-muted flex-grow-1 mb-4">
                        {{ Str::limit($safetyGuideline->description, 120) }}
                    </p>
                    
                    <!-- Read More Button -->
                    <div class="mt-auto">
                        <a href="{{ route('safety_guidelines.show', $safetyGuideline->id) }}" 
                           class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-between">
                            Read More
                            <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <i class="fas fa-book-open fs-1 text-muted mb-3"></i>
            <h4 class="text-muted">
                @if(request('search'))
                No safety tips found for "{{ request('search') }}"
                @else
                No safety guidelines available yet
                @endif
            </h4>
            <p class="text-muted">Check back later for updated safety information</p>
            @if(request('search') || request('category'))
            <a href="{{ route('safety_guidelines.index') }}" class="btn btn-primary mt-2">
                <i class="fas fa-undo me-1"></i> Reset Filters
            </a>
            @endif
        </div>
    </div>
    @endif

    
</div>

<style>
    .shadow-sm-hover {
        transition: all 0.3s ease;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    
    .shadow-sm-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }
    
    .transition-all {
        transition: all 0.3s ease;
    }
    
    .card-title {
        min-height: 3rem;
    }
    
    .input-group-text {
        background-color: white !important;
    }
    
    .dropdown-item:hover {
        background-color: rgba(13, 110, 253, 0.1);
    }
</style>
@endsection