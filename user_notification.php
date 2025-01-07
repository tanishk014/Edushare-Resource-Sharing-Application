<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rsa";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from notifications table, ordered by created_at in descending order
$sql = "SELECT id, description, created_at, seen FROM notifications ORDER BY created_at DESC";

// Execute the query and check if it was successful
$result = $conn->query($sql);

// Check if the query was successful and handle errors
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// If the "Seen" button is clicked, update the notification status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mark_seen'])) {
    $id = $_POST['id'];
    $update_sql = "UPDATE notifications SET seen = 1 WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) {
        // Redirect to refresh the page after updating
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .no-records {
            text-align: center;
            color: #555;
            font-size: 18px;
            margin-top: 20px;
        }

        .sr-no {
            width: 10%;
        }

        /* Color styles for seen/unseen notifications */
        .seen {
            background-color: #d4edda; /* Green background for seen */
        }

        .unseen {
            background-color: #f8d7da; /* Red background for unseen */
        }

        .btn-seen {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-seen:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Notifications</h1>

    <?php
    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th class='sr-no'>SR No</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>";

        $sr_no = 1; // Initialize serial number
        
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Set the row color based on the seen status
            $row_class = $row["seen"] == 1 ? "seen" : "unseen";
            echo "<tr class='$row_class'>
                    <td class='sr-no'>" . $sr_no++ . "</td>
                    <td>" . $row["description"] . "</td>
                    <td>" . $row["created_at"] . "</td>
                    <td>
                        <form method='POST'>
                            <input type='hidden' name='id' value='" . $row["id"] . "' />
                            <button type='submit' name='mark_seen' class='btn-seen'>
                                " . ($row["seen"] == 1 ? "Seen" : "Mark as Seen") . "
                            </button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-records'>No records found.</p>";
    }

    $conn->close();
    ?>

</div>

</body>
</html>
