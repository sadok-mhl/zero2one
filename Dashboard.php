<?php
session_start(); // Start the session

// Check if the user is not connected
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: home.php");
  exit;
}

?>

<?php
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
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $newUsername = $_POST["username"];
  $newPassword = $_POST["password"];
  $userRole = $_POST["user-role"]; // Get the selected user role
  
  // Insert the new username, password, and user role into the users table
  $insertSql = "INSERT INTO users (username, password, role) VALUES ('$newUsername', '$newPassword', '$userRole')";
  
  if ($conn->query($insertSql) === TRUE) {

    // Insert a record into the history table
    $loggedInUsername =   $_SESSION['username'];
    $loggedInAction = "Added a user for the application named $newUsername";
    $currentTime = date("Y-m-d H:i:s");
    
    $insertQuery = "INSERT INTO history (username, action, timestamp) VALUES ('$loggedInUsername', '$loggedInAction', '$currentTime')";
    if ($conn->query($insertQuery) === TRUE) {
      echo "<h4>User created successfully!</h4>";
     } else {
        echo "Error inserting history record: " . $conn->error;
    }
  } else {
    error_log("Error: " . $insertSql . "<br>" . $conn->error);
  }
}
// SQL query to retrieve usernames and passwords from the users table
$sql = "SELECT username, password,role FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
 input[type="text"][style="border: 1px solid red;"],
input[type="password"][style="border: 1px solid red;"] {
  border: 1px solid red !important;
}
body {
      font-family: Arial, sans-serif;
      background-color: rgb(88, 88, 88);
      margin: 0;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      align-items: center;
      border: 1px solid #ccc;
      background-color: white;
      padding: 40px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
      max-width: 1500px;
      max-height : 600px;
        margin: 5% auto;

    }
    .form-container {
      flex: 1;
      padding: 10px;
    }

    .table-container {
      flex: 1;
      padding: 10px;
      border-left: 1px solid #ccc;
      height: 500px; /* Set the maximum height for the scrollable area */
      overflow: auto; /* Add scroll if content overflows */
    }

    table {
      width: 100%;
      border-collapse: collapse;
     
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
h4 {
  color: green;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
    th {
      background-color: #f0f0f0;
    }
 

    select, input[type="password"], input[type="text"] {
      width: 80%;
      padding: 12px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 13px;
      
    }

    select {
      height: 50px;
    }

    input[type="submit"] {
      background-color: #179b81;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 13px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #157d67;
    }
    .back-button {
  position: absolute;
  top: 20px;
  left: 20px;
  font-size: 20px;
  color: white;
  cursor: pointer;
}
 

.navbar {
  background-color: #333;
  overflow: hidden;
  text-align: center; /* Center the content */
     align-items: center;

  
}

.navbar a {
  /* Update display and margin to center the links */
  display: inline-block;
  margin: 0 15px;
  color: white;
  text-align: center;
  padding: 20px 16px;
  text-decoration: none;
}

.navbar a:hover {
  background-color: #ddd;
  color: black;
}
.right-links {
  margin-left : 90%;
  margin-top : -58px;
 
    
}
@media screen and (max-width: 600px) {
      /* Apply styles for screens under 600px width */
      .container {
        grid-template-columns: repeat(1, 1fr); /* Single column layout */
              max-height : 100%;
      }
        .table-container {
      flex: 1;
      padding: 3px;
      border: 1px solid #ccc;
      max-height: 500px; /* Set the maximum height for the scrollable area */
      overflow: auto; /* Add scroll if content overflows */
    }
     .navbar a {
  /* Update display and margin to center the links */
  display: inline-block;
  margin: 0 15px;
   text-align: center;
  padding: 15px 16px;
  text-decoration: none;
}

 
.right-links {
  margin-left : 80%;
  margin-top : -58px;
 
    
}
    }

  </style>
</head>

<body>
<div class="navbar">
  <a href="Home.php"><label>Home</label></a>
  <a href="graph.php"><label>Graph</label></a>
  <div class="right-links">
    <a href="logout.php"><label>Sign Out</label></a>
  </div>
</div>

    <a href="Home.php" class="back-button"><i class="fas fa-chevron-left"></i></a>

<div class="container">
  <div class="form-container">
  <form method="post" onsubmit="return validateForm();" id="user-form">
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username"><br><br>
        
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password"><br><br>
        
      <label for="confirm-password">Confirm Password:</label><br>
      <input type="password" id="confirm-password" name="confirm-password"><br><br>
        
      <!-- Add a select dropdown for user roles -->
      <label for="user-role">User Role:</label><br>
      <select id="user-role" name="user-role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select><br><br>
      <input type="hidden" id="hidden-id" name="hidden-id">

      <input type="submit" value="Add User" id="submit-button">
</form>
<div id="modify-container"  ></div>

  </div>
     <div class="table-container">
    <table>
    <tr>
      <th>Username</th>
      <th>Password</th>
      <th>User Role</th>
      <th>Actions</th> <!-- New column for actions -->
    </tr>
    <?php
    // Fetch and display usernames, passwords, and user roles
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td><a href='#' class='edit-user' data-username='" . $row["username"] . "'><i class='fas fa-edit'></i></a> ";
        echo "<a href='delete_user.php?username=" . $row["username"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fas fa-trash'></i></a></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>No records found.</td></tr>";
    }
    ?>
  </table>
        </div>

        <div class="table-container">
    <h2>History</h2>
    
    <div class="filter-container">
      <label for="user-filter">Select User:</label>
      <select id="user-filter">
        <option value="">All Users</option>
        <?php
        // Fetch and display distinct usernames for the filter
        $usernamesSql = "SELECT DISTINCT username FROM history";
        $usernamesResult = $conn->query($usernamesSql);

        if ($usernamesResult->num_rows > 0) {
          while ($row = $usernamesResult->fetch_assoc()) {
            echo "<option value='" . $row["username"] . "'>" . $row["username"] . "</option>";
          }
        }
        ?>
      </select>
    </div>
    <!-- Add the new filter-container for timestamps -->
 


    <table id="history-table">
  <tr>
    <th>Username</th>
    <th>Action</th>
    <th>Timestamp</th>
  </tr>
  <?php
  // Fetch and display history records
$historySql = "SELECT username, action, timestamp FROM history ORDER BY timestamp ASC";
  $historyResult = $conn->query($historySql);

 if ($historyResult->num_rows > 0) {
  $historyRows = array_reverse($historyResult->fetch_all(MYSQLI_ASSOC));
  foreach ($historyRows as $row) {
    echo "<tr data-username='" . $row["username"] . "'>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["action"] . "</td>";
    echo "<td>" . $row["timestamp"] . "</td>";
    echo "</tr>";
  }
  } else {
    echo "<tr><td colspan='3'>No history records found.</td></tr>";
  }
  ?>
</table>

  </div>
  </div>
  <script>

  ///user filter
 

document.addEventListener("DOMContentLoaded", function () {
  const userFilter = document.getElementById("user-filter");
  const historyTable = document.getElementById("history-table");
  const allHistoryRows = document.querySelectorAll("#history-table tbody tr");

  // Update history records based on user filter selection
  userFilter.addEventListener("change", function () {
    const selectedUser = userFilter.value;

    // Hide all rows and show only rows that match the selected user
    allHistoryRows.forEach(row => {
      if (selectedUser === "" || row.dataset.username === selectedUser) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
});
 


function validateForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirm-password").value;
  var submitButton = document.getElementById("submit-button");
  
  // Check if any field is empty
  if (username === "" || username.length < 4) {
    document.getElementById("username").style.border = "1px solid red";
    return false;
  } 
  else{
    document.getElementById("username").style.border = "1px solid green";
  }
  
  if ( password === "" || password.length < 5) {
    document.getElementById("password").style.border = "1px solid red";
    return false;
   }
   else{
    document.getElementById("password").style.border = "1px solid green";

   }
  if (confirmPassword=== "") {
    document.getElementById("confirm-password").style.border = "1px solid red";
    return false;
   }
   else{
    document.getElementById("confirm-password").style.border = "1px solid green";

   }
  
  // Check if passwords match
  if (password !== confirmPassword) {
    alert("Passwords do not match!");
    document.getElementById("password").style.border = "1px solid red";
    document.getElementById("confirm-password").style.border = "1px solid red";
    return false;
  }
  
  submitButton.disabled = true;
  return true;
}

document.addEventListener("DOMContentLoaded", function () {
  const editLinks = document.querySelectorAll(".edit-user");
  const formContainer = document.getElementById("user-form");
  const hiddenId = document.getElementById("hidden-id");
  const modifyContainer = document.getElementById("modify-container");

  editLinks.forEach((editLink) => {
    editLink.addEventListener("click", function (event) {
      event.preventDefault();
      const id = editLink.getAttribute("data-id"); // Assuming you have data-id attribute for each row
      const row = editLink.closest("tr");
      const username = row.querySelector("td:nth-child(1)").textContent;
      const password = row.querySelector("td:nth-child(2)").textContent;
      const userRole = row.querySelector("td:nth-child(3)").textContent;

      // Populate the form fields
      document.getElementById("username").value = username;
      document.getElementById("password").value = password;
      document.getElementById("user-role").value = userRole;

      // Set the hidden input value
      hiddenId.value = id;

      // Create the Save Changes button
      const saveChangesButton = document.createElement("input");
      saveChangesButton.type = "submit";
      saveChangesButton.value = "Save Changes";
      saveChangesButton.style.backgroundColor = "#179b81";
      saveChangesButton.style.color = "white";
      saveChangesButton.style.border = "none";
      saveChangesButton.style.padding = "10px 20px";
      saveChangesButton.style.borderRadius = "13px";
      saveChangesButton.style.cursor = "pointer";
      saveChangesButton.style.marginTop = "10px";

      saveChangesButton.addEventListener("click", function (event) {
        // Validate the form before submitting
        if (!validateForm()) {
          event.preventDefault(); // Prevent form submission if validation fails
        } else {
          // Update form action and submit
          formContainer.action = "modify_user.php";
          formContainer.submit();
        }
      });

      // Clear and add the Save Changes button to the container
      modifyContainer.innerHTML = '';
      modifyContainer.appendChild(saveChangesButton);
    });
  });
});

</script>
</body>
</html>
