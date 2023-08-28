<?php
session_start(); // Start the session
// Database credentials
$hostname = "localhost";
$username = "id21144778_root";
$password = "sadokED926E288A*";
$database = "id21144778_neo4j";



// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the username parameter is provided
if(isset($_POST['username'])) {
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $newUserRole = $_POST['user-role'];

    // Update the user information in the users table
    $updateSql = "UPDATE users SET password='$newPassword', role='$newUserRole' WHERE username='$newUsername'";
    
    if ($conn->query($updateSql) === TRUE) {
            // Insert a record into the history table
            $loggedInUsername =   $_SESSION['username'];
            $loggedInAction = "Updated a user info named $newUsername";
            $currentTime = date("Y-m-d H:i:s");
            
            $insertQuery = "INSERT INTO history (username, action, timestamp) VALUES ('$loggedInUsername', '$loggedInAction', '$currentTime')";
            if ($conn->query($insertQuery) === TRUE) {
                header("Location: Dashboard.php"); // Redirect to the appropriate page

            } else {
                echo "Error inserting history record: " . $conn->error;
            }    } else {
        echo "Error updating user information: " . $conn->error;
    }
} else {
    echo "Username not provided.";
}

// Close the database connection
$conn->close();
?>
