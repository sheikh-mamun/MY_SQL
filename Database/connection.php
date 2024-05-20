
<?php


$hostname ="localhost";
$user = "root";
$password = "";
$dbname ="myphp";
$connection = new mysqli($hostname,$user,$password,$dbname);
if($connection->connect_error){
    die("failed" . $connection->connect_error);
}
echo "connection succesfully";


?>