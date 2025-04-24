@extends('layouts.master')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0"><i class="bi bi-shield-check text-primary me-2"></i> Safety Guidelines</h1>
            <small class="text-muted">Manage safety instructions for all users.</small>
        </div>
        <a href="{{ route('safety_guidelines.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Safety Guideline
        </a>
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

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 20%;">Title</th>
                            <th style="width: 15%;">
                                <div class="d-flex align-items-center">
                                    Category
                                    @if(request('category'))
                                        <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ms-1 text-danger" title="Clear filter">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </th>
                            <th>Description</th>
                            <th style="width: 15%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($safetyGuidelines as $safetyGuideline)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $safetyGuideline->title }}</td>
                                <td>
                                    <span class="badge 
                                        @if($safetyGuideline->category == 'Before a Flood') bg-primary
                                        @elseif($safetyGuideline->category == 'During a Flood') bg-warning text-dark
                                        @elseif($safetyGuideline->category == 'After a Flood') bg-success
                                        @else bg-info text-dark
                                        @endif">
                                        {{ $safetyGuideline->category }}
                                    </span>
                                </td>
                                <td>{{ $safetyGuideline->description}}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('safety_guidelines.show', $safetyGuideline->id) }}" 
                                        class="btn btn-primary btn-sm action-btn me-1" 
                                        title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('safety_guidelines.edit', $safetyGuideline->id) }}" 
                                        class="btn btn-primary btn-sm action-btn me-1" 
                                        title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form method="POST" 
                                            action="{{ route('safety_guidelines.destroy', $safetyGuideline->id) }}" 
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
                                <td colspan="5" class="text-center text-muted py-4">
                                    @if(request('search') || request('category'))
                                        No results found for your search criteria.
                                        <a href="{{ request()->url() }}" class="ms-1">Clear filters</a>
                                    @else
                                        No safety guidelines found.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($safetyGuidelines->hasPages())
            <div class="card-footer">
                <nav>
                    <ul class="pagination justify-content-center pagination-sm">
                        {{ $safetyGuidelines->withQueryString()->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
