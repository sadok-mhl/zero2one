<?php
session_start(); // Start the session

// Check if the user is already logged in
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <style>
    body {
      background-color: rgb(88, 88, 88);
      display: flex;
    }
    
    .left-content {
      margin-top: 17%;
       margin-left : -10%;
    margin-right : -5%;
       height: 40%;
      display: flex;
      flex-direction: column;
      align-items: center;
      
      justify-content: center;
    }
    
    .right-content {
       width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      justify-content: space-between;
    }
    
    .btn {
      margin-top: 10px;
      padding : 10px 20px;
      border-radius: 25px;
      background-color: rgb(31, 31, 31);
    }
    
    .btn:hover {
      background: #179b81;
    }
    
    .login-button {
      position: absolute;
      top: 20px;
      right: 20px;
    }
    
    .row{
        margin-right : -15%;
    }
    h1, p {
      color: white;
      text-align: center;
      margin-bottom: 20px;  text-align: left;

    }
    h1{
           margin-left: 10%; /* Adjust this value as needed */

    }
    p {
   margin-left: 35%; /* Adjust this value as needed */
}

 
@media screen and (max-width: 900px) {
  .login-button {
    position: absolute;
    top: 20px;
   }

  .left-content {
    margin: 0;
    padding: 0;
  }

  .right-content {
    margin: 0;
    padding: 0;
  }

  h1 {
    font-size: 36px;
    margin-left: 20%;
    margin-top: 25vh;
    text-align: left;
  }

  p {
    font-size: 14px;
    margin-left: 20%;
    margin-top: 2vh;
    text-align: left;
  }

  .row {
    margin: 5vh 0;
   }

  img {
    display: none;
  }
}

    
    .right-content img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .row{
        margin-left : 12%;
    }
    .graphbtn{
        margin-left : 32%;
    }
  </style>
</head>

<body>
   
   
  <div class="left-content">
    <?php
      if (isset($_SESSION['username'])) {
        echo '<h1 style="margin-bottom: 20px; font-size: 60px;">Hello, ' . $_SESSION['username'] . '</h1>';
        echo '<p>Explore the Neo4j app, where you can seamlessly add both juridical and natural persons, and witness their representation as interconnected nodes within an interactive graph visualization.</p>';
      }
    ?>
    
 <div class="row">
      <div class="col">
        <a href="Juridical_Person.php" class="btn btn-primary btn-lg">Juridical Person</a>
      </div>
      <div class="col">
        <a href="Natural_Person.php" class="btn btn-primary btn-lg">Natural Person</a>
      </div>
      <div class="graphbtn">
        <a href="graph.php" class="btn btn-primary btn-lg">Graph</a> <!-- New "Graph" button -->
      </div>
    </div>
  </div>
  
<div class="right-content" style="height: 100vh; width: 100%; position: relative;">
  <img src="Home_image.png" alt="Home Image" style="height: 100%; width: 100%; object-fit: cover;">

  <div class="login-button" style="position: absolute; top: 20px; right: 20px;">
    <?php
      if (isset($_SESSION['username'])) {
        if ($_SESSION['role'] === 'admin') {
          echo '<a href="Dashboard.php" class="btn btn-primary">Dashboard</a>';
        }
        echo '<a href="logout.php" class="btn btn-primary">Sign out</a>';
      }
    ?>
  </div>
</div>



</body>

</html>
