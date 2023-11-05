<?php
// Establish a database connection (similar to your other PHP files)
$servername = "localhost"; // Replace with your server name
$username = 'Xhaka'; // Replace with your MySQL username
$password = '123456'; // Replace with your MySQL password
$dbname = 'wheelsnation'; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform the deletion in the database
    $sql = "DELETE FROM car WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Redirect back to the original page
    header("Location: car.php");
    exit;
} else {
    echo "Item ID not provided.";
}
?>
