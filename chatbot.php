<?php
// Include session validation
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
} elseif ($_SESSION['usertype'] == 'admin') {
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
        /* Chatbot Styling */
        .chatbot-card {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            background: #fff;
            font-family: Arial, sans-serif;
        }
        .chatbot-header {
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .chatbot-body {
            height: 300px;
            overflow-y: auto;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .chatbot-body .message {
            max-width: 80%;
            padding: 10px;
            border-radius: 10px;
            word-wrap: break-word;
        }
        .message.user {
            align-self: flex-end;
            background-color: #f0f0f0;
        }
        .message.bot {
            align-self: flex-start;
            background-color: #495057;
            color: white;
        }
        .chatbot-input {
            display: flex;
            border-top: 1px solid #ccc;
        }
        .chatbot-input input {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
        }
        .chatbot-input button {
            background-color: #343a40;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header class="header d-flex justify-content-between align-items-center">
    <a href="#" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> Student Dashboard</a>
    <h1>Resource Sharing Application</h1>
    <div class="logout">
        <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>

<aside>
    <ul class="list-unstyled">
        <li><a href="studenthome.php" class="btn btn-outline-primary"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="student_profile.php" class="btn btn-outline-primary"><i class="fas fa-user"></i> My Profile</a></li>
        <li><a href="seenotesstudent.php" class="btn btn-outline-primary"><i class="fas fa-book"></i> See Notes</a></li>
        <li><a href="uploadnotesstudent.php" class="btn btn-outline-primary"><i class="fas fa-upload"></i> Upload Notes</a></li>
        <li><a href="change_student_password.php" class="btn btn-outline-primary"><i class="fas fa-lock"></i> Change Password</a></li>
    </ul>
</aside>

<div class="content">
    <!-- Content goes here -->
</div>

<!-- Chatbot Section -->
<div class="chatbot-card">
    <div class="chatbot-header">
        Chatbot Assistant
    </div>
    <div class="chatbot-body" id="chatbot-body">
        <div class="message bot">Hi! How can I assist you today?</div>
    </div>
    <div class="chatbot-input">
        <input type="text" id="chatbot-input" placeholder="Type a message...">
        <button onclick="sendMessage()">Send</button>
    </div>
</div>

<script>
    const chatbotBody = document.getElementById('chatbot-body');

    function sendMessage() {
        const input = document.getElementById('chatbot-input');
        const message = input.value.trim();
        if (message) {
            // Display user message
            const userMessage = document.createElement('div');
            userMessage.className = 'message user';
            userMessage.textContent = message;
            chatbotBody.appendChild(userMessage);

            // Scroll to bottom
            chatbotBody.scrollTop = chatbotBody.scrollHeight;

            // Generate bot response
            setTimeout(() => {
                const botMessage = document.createElement('div');
                botMessage.className = 'message bot';

                if (message.toLowerCase().includes("notes")) {
                    botMessage.innerHTML = 'You can <a href="seenotesstudent.php">view notes here</a>.';
                } else if (message.toLowerCase().includes("profile")) {
                    botMessage.innerHTML = 'Visit your <a href="student_profile.php">profile page here</a>.';
                } else if (message.toLowerCase().includes("upload")) {
                    botMessage.innerHTML = 'You can <a href="uploadnotesstudent.php">upload notes here</a>.';
                } else if (message.toLowerCase().includes("password")) {
                    botMessage.innerHTML = 'Change your password <a href="change_student_password.php">here</a>.';
                } else {
                    botMessage.textContent = "I'm here to help! Could you provide more details?";
                }

                chatbotBody.appendChild(botMessage);

                // Scroll to bottom
                chatbotBody.scrollTop = chatbotBody.scrollHeight;
            }, 1000);

            // Clear input
            input.value = '';
        }
    }
</script>

</body>
</html>
