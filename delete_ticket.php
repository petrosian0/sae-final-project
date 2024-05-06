<?php

include 'Database.php';


$id = isset($_POST['ticket_id']) ? (int)$_POST['ticket_id'] : 0;

if ($id <= 0) {
    die("Error: Invalid ticket ID."); // Handle invalid ID
}

// Prepare the SQL statement
$sql = "DELETE FROM tickets WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing SQL statement: " . $conn->error); 
}

$stmt->bind_param("i", $id); 

if ($stmt->execute() === false) {
    die("Error executing SQL statement: " . $stmt->error); 
}

$stmt->close();
$conn->close();

// Redirect on successful deletion
header("Location: index.php"); 
exit();
