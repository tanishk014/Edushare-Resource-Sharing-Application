 
<?php

error_reporting(0);
session_start();
session_destroy();

if($_SESSION['message'])
{
$message=$_SESSION['message'];

echo
 "<script type='text/javascript'>  

        alert('$message');

  </script>";

}


$host="localhost";
$user="root";
$password="";
$db="rsa";

$data=mysqli_connect($host,$user,$password,$db);

$sql="SELECT * FROM teacher";

$result=mysqli_query($data, $sql);

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Resource Sharing Application</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
        color: #333;
    }

    nav {
        position: fixed;
        background-color: #5e60ce;
        height: 70px;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .logo {
        font-size: 35px;
        color: white;
        font-weight: bold;
    }

    main {
        margin: 100px 20px;
        text-align: center;
    }

    .container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        max-width: 1200px;
        margin: 0 auto;
    }

    .buttons button {
        padding: 12px 25px;
        font-size: 18px;
        margin: 10px;
        cursor: pointer;
        border: none;
        border-radius: 8px;
        color: white;
        background: #5e60ce;
        transition: background 0.3s ease;
    }

    .buttons button:hover {
        background: #6930c3;
    }

    .card-container {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        margin: 10px;
        flex: 1 1 calc(25% - 20px);
        max-width: 200px;
        text-align: center;
        padding: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .card h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #5e60ce;
    }

    .card p {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
    }

    .card button {
        background: #5e60ce;
        color: white;
        padding: 8px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s ease;
    }

    .card button:hover {
        background: #6930c3;
    }

    footer {
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        text-align: center;
        padding: 15px;
        position: fixed;
        bottom: 0;
        width: 100%;
        font-size: 18px;
    }

    /* Ensures container aligns with the header and footer */
    .container {
        max-width: 1000px;
        margin: 100px auto; /* Centers the container */
        padding: 50px;
    }
</style>
</head>
<body>

<nav>
    <div class="logo">Resource Sharing Application</div>
</nav>

<main>
    <div class="container">
        <h2>Welcome to the Resource Sharing Application</h2>
        <p>Your one-stop platform for academic resources.</p>
        <div class="buttons">
            <button onclick="location.href='login.php'">Login</button>
            <button onclick="location.href='register.php'">Register</button>
        </div>

        <div class="card-container">
            <div class="card">
                <h3>PDF Notes</h3>
                <p>Access a wide range of PDF notes for various subjects.</p>
                <button onclick="location.href='register.php'">View PDF Notes</button>
            </div>
            <div class="card">
                <h3>Video Tutorials</h3>
                <p>Watch video tutorials to enhance your learning experience.</p>
                <button onclick="location.href='register.php'">View Video Tutorials</button>
            </div>
            <div class="card">
                <h3>MCQ Notes</h3>
                <p>Practice with multiple-choice questions to test your knowledge.</p>
                <button onclick="location.href='register.php'">View MCQ Notes</button>
            </div>
            <div class="card">
                <h3>PYQ</h3>
                <p>Practice with previous year questions to boost your confidence.</p>
                <button onclick="location.href='register.php'">View PYQ</button>
            </div>
        </div>
    </div>
</main>

<footer>
    &copy; 2024 Resource Sharing Application
</footer>

</body>
</html>
