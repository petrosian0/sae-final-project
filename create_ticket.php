<?php
// Include the database connection
include 'Database.php';

// Retrieve and sanitize form data
$title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : ''; 
$description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : ''; 
$status_name = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : ''; 

// Validate the inputs
if (empty($title) || empty($description) || empty($status_name)) {
    die("Error: Title, description, and status are required."); 
}


$status_query = "SELECT id FROM status WHERE status = ?";
$status_stmt = $conn->prepare($status_query);

if ($status_stmt === false) {
    die("Error preparing SQL statement for status lookup: " . $conn->error); 
}

$status_stmt->bind_param("s", $status_name); // Bind the `status_name` as a string

if ($status_stmt->execute() === false) {
    die("Error executing SQL statement for status lookup: " . $status_stmt->error); 
}

$status_result = $status_stmt->get_result();
$status_row = $status_result->fetch_assoc();

$status_id = $status_row['id'] ?? 0; 

$status_stmt->close(); // Close the prepared statement

if ($status_id === 0) {
    die("Error: Could not find matching status in the database."); // Handle invalid `status_name`
}

// Insert the new ticket with the given data
$sql = "INSERT INTO tickets (title, description, status_id, user_id) VALUES (?, ?, ?, 1)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing SQL statement for ticket insert: " . $conn->error); // Handle preparation error
}


$stmt->bind_param("ssi", $title, $description, $status_id); // Correct parameter types

if ($stmt->execute() === false) {
    die("Error executing SQL statement for ticket insert: " . $stmt->error); // Handle execution error
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect on successful insert
header("Location: index.php");
exit(); 
