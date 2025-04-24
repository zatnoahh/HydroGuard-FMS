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
            <div class="card shadow rounded-3 border-0 overflow-hidden">
                <div class="card-header bg-danger text-white d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <h5 class="mb-0">Danger Level History</h5>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>No</th>
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $distance->value }}</strong></td>
                                        <td>
                                            @php
                                                $status = strtolower($distance->status);
                                            @endphp

                                            @if ($status === 'warning')
                                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">Warning</span>
                                            @elseif ($status === 'alert')
                                                <span class="badge bg-orange text-white px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">Alert</span>
                                            @elseif ($status === 'danger')
                                                <span class="badge bg-danger text-white px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">Danger</span>
                                            @else
                                                <span class="badge bg-secondary text-white px-3 py-2 rounded-pill d-inline-block text-center" style="min-width: 90px;">{{ $distance->status }}</span>
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
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">No danger readings available yet.</td>
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
