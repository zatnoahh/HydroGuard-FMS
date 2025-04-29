<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flood Alert Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            margin: 40px auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #dc3545;
            color: white;
            padding: 15px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h2 {
            color: #333333;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #888888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>⚠️ Flood Alert</h1>
        </div>
        <div class="content">
            <h2>Attention!</h2>
            <p>The water level has reached <strong>{{ $distance }} cm</strong>.</p>
            <p>Current date: <strong>{{ now()->format('Y-m-d') }}</strong></p>
            <p>Current time: <strong>{{ now()->format('h:i A') }}</strong></p>
            <p>This exceeds the alert threshold. Please take necessary precautions immediately!</p>

            <a href="{{ url('/dashboard') }}" class="btn">View Dashboard</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} HydroGuard Flood Monitoring System
        </div>
    </div>
</body>
</html>
