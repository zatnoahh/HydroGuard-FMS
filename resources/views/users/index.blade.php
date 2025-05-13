@extends('layouts.master')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0"><i class="bi bi-people text-primary me-2"></i> User Management</h1>
            <small class="text-muted">Manage all registered users and their details.</small>
        </div>
    </div>

    <!-- Filter Section with Live Search -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="mb-0">Users List</h5>
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
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th style="width: 15%;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td class="font-weight-bold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge 
                                    @if($user->role === 'admin') bg-danger
                                    @elseif($user->role === 'editor') bg-warning text-dark
                                    @else bg-primary
                                    @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->phone_number ?? 'N/A' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                
                                    <!-- View Button -->
                                    <a href="{{ route('users.show', $user->id) }}" 
                                    class="btn btn-primary btn-sm action-btn me-1" 
                                    title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <!-- Edit Button -->
                                    <a href="{{ route('users.edit', $user->id) }}" 
                                    class="btn btn-primary btn-sm action-btn me-1" 
                                    title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    @can('isAdmin')
                                    <!-- Delete Button -->
                                    <form method="POST" 
                                        action="{{ route('users.destroy', $user->id) }}" 
                                        onsubmit="return confirm('Are you sure you want to delete this user?')"
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
                            <td colspan="6" class="text-center text-muted py-4">No users available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="card-footer bg-light">
            {{ $users->links('pagination::bootstrap-4') }}
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