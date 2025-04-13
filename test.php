<?php
// Fetch top songs data using the API
$endpoint = "https://phpwebappserc.azurewebsites.net/api.php?top";
$result = file_get_contents($endpoint);

// Print out the response to inspect its format
echo $result;
?>


