<?php
include('conn.php');

// Check if the database connection is successful
if (!$sql_conn) {
    // If the connection fails, return an error message
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Error connecting to the database"));
    exit(); // Exit the script
}

// Debugging output
echo '<pre>';
print_r($_POST);
echo '</pre>';

// Check if all required parameters are given
if (
    isset($_POST['song']) &&
    isset($_POST['album']) &&
    isset($_POST['artist']) &&
    isset($_POST['genre']) &&
    isset($_POST['album_cover']) &&
    isset($_POST['artist_popularity']) &&
    isset($_POST['song_popularity'])
) {
    // get input parameters
    $song = $_POST['song'];
    $album = $_POST['album'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $album_cover = $_POST['album_cover'];
    $artist_popularity = (int)$_POST['artist_popularity']; // Cast to integer
    $song_popularity = (int)$_POST['song_popularity']; // Cast to integer

    // make the SQL query to insert data into the database
   $query = "INSERT INTO Spotify (song, album, artist, genre, album_cover, artist_popularity, song_popularity) VALUES (?, ?, ?, ?, ?, ?, ?)";

    
    // Prepare the SQL query
    $params = array($song, $album, $artist, $genre, $album_cover, $artist_popularity, $song_popularity);
    $stmt = sqlsrv_query($sql_conn, $query, $params);

    // Check if the query execution was successful
    if ($stmt) {
        // If successful, return success message
        header('Content-Type: application/json');
        echo json_encode(array("message" => "Song added successfully"));
    } else {
        // If the query fails, return an error message with additional details
        $error_details = sqlsrv_errors();
        $error_message = "Error adding song FFS!: " . $error_details[0]['message'];

    }
}

// Close the database connection
sqlsrv_close($sql_conn);
?>
