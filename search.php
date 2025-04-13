<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Search Songs</title>
</head>

<body>

    <style>
        body {
            background-color: #696969;
        }
    </style>

    <nav class="navbar navbar-dark" style="background-color: #2f4858;">
        <a class="navbar-brand" href="spotify.php">
            <img src="images/music.png" width="40" height="40" class="d-inline-block align-top">
            Top Songs
        </a>
        <a class="navbar-brand float-right " href="spotify.php">
            <img src="images/user.png" width="45" height="45" class="d-inline-block align-top">
        </a>
    </nav>

    <div class="container">
        <h2 class="pt-2" style="color: #f8f9fa;">Search by Song Genre</h2>
        <br><br>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Select Genre
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="search.php?genre=pop">Pop</a>
                <a class="dropdown-item" href="search.php?genre=rock">Rock</a>
                <a class="dropdown-item" href="search.php?genre=blues">Blues</a>
                <a class="dropdown-item" href="search.php?genre=reggae">Reggae</a>
                <a class="dropdown-item" href="search.php?genre=hiphop">Hip Hop</a>
                <a class="dropdown-item" href="search.php?genre=jazz">Jazz</a>              
                <a class="dropdown-item" href="search.php?genre=electronic">Electronic</a>
                <a class="dropdown-item" href="search.php?genre=classical">Classical</a>
            </div>
        </div>
        <br><br>

        <div class="row">
            <?php
            // Check if the genre parameter is set
            if (isset($_GET['genre'])) {
                // Get the genre from the URL parameter
                $genre = $_GET['genre'];

                // Make the API call to fetch songs by genre
                $endpoint = "https://phpwebappserc.azurewebsites.net/api.php?genre={$genre}";

                $result = file_get_contents($endpoint);

                // Check if the API call was successful
                if ($result !== false) {
                    // Decode the JSON response
                    $songs = json_decode($result, true);

                    // Check if the response is valid JSON
                    if (is_array($songs)) {
                        // Loop through the songs and display them
                        foreach ($songs as $song) {
                            $songtitle = $song['song'];
                            $songtitle = substr($songtitle, 0, 20); // If song title is too long

                            $album_cover_url = $song['album_cover'];
                            $song_id = $song['ID']; // Get the song ID

                            // Display the song information in the card format
                            echo "
                                <div class='col-md-4'>
                                    <div class='card mb-3'>
                                        <img src='$album_cover_url' class='card-img-top' alt='Album Cover'>
                                        <div class='card-body'>
                                            <h3 class='card-text'><strong> Genre:</strong>  {$song['genre']}</h3>
                                            <h2 class='card-title'>{$song['artist']}</h2>
                                            <p class='card-text'>{$songtitle}...</p>
                                            <a href='viewone.php?song_id=$song_id' class='btn btn-dark'>More Info</a> 
                                        </div>
                                    </div>
                                </div>";
                        }
                    } else {
                        // Handle the case where the API call fails
                        echo "<p>Error: Failed to fetch data from API.</p>";
                    }
                } else {
                    // Handle the case where the genre parameter is not set
                    echo "<p>Error: Genre parameter is missing.</p>";
            }
        }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
