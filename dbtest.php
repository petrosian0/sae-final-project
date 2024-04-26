<?php
// Database configuration
$host  = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "MYSQL";
 
// Create database connection
$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);
$query = "SELECT email, password from users";
 
$result=mysqli_query($conn,$query);
// Gets the Numeric array
$row=mysqli_fetch_array($result,MYSQLI_NUM);
echo " email :".$row[0];
echo ",";
echo " password : ".$row[1];
echo  nl2br (" \n ");
// Gets the Associative array
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
echo " email :".$row["email"];
echo ",";
echo " password : ".$row["password"];
 
// Free the result set
mysqli_free_result($result);
mysqli_close($conn);
?>
