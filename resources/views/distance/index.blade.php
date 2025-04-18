@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Live Sensor Reading Card -->
            <div class="card shadow-sm mb-4 border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-droplet-half me-2"></i> Live Water Level Reading</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="fw-bold text-primary">
                        <span id="distance">Loading...</span>
                    </h2>
                    <p class="text-muted mb-0">Updates every 2 seconds from the ultrasonic sensor.</p>

                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                    <script>
                        function fetchDistance() {
                            axios.get('/api/latest-distance')
                                .then(response => {
                                    document.getElementById('distance').innerText = response.data.value + ' cm';
                                })
                                .catch(error => console.error('Error fetching distance:', error));
                        }
                        setInterval(fetchDistance, 2000);
                        fetchDistance();
                    </script>
                </div>
            </div>

            <!-- Danger Readings Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i> Danger Level History</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Water Level (cm)</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($distances as $distance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $distance->id }}</td>
                                        <td><span class="badge bg-danger fs-6">{{ $distance->value }}</span></td>
                                        <td>{{ $distance->created_at->format('d.m.Y') }}</td>
                                        <td>{{ $distance->created_at->format('H:i:s') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{ route('distance.show', $distance->id) }}">View</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('distance.edit', $distance->id) }}">Edit</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form method="POST" action="{{ route('distance.destroy', $distance->id) }}" onsubmit="return confirm('Are you sure you want to delete this data?')">
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
                                        <td colspan="6" class="text-center text-muted py-4">No danger readings available yet.</td>
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
    </div>
</div>
@endsection
