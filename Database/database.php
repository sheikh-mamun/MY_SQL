<?php

$hostname= 'localhost';
$username = 'root';
$password = '';

$dbname = 'student_info';
 $conn = new mysqli($hostname,$username,$password);

if($conn->connect_error){
  die("connection failed".$conn->connect_error)
}
echo 'connection successful';



?>