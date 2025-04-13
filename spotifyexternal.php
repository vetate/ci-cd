<?php
// Endpoint URL for getting top tracks
$endpoint = "https://api.spotify.com/v1/me/top/tracks";

// Set the access token obtained after user authentication
$access_token = "YOUR_ACCESS_TOKEN_HERE"; // Replace with your actual access token

// Set up HTTP headers for the request
$options = array(
    'http' => array(
        'method' => 'GET',
        'header' => "Authorization: Bearer $access_token"
    )
);

// Create a stream context
$context = stream_context_create($options);

// Make the API call
$result = file_get_contents($endpoint, false, $context);

// Check for errors
if ($result === false) {
    echo 'Error: Failed to retrieve data from the API.';
    exit;
}

// Decode the JSON response
$top = json_decode($result, true);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <title>Top Spotify Songs</title>
</head>

<body>
<style>
  body {
    background-color: #4a5759;
  }
</style>

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">
      <img src="images/music.png" width="40" height="40" class="d-inline-block align-top">
      Top Songs
    </a>
    <a class="navbar-brand float-right " href="dashboard.php">
      <img src="images/user.png" width="45" height="45" class="d-inline-block align-top">
    </a>
  </nav>

  <div class="container">

    <h2 class="pt-2" style="color: #f8f9fa;">Top Spotify Songs</h2>

    <?php
    // Display top songs
    foreach ($top['items'] as $track) {
        $songtitle = $track['name'];
        $artist = $track['artists'][0]['name'];
        $album_cover_url = $track['album']['images'][0]['url'];
        $song_id = $track['id']; // Assuming 'id' is the unique identifier for the song

        echo "
            <div class='card float-left mr-2 mb-2 ' style='width: 16rem;'>
              <img src='$album_cover_url' class='card-img-top' alt='Album Cover'>
              <div class='card-body'>
                <h5 class='card-title'>$artist</h5>
                <p class='card-text'>$songtitle</p>
                <a href='viewone.php?song_id=$song_id' class='btn btn-dark'>More Info</a> 
              </div>
            </div>";
    }
    ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
