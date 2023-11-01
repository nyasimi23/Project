
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
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $sql = "INSERT INTO customer_info (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo
        "
        <script>
          alert('Successfully Added')
        </script>
        ";

        // header('Location: contact.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>