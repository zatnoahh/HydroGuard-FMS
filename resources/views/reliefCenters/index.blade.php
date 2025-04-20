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
                            <td>{{ $reliefCenter->name }}</td>
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
@endsection
