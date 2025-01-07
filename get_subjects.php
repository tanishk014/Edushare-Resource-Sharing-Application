<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "rsa";
$conn = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['semester'])) {
    $semester = mysqli_real_escape_string($conn, $_GET['semester']);
    $query = "SELECT DISTINCT subject FROM adminnotes WHERE semester = '$semester'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<option value=''>Select Subject</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['subject'] . "'>" . $row['subject'] . "</option>";
        }
    } else {
        echo "<option value=''>No subjects available</option>";
    }
}

mysqli_close($conn);
?>
