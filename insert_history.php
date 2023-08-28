<?php
session_start();

// Set the timezone to Europe/Berlin (UTC+2)
date_default_timezone_set('Europe/Berlin');

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

if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

$loggedInUsername = $_SESSION['username'];
$loggedInAction = $_POST['loggedInAction']; // Get the Logged In Action from the AJAX request
$currentTime = date("Y-m-d H:i:s");

$insertQuery = "INSERT INTO history (username, action, timestamp) VALUES ('$loggedInUsername', '$loggedInAction', '$currentTime')";
if ($conn->query($insertQuery) === TRUE) {
    echo "History record inserted successfully";
} else {
    echo "Error inserting history record: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
