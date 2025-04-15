@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Water Level</div>
                <div class="card-body">
                    <h2>Live Sensor Reading</h2>  
                    <p>Water Level: <span id="distance">Loading...</span> </p>
                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                    <script>
                        function fetchDistance() {
                            axios.get('/api/latest-distance')
                                .then(response => {
                                    document.getElementById('distance').innerText = response.data.value + ' cm';
                                })
                                .catch(error => console.error('Error fetching distance:', error));
                        }
                        setInterval(fetchDistance, 2000); // Refresh every 2 seconds
                        fetchDistance(); // Load immediately on page load
                    </script>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Danger Reading</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
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
                            @foreach ($distances as $distance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $distance->id }}</td>
                                    <td>{{ $distance->value }}</td>
                                    <td>{{ $distance->created_at->format('d.m.Y') }}</td>
                                    <td>{{ $distance->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <div class="btn-group dropend">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('distance.show', $distance->id) }}">Show</a></li>
                                                <li><a class="dropdown-item" href="{{ route('distance.edit', $distance->id) }}">Edit</a></li>
                                                <li>
                                                    <form method="POST" action="{{ route('distance.destroy', $distance->id) }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $distances->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
