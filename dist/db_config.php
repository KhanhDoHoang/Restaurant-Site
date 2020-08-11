<?php 
$servername = "localhost";
$username = "docom_eatery";
$password = "cst@823870";
$dbname = "docom_eatery";

// Create connection
$dbConnection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
} 
//echo "Connected successfully";

?>