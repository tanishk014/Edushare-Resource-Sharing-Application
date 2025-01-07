<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student Admission Form</title>
<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background: linear-gradient(135deg, #8e44ad, #3498db);
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center; /* Ensures body content is centered vertically */
}

nav {
    background-color: #34495e;
    height: 70px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between; /* Spread out the content */
    padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

nav .logo {
    font-size: 24px;
    color: white;
    font-weight: bold;
}

nav .home-btn {
    background-color: #e74c3c;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    transition: background 0.3s;
}

nav .home-btn:hover {
    background-color: #c0392b;
}

.container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 20px;
    height: 100%;
}

.div_deg {
    background-color: rgba(255, 255, 255, 0.9);
    color: #34495e;
    width: 500px; /* Increased from 350px to 500px */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.adm_int {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.label_text {
    flex: 1;
    text-align: right;
    padding-right: 10px;
    font-size: 14px;
}

.input_deg {
    flex: 2;
    height: 30px;
    border-radius: 25px;
    border: 1px solid #ccc;
    padding: 0 10px;
    font-size: 14px;
}

.input_deg[type="file"] {
    padding: 5px 10px;
}

.btn {
    display: inline-block;
    width: 100%;
    height: 35px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    transition: background 0.3s;
}

.btn:hover {
    background-color: #2980b9;
}

.error {
    color: red;
    font-size: 12px;
    margin-bottom: 10px;
    text-align: center;
}

footer {
    background-color: #2c3e50;
    color: #ecf0f1;
    text-align: center;
    padding: 1em;
    font-size: 14px;
}

.home-button {
    text-align: center;
    margin-top: 20px;
}

.home-button a {
    color: white;
    text-decoration: none;
    background-color: #e74c3c;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    transition: background 0.3s;
}

.home-button a:hover {
    background-color: #c0392b;
}
</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
 

<div class="container">
    <div align="center" class="div_deg">
    <h2 style="color: #34495e; margin-bottom: 20px;">Registration Form</h2>
        <form action="data_check.php" method="POST" enctype="multipart/form-data">

            <div class="adm_int">
                <label for="name" class="label_text">Name</label>
                <input class="input_deg" id="name" type="text" name="name" required>
            </div>
            <div class="adm_int">
                <label for="email" class="label_text">Email</label>
                <input class="input_deg" id="email" type="text" name="email" required>
            </div>
            <div class="adm_int">
                <label for="course" class="label_text">Course</label>
                <select name="course" class="input_deg" id="course" required>
                    <option>Select</option>
                    <option>Btech</option>
                    <option>Be</option>
                </select>
            </div>
            <div class="adm_int">
                <label for="class" class="label_text">Class</label>
                <select name="class" class="input_deg" id="class" required>
                    <option>Select</option>
                    <option>Fy</option>
                    <option>Sy</option>
                    <option>Ty</option>
                </select>
            </div>

            <div class="adm_int">
                <label for="id_card" class="label_text">ID Card</label>
                <input class="input_deg" id="idcard" name="idcard" type="file" accept="image/*" required>
            </div>

            <div class="adm_int">
                <label for="phone" class="label_text">Phone</label>
                <input class="input_deg" type="number" id="phone" pattern="[0-9]{10}" placeholder="Enter 10-digit phone number" name="phone" required>
            </div>
            <div class="adm_int">
                <label for="password" class="label_text">Create Password</label>
                <input class="input_deg" id="password" name="password" type="password" pattern=".{5,}" title="Password must be at least 5 characters" required>
            </div>
            <div class="error" id="error-message"></div>
            <div class="adm_int">
                <input class="btn btn-primary" id="submit" type="submit" value="Apply" name="apply" onclick="validateForm()">
            </div>
            <br>
            <div>
                <label>Already Have An Account? <a href="login.php" class="btn btn-primary">Login Here</a></label>
            </div>
        </form>
    </div>
</div>

<footer>
    &copy; 2024 Resource Sharing Application. All rights reserved.
</footer>

<script>
function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("password").value;
    // Additional validation logic if needed
}
</script>
</body>
</html>
