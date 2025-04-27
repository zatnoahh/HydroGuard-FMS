@extends('layouts.master') <!-- user layout -->

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Safety Guidelines</h1>
        <p class="text-muted">Stay prepared before, during, and after a flood with these important safety tips.</p>
    </div>

	<!-- Filter Section -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="mb-0">Safety Guidelines</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <!-- Category Filter Dropdown -->
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i>
                                @if(request('category'))
                                    {{ ucfirst(request('category')) }}
                                @else
                                    All Categories
                                @endif
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="categoryFilter">
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['category' => null]) }}">All Categories</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['category' => 'before a flood']) }}">Before a Flood</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['category' => 'during a flood']) }}">During a Flood</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['category' => 'after a flood']) }}">After a Flood</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['category' => 'special consideration']) }}">Special Consideration</a></li>
                            </ul>
                        </div>
                        
                        <!-- Search Box -->
                        <form method="GET" class="ms-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Guidelines List -->
    <div class="row g-4">
        @forelse($safetyGuidelines as $safetyGuideline)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title text-center">{{ $safetyGuideline->title }}</h2>
                        <span class="badge mb-3 
                            @if($safetyGuideline->category == 'Before a Flood') bg-primary
                            @elseif($safetyGuideline->category == 'During a Flood') bg-warning text-dark
                            @elseif($safetyGuideline->category == 'After a Flood') bg-success
                            @else bg-info text-dark
                            @endif">
                            {{ $safetyGuideline->category }}
                        </span>
                        <p class="card-text flex-grow-1">{{ Str::limit($safetyGuideline->description, 100) }}</p>
                        <a href="{{ route('safety_guidelines.show', $safetyGuideline->id) }}" class="btn btn-outline-primary mt-3">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                @if(request('search'))
                    No safety tips found for "{{ request('search') }}".
                @else
                    No safety guidelines available yet.
                @endif
            </div>
        @endforelse
    </div>
</div>
@endsection
