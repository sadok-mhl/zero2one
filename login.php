<?php
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

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Query to check credentials
    $query = "SELECT * FROM users WHERE username='$enteredUsername' AND password='$enteredPassword'";
    $result = $conn->query($query);

 if ($result->num_rows > 0) {
    // Valid login
    $userRow = $result->fetch_assoc();

    // Start a session
    session_start();
    $_SESSION['username'] = $enteredUsername; // Store username in the session
    $_SESSION['role'] = $userRow['role']; // Store user's role in the session

    // Insert a record into the history table
    $loggedInUsername = $conn->real_escape_string($enteredUsername);
    $loggedInAction = "logged in";
    $currentTime = date("Y-m-d H:i:s");
    
    $insertQuery = "INSERT INTO history (username, action, timestamp) VALUES ('$loggedInUsername', '$loggedInAction', '$currentTime')";
    if ($conn->query($insertQuery) === TRUE) {
        // Redirect to home.php
        header("Location: Home.php");
        exit;
    } else {
        echo "Error inserting history record: " . $conn->error;
    }
} else {
    // Invalid login
    header("Location: index.php");
}

}

$conn->close();
?>
