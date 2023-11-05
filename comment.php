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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
    $post_id = $_POST["post_id"];

    $sql = "INSERT INTO comment (post_id, name, email, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $post_id, $name, $email, $comment);
    
    if ($stmt->execute()) {
        echo "<script>alert('Successfully Commented');</script>";
          header("Location: blog-single.php?id='$post_id'");
    } else {
        echo "Error: " . $stmt->error;
    }
    

}
?>