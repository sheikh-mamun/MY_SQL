<?php
$hostname = "localhost";
$user = "root";
$password = "";
$dbname = "my_portal";

// Create connection
$connection = mysqli_connect($hostname, $user, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connection successfully established.";
?>
