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

    <h2 class="pt-2" style="color: #f8f9fa;">Song Details</h2>

    <?php
    // Check if song_id is set in the URL
    if (isset($_GET['song_id'])) {
        // Retrieve song details based on song_id
        $song_id = $_GET['song_id'];
        $endpoint = "https://phpwebappserc.azurewebsites.net/apiOne.php?song_id=$song_id";
        $result = file_get_contents($endpoint);
        $song = json_decode($result, true);

        // Display song details
        echo "
            <div class='card mx-auto mb-2' style='width: 30rem;'>
              <img src='{$song['album_cover']}' class='card-img-top' alt='Album Cover'>
              <div class='card-body'>
                <h2 class='card-title'>{$song['artist']}</h2>
                <p class='card-text'><strong>Song Title:</strong> {$song['song']}</p>
                <p class='card-text'><strong> Album:</strong>  {$song['album']}</p>
                <p class='card-text'><strong> Genre:</strong>  {$song['genre']}</p>
                <p class='card-text'><strong> Artist Popularity:</strong>  {$song['artist_popularity']}</p>
                <p class='card-text'><strong> Song Popularity:</strong>  {$song['song_popularity']}</p>
                <a href='spotify.php' class='btn btn-dark'>Back</a>
              </div>
              
            </div>";
    } else {
        echo "<p>No song selected.</p>";
    }
    ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
