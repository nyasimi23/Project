<!DOCTYPE html>
<html lang="en">

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();



    $servername = "localhost"; // Replace with your server name
    $username = 'Xhaka'; // Replace with your MySQL username
    $password = '123456'; // Replace with your MySQL password
    $dbname = 'wheelsnation'; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    
    if (isset($_POST['save'])) {
        $email = $_POST['email'];
        $passwordInput = $_POST['password'];
    
        $sql = "SELECT * FROM register WHERE email='$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['Password'];
    
            // Verify the password
            if (password_verify($passwordInput, $hashed_password)) {
                // Login successful
                $_SESSION['email'] = $email;
                header("Location: main.php");  // Redirect to a home page
                exit();
            } else {
                // Login failed
                echo
                "
                <script>
                    alert('Login Failed!');
                </script>
                ";
            }
        } else {
            // User not found
            echo 
            "
            <script>
            alert(Invalid username or password);
            </script>
            ";
        }
    
        $conn->close();
    }
    ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


    <div class="col-md-8 block-9 mb-md-5">
        <form action="" class="bg-light p-5 contact-form" method="POST" >
        <h2>Enter Login Details</h2>
		<!-- <p class="hint-text">Enter Login Details</p> -->
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" id="email" name="email"  required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password"  required="required">
            </div>
            <div class="form-group">
                <input name="save" type="submit" value="LOGIN" class="btn btn-primary py-3 px-5" >
                <div class="text-center">Don't have an account? <a href="register.php">Register Here</a></div>
            </div>
        </form>

    </div>


   
  </body>
</html>
