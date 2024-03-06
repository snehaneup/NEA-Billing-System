<?php 
$servername = "localhost";
$dbname = "nea";
$username = "root";
$password = "";
$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
die("Connection Failed".mysqli_connect_error());
else
echo "Connected Successfully!!!";
?>