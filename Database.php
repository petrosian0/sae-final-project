<?php
$host = "localhost";
$username = "root";
$password = "root"; // Remember to use actual passwords in production!
$database = "MYSQL";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>