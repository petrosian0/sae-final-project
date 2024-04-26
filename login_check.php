<?php
// Database configuration
$host = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "MYSQL";

// Create database connection
$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// User input (from a form, typically)
$userEmail = $_POST['email']; // The input from user for email
$userPassword = $_POST['password']; // The input from user for password

// Sanitize inputs to prevent SQL Injection
$userEmail = mysqli_real_escape_string($conn, $userEmail);
$userPassword = mysqli_real_escape_string($conn, $userPassword);

// Prepare SQL query to get user data by email
$query = "SELECT email, password FROM users WHERE email = '$userEmail'";

// Execute the query
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // User found
    $row = mysqli_fetch_assoc($result);
    $storedHash = $row['password'];

    // Verify the password
    if ($userPassword == $storedHash) {
        echo "Login successful! Welcome, " . $row['email'];
        header("Location: index.php");
    } else {
        echo "Invalid password. Please try again.";
        echo '<br>';
        echo $row['password'];
        echo '<br>';
        echo $_POST['password'];
    }
} else {
    echo "Email not found. Please try again.";
}

// Free the result set and close the connection
mysqli_free_result($result);
mysqli_close($conn);
?>
