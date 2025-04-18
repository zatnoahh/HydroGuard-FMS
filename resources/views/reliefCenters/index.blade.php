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

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reliefCenters as $reliefCenter)
                        <tr>
                            <td>{{ $reliefCenter->name }}</td>
                            <td>{{ $reliefCenter->location }}</td>
                            <td>{{ $reliefCenter->capacity }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('reliefCenters.show', $reliefCenter->id) }}">View</a></li>
                                        <li><a class="dropdown-item" href="{{ route('reliefCenters.edit', $reliefCenter->id) }}">Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('reliefCenters.destroy', $reliefCenter->id) }}" onsubmit="return confirm('Are you sure you want to delete this relief center?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
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
@endsection
