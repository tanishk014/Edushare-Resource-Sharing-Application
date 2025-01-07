<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "rsa";

// Database connection
$data = mysqli_connect($host, $user, $password, $db);
if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT id, description, created_at, seen FROM notifications WHERE username = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($data, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $notifications = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $notifications[] = $row;
    }

    mysqli_stmt_close($stmt);

    echo json_encode(['status' => 'success', 'data' => $notifications]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch notifications']);
}

mysqli_close($data);
?>
