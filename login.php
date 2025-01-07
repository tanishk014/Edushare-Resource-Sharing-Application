<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Form</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #3a1c71, #d76d77, #ffaf7b);
                color: #333;
                margin: 0;
                padding: 0;
            }

            .form_deg {
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                padding: 30px;
                width: 350px;
                margin: 100px auto;
            }

            .title_deg {
                font-size: 24px;
                font-weight: bold;
                color: #3a1c71;
                margin-bottom: 20px;
            }

            .label_deg {
                font-weight: bold;
                color: #333;
                margin-bottom: 8px;
                display: block;
            }

            input[type="text"], input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 14px;
            }

            .password-container {
                position: relative;
                margin-bottom: 20px;
            }

            .password-input {
                padding: 10px;
                width: 100%;
            }

            .toggle-password {
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                cursor: pointer;
                font-size: 14px;
                color: #3a1c71;
            }

            input[type="submit"] {
                background-color: #3a1c71;
                color: white;
                border: none;
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            input[type="submit"]:hover {
                background-color: #2b154d;
            }

            .register-link {
                font-size: 14px;
                margin-top: 20px;
            }

            .register-link a {
                color: #3a1c71;
                text-decoration: none;
                font-weight: bold;
            }

            .register-link a:hover {
                text-decoration: underline;
            }

            .btn-home {
                background-color: #3a1c71;
                color: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                border: none;
                font-size: 16px;
                text-decoration: none;
                transition: background-color 0.3s;
                position: absolute;
                top: 20px; /* Small gap from the top */
                left: 20px; /* Small gap from the left */
            }

            .btn-home:hover {
                background-color: #2b154d;
            }

            footer {
                text-align: center;
                padding: 15px;
                background: linear-gradient(135deg, #3a1c71, #d76d77);
                color: white;
                position: fixed;
                bottom: 0;
                width: 100%;
                font-size: 14px;
            }
        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

        <script>
            // JavaScript function to toggle the password visibility
            function togglePassword() {
                var passwordInput = document.getElementById('passwordInput');
                var togglePasswordButton = document.querySelector('.toggle-password');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    togglePasswordButton.textContent = 'Hide';
                } else {
                    passwordInput.type = 'password';
                    togglePasswordButton.textContent = 'Show';
                }
            }
        </script>
    </head>
    <body>
        <!-- Home Button -->
        <a href="index.php" class="btn-home">Home</a>

        <center>
            <div class="form_deg">
                <center class="title_deg">
                    Login Form
                    <h4>
                        <?php
                        error_reporting(0);
                        session_start();
                        session_destroy();
                        echo $_SESSION['loginmessage'];
                        ?>
                    </h4>
                </center>

                <form action="login_check.php" method="POST" class="login_form">
                    <div>
                        <label class="label_deg">Username</label>
                        <input type="text" name="username" placeholder="Enter your username">
                    </div>

                    <div class="password-container">
                        <label class="label_deg">Password</label>
                        <input type="password" id="passwordInput" name="password" placeholder="Enter your password">
                        <span class="toggle-password" onclick="togglePassword()">Show</span>
                    </div>

                    <div>
                        <input type="submit" name="Submit" value="Login">
                    </div>

                    <div class="register-link">
                        <label>Don&#39;t have an account? <a href="register.php">Register Here</a></label>
                    </div>
                </form>
            </div>
        </center>

        <footer>
            &copy; 2024 Resource Sharing Application. All rights reserved.
        </footer>
    </body>
</html>
