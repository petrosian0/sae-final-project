<?php

include 'Database.php';

// Retrieve and sanitize form data
$id = isset($_POST['ticket_id']) ? (int)$_POST['ticket_id'] : 0;
$title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : ''; 
$description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : ''; 
$status_name = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : ''; 

// Validate the inputs
if (empty($title) || empty($description) || empty($status_name) || $id <= 0) {
    die("Error: Title, description, status, and a valid ticket ID are required."); 
}

// Get status_id based on status_name
$status_query = "SELECT id FROM status WHERE status = ?";
$status_stmt = $conn->prepare($status_query);

if ($status_stmt === false) {
    die("Error preparing SQL statement for status lookup: " . $conn->error); 
}

$status_stmt->bind_param("s", $status_name); 

if ($status_stmt->execute() === false) {
    die("Error executing SQL statement for status lookup: " . $status_stmt->error); 
}

$status_result = $status_stmt->get_result();
$status_row = $status_result->fetch_assoc();

$status_id = $status_row['id'] ?? 0; // Get the status_id or set to 0 if not found

$status_stmt->close(); 

if ($status_id === 0) {
    die("Error: Could not find matching status in the database."); 
}

// Update the ticket with the new data
$sql = "UPDATE tickets SET title = ?, description = ?, status_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing SQL statement for ticket update: " . $conn->error); 
}

// Bind parameters to the SQL statement
$stmt->bind_param("ssii", $title, $description, $status_id, $id); 

if ($stmt->execute() === false) {
    die("Error executing SQL statement for ticket update: " . $stmt->error); 
}


// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect on successful update
header("Location: index.php");
exit(); // Ensure no further code is executed after redirection
