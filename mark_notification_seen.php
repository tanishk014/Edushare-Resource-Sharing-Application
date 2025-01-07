<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "rsa";

// Database connection
$data = mysqli_connect($host, $user, $password, $db);
if (!$data) {
    die("Database connection failed");
}

if (isset($_GET['id'])) {
    $notificationId = $_GET['id'];
    $username = $_SESSION['username'];

    $sql = "UPDATE notifications SET seen = 1 WHERE id = ? AND username = ?";
    $stmt = mysqli_prepare($data, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "is", $notificationId, $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: studenthome.php");
        exit();
    }
}

mysqli_close($data);
?>
