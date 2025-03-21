<!DOCTYPE html>
<html lang="en">

<head>
    <title>Live Distance Data</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <h1>Distance Data</h1>
    <p>Latest Distance: <span id="distance">{{ $latestDistance->value ?? 'No Data' }} cm</span></p>

    <script>
        function fetchDistance() {
            axios.get('/api/latest-distance')
                .then(response => {
                    document.getElementById('distance').innerText = response.data.value + ' cm';
                })
                .catch(error => console.error('Error fetching distance:', error));
        }

        setInterval(fetchDistance, 2000); // Refresh every 2 seconds
    </script>
</body>

</html>
