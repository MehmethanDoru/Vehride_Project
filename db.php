<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehride";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>