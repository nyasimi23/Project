<!DOCTYPE html>
<html lang="en">
<?php
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

// Check if the form is submitted and 'email' is set in $_POST
if (isset($_POST['email'])) {
    extract($_POST);

    $sql = mysqli_query($conn, "SELECT * FROM register where Email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        echo
        "
        <script>
            alert('Email Id Already Exists');
        </script>
        ";
        exit;
    } else {
        if (isset($_POST['save'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $pass = $_POST['pass']; // Raw password
            $c_pass = $_POST['cpass'];

            // Hash the password before storing it in the database
            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

            if ($c_pass != $pass) {
                echo
                "
                <script>
                    alert('Passwords don't match!');
                </script>
                ";
            } else {
                // Add to the database
                $sql = "INSERT INTO register (First_Name, Last_Name, Email, Password) VALUES ('$first_name', ' $last_name', '$email', '$hashed_password')";

                if ($conn->query($sql) === TRUE) {
                    // Success
                    header('Location: login.php');
                } else {
                    // Error
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
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
        <form action="" class="bg-light p-5 contact-form" method="POST">
            <h2>Register</h2>
            <p class="hint-text">Create your account</p>
            <div class="form-group">
                <div class="row">
                    <div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
                    <div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
                </div>        	
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" required="required">
            </div>
		    <div class="form-group">
            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Register Now</button>
            </div>
            <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
        </form>

    </div>



</body>

</html>