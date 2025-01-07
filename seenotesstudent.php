<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "rsa";

$conn = mysqli_connect($host, $user, $password, $db);

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get filter parameters from the form (if any)
$department = isset($_GET['department']) ? mysqli_real_escape_string($conn, $_GET['department']) : '';
$semester = isset($_GET['semester']) ? mysqli_real_escape_string($conn, $_GET['semester']) : '';
$subject = isset($_GET['subject']) ? mysqli_real_escape_string($conn, $_GET['subject']) : '';

// SQL query to fetch notes based on the filters
$sql = "SELECT * FROM adminnotes WHERE 1";

if ($department) {
    $sql .= " AND department = '$department'";
}
if ($semester) {
    $sql .= " AND semester = '$semester'";
}
if ($subject) {
    $sql .= " AND subject = '$subject'";
}

$result = mysqli_query($conn, $sql);

// Check if the query succeeded
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Get subjects based on semester (for JavaScript dynamic update)
$subjects_query = "SELECT DISTINCT subject FROM adminnotes WHERE semester = '$semester'";
$subjects_result = mysqli_query($conn, $subjects_query);
$subjects = [];
while ($row = mysqli_fetch_assoc($subjects_result)) {
    $subjects[] = $row['subject'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        .content {
            margin-left: 270px;
            padding: 20px;
            padding-top: 80px; /* Adjust for fixed header */
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th {
            background-color: #343a40;
            color: white;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<header class="header d-flex justify-content-between align-items-center">
    <a href="studenthome.php" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> Student Dashboard</a>
    <h1>Resource Sharing Application</h1>
    <div class="logout">
        <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>

<aside class="bg-light p-3">
    <ul class="list-unstyled">
        <li class="mb-2">
            <a href="seenotesstudent.php?department=CSE" class="btn btn-outline-primary btn-block"><i class="fas fa-laptop-code"></i> Computer Science Engineering</a>
        </li>
        <li class="mb-2">
            <a href="seenotesstudent.php?department=Mech" class="btn btn-outline-primary btn-block"><i class="fas fa-cogs"></i> Mechanical Engineering</a>
        </li>
        <li class="mb-2">
            <a href="seenotesstudent.php?department=Civil" class="btn btn-outline-primary btn-block"><i class="fas fa-building"></i> Civil Engineering</a>
        </li>
        <li class="mb-2">
            <a href="seenotesstudent.php?department=E&TC" class="btn btn-outline-primary btn-block"><i class="fas fa-broadcast-tower"></i> Electronics & Telecommunication</a>
        </li>
    </ul>
</aside>

<div class="content">
    <div class="container">
        <h2 class="mb-4">View Notes</h2>
        
        <!-- Filter Form -->
        <form method="get" action="seenotesstudent.php">
            <div class="form-row mb-4">
                <div class="col">
                    <select name="department" class="form-control">
                        <option value="">Select Department</option>
                        <option value="CSE" <?php echo ($department == 'CSE') ? 'selected' : ''; ?>>Computer Science Engineering</option>
                        <option value="Mech" <?php echo ($department == 'Mech') ? 'selected' : ''; ?>>Mechanical Engineering</option>
                        <option value="Civil" <?php echo ($department == 'Civil') ? 'selected' : ''; ?>>Civil Engineering</option>
                        <option value="E&TC" <?php echo ($department == 'E&TC') ? 'selected' : ''; ?>>Electronics & Telecommunication</option>
                    </select>
                </div>
                <div class="col">
                    <select id="semester" name="semester" class="form-control">
                        <option value="">Select Semester</option>
                        <option value="1" <?php echo ($semester == '1') ? 'selected' : ''; ?>>1st Semester</option>
                        <option value="2" <?php echo ($semester == '2') ? 'selected' : ''; ?>>2nd Semester</option>
                        <option value="3" <?php echo ($semester == '3') ? 'selected' : ''; ?>>3rd Semester</option>
                        <!-- Add more semesters as needed -->
                    </select>
                </div>
                <div class="col">
                    <select id="subject" name="subject" class="form-control">
                        <option value="">Select Subject</option>
                        <?php foreach ($subjects as $sub): ?>
                            <option value="<?php echo $sub; ?>" <?php echo ($subject == $sub) ? 'selected' : ''; ?>><?php echo $sub; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Display Notes Table -->
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Semester</th>
                        <th>Department</th>
                        <th>Uploaded By</th>
                        <th>File Type</th>
                        <th>File Size</th>
                        <th>Upload Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo htmlspecialchars($row['semester']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['file_type']); ?></td>
                            <td>
                                <?php 
                                    // Convert file size to KB or MB for readability
                                    echo number_format($row['file_size'] / 1024, 2) . ' KB'; 
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['upload_time']); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank" class="btn btn-sm btn-success">View</a>
                                    <a href="<?php echo htmlspecialchars($row['file_path']); ?>" download class="btn btn-sm btn-primary">Download</a>
                                    <?php if (!empty($row['direct_link'])): ?>
                                        <a href="<?php echo htmlspecialchars($row['direct_link']); ?>" target="_blank" class="btn btn-sm btn-secondary">Direct Link</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert alert-warning">No notes found for this department.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#semester').change(function() {
            var semester = $(this).val();
            $.ajax({
                url: 'get_subjects.php',  // Create this file to fetch subjects based on the selected semester
                type: 'GET',
                data: {semester: semester},
                success: function(response) {
                    $('#subject').html(response);
                }
            });
        });
    });
</script>

</body>
</html>
