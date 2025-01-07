<?php

session_start();

if(!isset($_SESSION['username'])) 
{
    header("location:login.php");
    
} elseif($_SESSION['usertype']=='admin')
{
    header("location:login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .header .btn {
            color: white;
            font-size: 18px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        aside {
            width: 250px;
            position: fixed;
            top: 60px;
            bottom: 0;
            left: 0;
            padding: 15px;
            background-color: #343a40;
            border-right: 1px solid #dee2e6;
        }
        aside ul {
            padding: 0;
            list-style: none;
        }
        aside a {
            color: white;
            font-size: 18px;
            padding: 10px;
            display: block;
            text-decoration: none;
            border: 1px solid transparent;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        aside a:hover {
            background-color: #495057;
            border-color: #6c757d;
        }
        .btn-block {
            display: block;
            width: 100%;
            text-align: left;
            font-size: 18px;
        }
        .btn-outline-primary {
            border-color: #6c757d;
            color: #6c757d;
        }
        .btn-outline-primary:hover {
            background-color: #6c757d;
            color: white;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            padding-top: 80px; /* Adjust for fixed header */
        }
        .main-title {
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 10px;
            font-size: 24px;
            border-radius: 10px;
        }
        .form-container {
            background: linear-gradient(135deg, #f8f9fa, #ece9e6);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            margin: auto;
            transition: transform 0.3s ease-in-out;
        }
        .form-container:hover {
            transform: scale(1.02);
        }
        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .form-container button {
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .form-container button:hover {
            background: linear-gradient(90deg, #feb47b, #ff7e5f);
        }
    </style>
</head>
<body>

<header class="header d-flex justify-content-between align-items-center">
    <a href="#" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> Student Dashboard</a>
    <h1>Resource Sharing Application</h1>
    <div class="d-flex align-items-center">
        <!-- Notification Button -->
        <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i> Notifications
                <span id="notificationCount" class="badge badge-danger">0</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="max-height: 300px; overflow-y: auto;">
                <div id="notificationList">
                    <p class="text-center text-muted">No new notifications</p>
                </div>
            </div>
        </div>
        <!-- Logout Button -->
        <a href="logout.php" class="btn btn-danger ml-3">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</header>

<aside>
    <ul class="list-unstyled">
        <li>
            <a href="studenthome.php" class="btn btn-outline-primary btn-block"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li>
            <a href="student_profile.php" class="btn btn-outline-primary btn-block"><i class="fas fa-user"></i> My Profile</a>
        </li>
        <li>
            <a href="seenotesstudent.php" class="btn btn-outline-primary btn-block"><i class="fas fa-book"></i> See Notes</a>
        </li>
        <li>
            <a href="uploadnotesstudent.php" class="btn btn-outline-primary btn-block"><i class="fas fa-upload"></i> Upload Notes</a>
        </li>
        <li>
            <a href="change_student_password.php" class="btn btn-outline-primary btn-block"><i class="fas fa-lock"></i> Change Password</a>
        </li>
        <li>
            <a href="user_notification.php" class="btn btn-outline-primary btn-block"><i class="fas fa-bell"></i> Notifications</a>
        </li>
    </ul>
</aside>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        function fetchNotifications() {
            $.ajax({
                url: 'fetch_notifications.php',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        const notifications = response.data;
                        let notificationHTML = '';
                        let unseenCount = 0;

                        if (notifications.length > 0) {
                            notifications.forEach(notification => {
                                if (notification.seen == 0) unseenCount++;
                                notificationHTML += `
                                    <a class="dropdown-item ${notification.seen == 0 ? 'font-weight-bold' : ''}" href="#">
                                        ${notification.description}
                                        <br><small class="text-muted">${notification.created_at}</small>
                                    </a>`;
                            });
                        } else {
                            notificationHTML = '<p class="text-center text-muted">No notifications</p>';
                        }

                        $('#notificationList').html(notificationHTML);
                        $('#notificationCount').text(unseenCount);
                    }
                },
                error: function () {
                    console.error('Failed to fetch notifications');
                }
            });
        }

        $('#notificationDropdown').on('click', function () {
            fetchNotifications();
        });
    });
</script>

</body>
</html>
