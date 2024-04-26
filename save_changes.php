<?php
// Include the database connection
include 'Database.php';

$id = isset($_POST['ticket_id']) ? (int) $_POST['ticket_id'] : 0; // Ensure the ID is an integer

echo $id;

$title = htmlspecialchars($_POST['title']); 
$description = htmlspecialchars($_POST['description']);
$status = htmlspecialchars($_POST['status']);

// Validate inputs
if (empty($title) || empty($description) || empty($status)) {
    die("Error: All fields are required."); // Handle invalid input
}

$sql = "UPDATE tickets SET title = ?, description = ?, status = ? WHERE ticket_id = ?"; // Corrected SQL query with placeholders
$stmt = $conn->prepare($sql); // Prepare the statement

if ($stmt === false) {
    die("Error preparing the SQL statement.");
}

$stmt->bind_param("sssi", $title, $description, $status, $id); // "sssi" denotes the types of each parameter

if ($stmt->execute() === false) {
    die("Error executing the SQL statement: " . $stmt->error); // Handle execution error
}

$stmt->close();
$conn->close();

echo "Ticket updated successfully."; // Confirmation message
?>
