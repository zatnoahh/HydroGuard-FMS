<!-- @extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Distance Data (Cached)</div>
                <div class="card-body">
                    <p>Latest Distance: <span id="distance">Loading...</span> </p>
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
                <div class="card-header">Saved Distance Data (≥ 125.00 cm)</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Distance (cm)</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($distances as $distance)
                                <tr>
                                    <td>{{ $distance->value }} cm</td>
                                    <td>{{ $distance->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 -->

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>Real-Time Distance</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <h1>Distance Data (Cached)</h1>
    <p>Latest Distance: <span id="distance">Loading...</span> </p>

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

    <h1>Saved Distance Data (≥ 125.00 cm)</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Distance (cm)</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distances as $distance)
                <tr>
                    <td>{{ $distance->value }} cm</td>
                    <td>{{ $distance->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
 -->
