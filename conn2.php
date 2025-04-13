<?php
// Database connection parameters
$connectionInfo = array(
    "UID" => "vtate",                      // Username
    "pwd" => "Studio0n",                   // Password
    "Database" => "phpwebappDB",           // Database name
    "LoginTimeout" => 30,                   // Login timeout (in seconds)
    "Encrypt" => 1,                         // Encrypt data sent over the network (1 for true, 0 for false)
    "TrustServerCertificate" => 0           // Trust the server certificate (1 for true, 0 for false)
);
$serverName = "tcp:phpwebappdbserver.database.windows.net,1433"; // Server name and port

// Attempt to establish connection
$sql_conn = sqlsrv_connect($serverName, $connectionInfo);

// Check if connection is successful
if ($sql_conn === false) {
    // If connection fails, retrieve detailed error information
    $errors = sqlsrv_errors();
    foreach ($errors as $error) {
        echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />";
        echo "Code: " . $error['code'] . "<br />";
        echo "Message: " . $error['message'] . "<br />";
    }
    // exit(); // Exit script if connection failed

    /* ***IMPORTANT*** Delete the below code when it successfully connects to the database!!!
       And uncomment the above exit()**** */

       
    echo "Error connecting to DB :("; // Print error message
    exit(); // Exit script if connection failed
} else {
    echo "Connected to DB :)"; // Print success message
}

?>
