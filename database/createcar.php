<?php

$servername = "localhost"; // Replace with your server name
$username = 'Xhaka'; // Replace with your MySQL username
$password = '123456'; // Replace with your MySQL password
$dbname = 'carcrazeconnect'; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST["make"];
    $model = $_POST["model"];
    $price = $_POST["price"];
    $mileage = $_POST["mileage"];
    $image = $_FILES["image"]["name"];
    $description = $_POST["description"];
 // Move the uploaded image to a directory
 $target_dir = "uploads/"; // Create an 'uploads' directory in the same directory as your PHP script
 $target_file = $target_dir . basename($_FILES["image"]["name"]);

 if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
     // Insert the data into the 'cars' table
     $sql = "INSERT INTO cars (make, model, price, mileage, image, description) VALUES ('$make', '$model', '$price', '$mileage', '$image', '$description')";

     if ($conn->query($sql) === TRUE) {
         echo "Car data inserted successfully.";
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
 } else {
     echo "Error uploading the image.";
 }
}

// Close the database connection
$conn->close();
?>