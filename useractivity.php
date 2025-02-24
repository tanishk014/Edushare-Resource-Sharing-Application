<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Activities</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Dashboard Container */
        .dashboard {
            width: 80%;
            max-width: 900px;
            background: white;
            padding: 20px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        /* Title */
        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Chart Container */
        .chart-container {
            width: 100%;
            max-width: 700px;
            margin: auto;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-content h3 {
            margin-bottom: 10px;
        }

        .modal-content ul {
            list-style: none;
            padding: 0;
        }

        .modal-content ul li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .close-btn {
            background: #ff5b5b;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="dashboard">
        <h2>📊 User Activity Dashboard</h2>
        <div class="chart-container">
            <canvas id="activityChart"></canvas>
        </div>
    </div>

    <!-- Modal for showing details -->
    <div id="activityModal" class="modal">
        <div class="modal-content">
            <h3 id="modalTitle">Activity Details</h3>
            <ul id="activityList"></ul>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('activityChart').getContext('2d');

        // Sample activity data (replace with real-time data)
        const activities = {
            Logins: ["User A logged in", "User B logged in", "User C logged in"],
            Uploads: ["User A uploaded a PDF", "User D uploaded notes"],
            Downloads: ["User B downloaded a video", "User E downloaded notes"],
            Searches: ["User C searched for 'Machine Learning'", "User F searched for 'Web Development'"],
            Comments: ["User A commented: 'Great resource!'", "User B replied to User C"]
        };

        // Chart.js configuration
        const activityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(activities),
                datasets: [{
                    label: 'User Activities (This Week)',
                    data: [120, 45, 78, 95, 60], // Example data
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: { color: '#333', font: { size: 14 } }
                    }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { color: '#333' }, grid: { color: 'rgba(0,0,0,0.1)' } },
                    x: { ticks: { color: '#333' }, grid: { color: 'rgba(0,0,0,0.1)' } }
                },
                onClick: function (event, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        const activityType = Object.keys(activities)[index];
                        showActivityDetails(activityType);
                    }
                }
            }
        });

        // Function to display modal with activity details
        function showActivityDetails(activityType) {
            document.getElementById('modalTitle').innerText = `${activityType} Details`;
            const list = document.getElementById('activityList');
            list.innerHTML = "";

            activities[activityType].forEach(activity => {
                const listItem = document.createElement('li');
                listItem.textContent = activity;
                list.appendChild(listItem);
            });

            document.getElementById('activityModal').style.display = 'flex';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('activityModal').style.display = 'none';
        }
    </script>

</body>
</html>
