
<?php
$hostname = "localhost";
$user = "root";
$password = "";
$dbname = "my_class";

// Create connection
$connection = new mysqli($hostname, $user, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

echo "Connection successfully established.";
?>



