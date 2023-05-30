<?php
//this is the main config file
$DB_HOST = "sql788.main-hosting.eu"; // Database Host ex.sql0000.main-hosting.eu
$DB_USER = "u914372713_athena"; // Database Username 
$DB_PASS = "#Darktitans3770"; // Database Password
$DB_NAME = "u914372713_athena"; // Database Name
$conn = mysqli_connect($DB_HOST, "$DB_USER", "$DB_PASS", "$DB_NAME");
if (!isset($conn)) {
    die("Connection failed: " . mysqli_connect_error());
}
?>