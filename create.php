<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(E_ALL);

$msg = "";

if (isset($_POST['upload'])) {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $description = $_POST['description'];

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./database/image/" . $filename;

    if (move_uploaded_file($tempname, $folder)) {
        $db = mysqli_connect("localhost", "root", "", "wheelsnation");
        if ($db) {
            // Use prepared statements to prevent SQL injection
            $sql = "INSERT INTO car (make, model, image, description) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $make, $model, $filename, $description);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Uploaded successfully");</script>';
                header('Location: car.php');
            } else {
                echo '<h3>Failed to insert data into the database</h3>';
            }

            mysqli_stmt_close($stmt);
            mysqli_close($db);
        } else {
            echo '<h3>Failed to connect to the database</h3>';
        }
    } else {
        echo '<h3>Failed to upload image</h3>';
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
        <form action="" class="bg-light p-5 contact-form" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Car Make" id="make" name="make">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Car Model" id="model" name="model">
            </div>
          
            <div class="form-group">
				      <input class="form-control" type="file" name="uploadfile" value="" />
			      </div>
            
            <div class="form-group">
                <textarea name="description" cols="30" rows="7" class="form-control" placeholder="Description" id="description" ></textarea>
            </div>
            <div class="form-group">
                <input name="upload" type="submit" value="CREATE" class="btn btn-primary py-3 px-5" >
            </div>
            <div><a href="car.php">BACK</a></div>
        </form>

    </div>


   
  </body>
</html>