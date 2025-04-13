<!-- Connection to the Database -->
<?php
include("conn.php");

// Check if connection is successful
if ($sql_conn === false) {
    die("ERROR: Could not connect. " . sqlsrv_errors());
}

// Add a variable to hold the string for the title
$helloserc = "Ed Sheeran";

// Perform query
$sql = "SELECT artist FROM Spotify WHERE artist = ?";
$params = array($helloserc); // Assuming 'serc_ve' is a value you want to search for in a specific column

$result = sqlsrv_query($sql_conn, $sql, $params);

if ($result === false) {
    echo "ERROR: Could not execute $sql.";
    die(print_r(sqlsrv_errors(), true));
}

// Fetch the result
if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    echo "<h1>" . $row['artist'] . "</h1>";
} else {
    echo "No records found.";
}

// Close result and connection
sqlsrv_free_stmt($result);
sqlsrv_close($sql_conn);
?>
<!-- Connection PHP End -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The browser page title -->
    <title>Hello SERC!</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- using echo to output the string to the page. The PHP variable is wrapped in a HTML <h1> tag -->
    <h1><?php echo $helloserc; ?></h1>
    <p>Simple CRUD system here... <br>
        <br>
        Using PhpMyAdmin
        <br>
        <br>
     
        <br>
        <?php if (isset($row['artist'])) echo "<h1>" . $row['artist'] . "</h1>"; ?>
    </p>
</body>

</html>
