<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if(isset($_POST['save']))
{
    extract($_POST);

    $servername = "localhost"; // Replace with your server name
    $username = 'Xhaka'; // Replace with your MySQL username
    $password = '123456'; // Replace with your MySQL password
    $dbname = 'carcrazeconnect'; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql=mysqli_query($conn,"SELECT * FROM register where Email='$email' and Password='md5($pass)'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["ID"] = $row['ID'];
        $_SESSION["Email"]=$row['Email'];
        $_SESSION["First_Name"]=$row['First_Name'];
        $_SESSION["Last_Name"]=$row['Last_Name']; 
        header("Location: main.php"); 
    }
    else
    {

        echo
        "
        <script>
          alert('Invalid Email ID/Password')
        </script>
        ";
       
    }
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