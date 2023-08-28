<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['role'])) {
    header("Location: Home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <style>
    body {
      background-color: rgb(88, 88, 88);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    
    .left-image {
      width: 40%;
      height: 100%;
      background-image: url("neo.png");
      background-size: cover;
      background-repeat: no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .right-content {
      width: 60%;
      height: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    
    .container {
      background-color: #fff;
      border-radius: 7px;
      padding: 80px;
      max-width: 500px;
      margin: 10px;
    }
    
    .btn {
      margin-top: 10px;
      border-radius: 25px;
      background-color: rgb(31, 31, 31);
    }
    
    .btn:hover {
      background: #179b81;
    }
    
 .container input[type="text"],
.container input[type="password"] {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.container input[type="text"]:focus,
.container input[type="password"]:focus {
  outline: none;
  border-color: #179b81;
}

.container button.btn-primary {
  margin-top: 15px;
  border-radius: 25px;
  background-color: #179b81;
  border: none;
  padding: 10px 20px;
  color: white;
}

.container button.btn-primary:hover {
  background-color: #156b5c;
}
    /* Media Query for 900px or less */
    @media screen and (max-width: 900px) {
      body {
        flex-direction: column;
      }
      
      .left-image {
        width: 100%;
        height: 40%;
      }
      
      .right-content {
        width: 100%;
        height: 60%;
      }
    }
    
  </style>
</head>
<body>
    <div class="left-image"></div>
  
    <div class="right-content">
        <form action="login.php" method="POST">

      <div class="container">
        <h3 class="text-center">Login</h3>
         
         <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Username" name="username">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <input type="password" class="form-control" placeholder="Password" name="password">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col text-center">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        </div>
      </div>
    </form>

    </div>
  </body>

</html>
