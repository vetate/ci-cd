<?php
include('conn.php');

// Check if the database connection is successful
if (!$sql_conn) {
    // If the connection fails, return an error message
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Error connecting to the database"));
    exit(); // Exit the script
}

// ----------------------------------------Top 100 Songs--------------------------------

// Check if the 'top' parameter is set to retrieve top 100 songs
if (isset($_GET['top'])) {
    header('Content-Type: application/json');
    
    // SQL query to select top 100 songs
    $spotify = "SELECT TOP 100 * FROM Spotify"; // Corrected table name
    
    $result = sqlsrv_query($sql_conn, $spotify);

    if ($result === false) {
        echo json_encode(array("error" => "Error executing query: " . print_r(sqlsrv_errors(), true)));
        exit();
    }

    $top = array();

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
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

        $top[] = $song_data;
    }

    // Free the statement resources
    sqlsrv_free_stmt($result);

    // Return the data as JSON
    echo json_encode($top);
    exit();
}

// ----------------------------------------By Genre--------------------------------

// Check if the 'genre' parameter is set to retrieve songs by genre
if (isset($_GET['genre'])) {
    $genre = $_GET['genre'];

    // Construct the SQL query to select data based on genre
    $query = "SELECT * FROM Spotify WHERE genre = ?";
    $params = array($genre);

    

    // Prepare and execute the SQL query
    $stmt = sqlsrv_query($sql_conn, $query, $params);

    if ($stmt === false) {
        header('Content-Type: application/json');
        echo json_encode(array("error" => "Error executing query: " . print_r(sqlsrv_errors(), true)));
        exit();
    }

    // Fetch the results and build an array of data
    $songs_arr = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $songs_arr[] = $row;
    }

    // Free the statement resources
    sqlsrv_free_stmt($stmt);

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($songs_arr);
    exit();
}

// ----------------------------------------By Song popularity--------------------------------

// Check if the 'all' parameter is set to retrieve all songs
elseif (isset($_GET['all'])) {
    header('Content-Type: application/json');
    
    // SQL query to select all songs and their popularity
    $spotify = "SELECT * FROM Spotify ORDER BY song_popularity DESC"; 
    
    $result = sqlsrv_query($sql_conn, $spotify); 

    if (!$result) {
        echo json_encode(array("message" => "Error retrieving songs."));
        exit();
    }

    $songs_arr = array();

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) { 
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

        array_push($songs_arr, $song_data);
    }

    echo json_encode($songs_arr);
    exit();
}

// ----------------------------------------By Rank of Artist--------------------------------

// Check if the 'rank' parameter is set to retrieve a song by rank
if (isset($_GET['rank'])) {
    $rank = $_GET['rank'];

    // Ensure rank is a positive integer
    if (!is_numeric($rank) || intval($rank) <= 0) {
        header('Content-Type: application/json');
        echo json_encode(array("error" => "Invalid rank. Rank must be a positive integer."));
        exit();
    }

    // Construct the SQL query to select data based on rank
    $query = "SELECT * FROM Spotify WHERE artist_popularity = ?";

    $params = array($rank);

    // Prepare and execute the SQL query
    $stmt = sqlsrv_query($sql_conn, $query, $params);

    if ($stmt === false) {
        header('Content-Type: application/json');
        echo json_encode(array("error" => "Error executing query: " . print_r(sqlsrv_errors(), true)));
        exit();
    }

    // Fetch the result
    $songs_arr = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
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

        array_push($songs_arr, $song_data);
    }

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($songs_arr);
    exit();
}

// ----------------------------------------Search by Artist--------------------------------

// Check if the 'artist_search' parameter is set to search for songs by artist
if (isset($_GET['artist_search'])) {
    // Get the artist search term from the URL parameter
    $artist_search = $_GET['artist_search'];

    // Construct the SQL query to select data based on artist search term
    $query = "SELECT * FROM Spotify WHERE artist LIKE ?";
    $params = array('%' . $artist_search . '%');

    // Prepare and execute the SQL query
    $stmt = sqlsrv_query($sql_conn, $query, $params);

    if ($stmt === false) {
        header('Content-Type: application/json');
        echo json_encode(array("error" => "Error executing query: " . print_r(sqlsrv_errors(), true)));
        exit();
    }

    // Fetch the result
    $songs_arr = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $songs_arr[] = $row;
    }

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($songs_arr);
    exit();
}

// If no valid endpoint is specified
header('Content-Type: application/json');
echo json_encode(array("error" => "Invalid endpoint. Specify a valid parameter."));

// 
?> 
