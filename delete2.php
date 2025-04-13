<?php
$port = $_SERVER['WEBSITE_MYSQL_PORT'];
$server = "localhost:$port";
$user = "";
$password = "";
$db = "localdb";

$conn = new mysqli($server, $user, $password, $db);

// Check connection
if ($conn->error) {
    echo "Failed to connect to MySQL: " . $conn->error;
} else {
    echo "connection to DB found"; // put 2 slashes in front of echo if connection is successful
}
?>