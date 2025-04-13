<?PHP

$user = "root";
$password = "";
$db = "spotify";
$server = "127.0.0.1";

$conn = new mysqli($server, $user, $password, $db);

// Check connection
if ($conn->error) {
    echo "Failed to connect to MySQL: " . $conn->error;
} else {
    echo "connection to DB found"; // put 2 slashes in front of echo if conection is successful
}

?>
<?php
// Perform query
if ($result = $conn->query("SELECT artist FROM datasetspotifytest")) {
    $row = $result->fetch_row();
    echo "<h1>$row[0]</h1>";
    // Fetches one row of data from the result set and returns it as an associative array
    $result->fetch_assoc();
}
$conn->close();
?>
