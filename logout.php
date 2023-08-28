<?php
session_start();
// Database credentials
$hostname = "localhost";
$username = "id21144778_root";
$password = "sadokED926E288A*";
$database = "id21144778_neo4j";



// Create a connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get the logged-in username from the session
$loggedInUsername = $_SESSION['username'];

// Set the action and timestamp for the history record
$loggedInAction = "logged out";
$currentTime = date("Y-m-d H:i:s");

// Prepare and execute the insert query
$insertQuery = "INSERT INTO history (username, action, timestamp) VALUES ('$loggedInUsername', '$loggedInAction', '$currentTime')";

if ($conn->query($insertQuery) === TRUE) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to home.php
    header("Location: index.php");
    exit;
} else {
    echo "Error inserting history record: " . $conn->error;
}

// Close the database connection if needed
// $conn->close();
?>
