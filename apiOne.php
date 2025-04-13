<?php
include('conn.php');

// Function to send JSON response and exit
function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// Check if the database connection is successful
if (!$sql_conn) {
    sendResponse(array("error" => "Error connecting to the database"));
}

// Check if the 'song_id' parameter is set
if (isset($_GET['song_id'])) {
    $song_id = $_GET['song_id']; // Get the song ID

    // Prepare SQL statement to select teh
    $query = "SELECT * FROM Spotify WHERE ID = ?";
    $params = array($song_id);
    $stmt = sqlsrv_query($sql_conn, $query, $params);

    // Check if the query execution was successful
    if (!$stmt) {
        sendResponse(array("error" => "Error retrieving song by ID"));
    }

    // Fetch the result
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (!$row) {
        sendResponse(array("error" => "Song not found"));
    }

    // Prepare the song data
    $song_data = array(
        'ID' => $row['ID'],
        'song' => $row['song'],
        'album' => $row['album'],
        'artist' => $row['artist'],
        'genre' => $row['genre'],
        'album_cover' => $row['album_cover'],
        'artist_popularity' => $row['artist_popularity'],
        'song_popularity' => $row['song_popularity']
    );

    sendResponse($song_data);

    // Free the statement resources
    sqlsrv_free_stmt($stmt);
} else {
    // If the 'song_id' parameter is not set, return an error message
    sendResponse(array("error" => "Invalid endpoint. Specify the 'song_id' parameter."));
}

// Close the database connection
sqlsrv_close($sql_conn);
?>
