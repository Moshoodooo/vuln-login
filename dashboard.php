<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            background: #f4f6f8;
            color: #333;
        }

        /* Header */
        header {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        header h1 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 700;
        }
        header a {
            text-decoration: none;
            background: #ff5c5c;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.3s;
        }
        header a:hover {
            background: #e04b4b;
        }

        /* Layout */
        main {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .card h2 {
            margin: 0;
            font-size: 1.1rem;
        }
        .chart-container {
            position: relative;
            width: 100%;
            min-height: 250px; /* Fix Chart.js sizing loop */
        }

        /* System Status Styles */
        .status-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .status-item:last-child {
            border-bottom: none;
        }
        .status-icon {
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .status-icon.active {
            background: rgba(46, 213, 115, 0.15);
            color: #2ed573;
        }
        .status-icon.warning {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }
        .status-text {
            font-weight: 500;
            color: #555;
            font-size: 0.95rem;
        }

        /* Mobile Adjustments */
        @media (max-width: 500px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            header h1 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="index.php">Logout</a>
</header>

<main>
    <!-- Monthly Logins Chart -->
    <div class="card">
        <h2>Monthly Logins</h2>
        <div class="chart-container">
            <canvas id="loginsChart"></canvas>
        </div>
    </div>

    <!-- Security Events Chart -->
    <div class="card">
        <h2>Security Events</h2>
        <div class="chart-container">
            <canvas id="eventsChart"></canvas>
        </div>
    </div>

    <!-- Modern System Status -->
    <div class="card">
        <h2>System Status</h2>
        <div class="status-item">
            <span class="status-icon active">🛡️</span>
            <span class="status-text">Firewall: Active</span>
        </div>
        <div class="status-item">
            <span class="status-icon active">🦠</span>
            <span class="status-text">Antivirus: Up to Date</span>
        </div>
        <div class="status-item">
            <span class="status-icon warning">📅</span>
            <span class="status-text">Last Scan: 2 hours ago</span>
        </div>
    </div>
</main>

<script>
    // Monthly Logins Bar Chart
    new Chart(document.getElementById('loginsChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Logins',
                data: [50, 75, 60, 90, 120, 80],
                backgroundColor: '#6e45e2'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });

    // Security Events Pie Chart
    new Chart(document.getElementById('eventsChart'), {
        type: 'pie',
        data: {
            labels: ['Blocked IPs', 'Malware Alerts', 'Login Failures'],
            datasets: [{
                data: [12, 7, 20],
                backgroundColor: ['#ff5c5c', '#fbc531', '#00a8ff']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

</body>
</html>
