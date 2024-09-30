<?php
$connection = mysqli_connect("localhost", "root", "", "mvc");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>