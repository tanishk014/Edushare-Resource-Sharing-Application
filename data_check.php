<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "rsa";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection error");
}

if (isset($_POST['apply'])) {
    $data_name = $_POST['name'];
    $data_email = $_POST['email'];
    $data_course = $_POST['course'];
    $data_class = $_POST['class'];
    $data_department = $_POST['department'];
    $data_phone = $_POST['phone'];
    $data_password = $_POST['password'];

    // ✅ Check if file is uploaded
    if (isset($_FILES['idcard']) && $_FILES['idcard']['error'] == 0) {
        $file = $_FILES['idcard']['name'];
        $dst = "./idcard/" . $file; // Path to save image
        $dst_db = "idcard/" . $file; // Path for database storage

        // Move file to the folder
        if (move_uploaded_file($_FILES['idcard']['tmp_name'], $dst)) {
            // ✅ Insert data into the database
            $sql = "INSERT INTO admission (name, email, course, class, department, idcard, phone, password) 
                    VALUES ('$data_name', '$data_email', '$data_course', '$data_class', '$data_department', '$dst_db', '$data_phone', '$data_password')";

            $result = mysqli_query($data, $sql);

            if ($result) {
                $_SESSION['message'] = "Your Application Submitted Successfully";
                header("Location: register.php");
                exit();
            } else {
                echo "Apply Failed: " . mysqli_error($data);
            }
        } else {
            echo "Error uploading file!";
        }
    } else {
        echo "No file uploaded or file upload error!";
    }
}
?>
