<?php
$host = "localhost";
$username = "root";
$password = ""; // Leave empty if no password is set
$database = "simplelogin_db";

$conn = mysqli_connect("localhost", "root", "", "simplelogin_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);
?>