<?php
session_start(); // Start the session

// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$db = "rsa";

// Establish connection
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission for adding notifications
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_notification'])) {
    $username = $_POST['username'];
    $course = $_POST['course'];
    $class = $_POST['class'];
    $description = $_POST['description'];

    if (!empty($description)) {
        $sql = "INSERT INTO notifications (username, course, class, description, seen) VALUES (?, ?, ?, ?, 0)";
        $stmt = mysqli_prepare($data, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $username, $course, $class, $description);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $_SESSION['message'] = "Notification successfully sent to $username.";
        } else {
            $_SESSION['message'] = "Error: Could not send notification to $username.";
        }
    } else {
        $_SESSION['message'] = "Description is required for $username.";
    }

    header("Location: admin_dashboard.php");
    exit();
}

// Fetch student records
$sql_users = "SELECT * FROM user WHERE usertype='student'";
$result_users = mysqli_query($data, $sql_users);

// Fetch sent notifications
$sql_notifications = "SELECT * FROM notifications ORDER BY created_at DESC";
$result_notifications = mysqli_query($data, $sql_notifications);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .main-title {
            background-color: #17a2b8;
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 10px 20px;
            font-size: 22px;
            margin: 20px auto;
            border-radius: 5px;
        }

        .content {
            padding: 30px;
            margin: 20px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .notification-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .notification-card h5 {
            color: #17a2b8;
            font-weight: bold;
        }

        .notification-card p {
            margin: 5px 0;
        }

        .notification-timestamp {
            color: #6c757d;
            font-size: 14px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .description-box {
            width: 100%;
            padding: 5px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .send-btn {
            background-color: #17a2b8;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: #138496;
        }

        .message {
            margin: 20px 0;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            color: #155724;
        }

        .seen {
            background-color: #d4edda; /* Green background for seen */
        }

        .unseen {
            background-color: #f8d7da; /* Red background for unseen */
        }
    </style>
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

<div class="container mt-5">
    <h1 class="main-title">Users Data</h1>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

    <!-- Users Table -->
    <div class="content">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Username</th>
                    <th>Course</th>
                    <th>Class</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result_users && mysqli_num_rows($result_users) > 0) {
                    $srNo = 1;
                    while ($user = mysqli_fetch_assoc($result_users)) {
                        echo "<tr>";
                        echo "<td>" . $srNo++ . "</td>";
                        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['course']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['class']) . "</td>";
                        echo "<form method='POST' action=''>";
                        echo "<td><input type='text' name='description' class='description-box' placeholder='Enter description' required></td>";
                        echo "<td>
                                <input type='hidden' name='username' value='" . htmlspecialchars($user['username']) . "'>
                                <input type='hidden' name='course' value='" . htmlspecialchars($user['course']) . "'>
                                <input type='hidden' name='class' value='" . htmlspecialchars($user['class']) . "'>
                                <button type='submit' name='submit_notification' class='send-btn'>Send</button>
                              </td>";
                        echo "</form>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No student records found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sent Notifications Section -->
    <h2 class="main-title">Sent Notifications</h2>
    <div class="content">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Username</th>
                    <th>Course</th>
                    <th>Class</th>
                    <th>Description</th>
                    <th>Sent On</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result_notifications && mysqli_num_rows($result_notifications) > 0) {
                    $srNo = 1;
                    while ($notification = mysqli_fetch_assoc($result_notifications)) {
                        // Determine if the notification has been seen
                        $status = ($notification['seen'] == 1) ? 'Seen' : 'Not Seen';
                        $row_class = ($notification['seen'] == 1) ? 'seen' : 'unseen';

                        echo "<tr class='$row_class'>";
                        echo "<td>" . $srNo++ . "</td>";
                        echo "<td>" . htmlspecialchars($notification['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($notification['course']) . "</td>";
                        echo "<td>" . htmlspecialchars($notification['class']) . "</td>";
                        echo "<td>" . htmlspecialchars($notification['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($notification['created_at']) . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No notifications have been sent yet.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
