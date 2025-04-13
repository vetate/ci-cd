<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href=https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css>
  <title>Top Spotify Songs</title>
</head>

<!-- Below is the top page bar -->
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">
      <img src="images/music.png" width="40" height="40" class="d-inline-block align-top">
      Top Songs
    </a>
    <a class="navbar-brand float-right " href="dashboard.php">
      <img src="images/user.png" width="45" height="45" class="d-inline-block align-top">
    </a>
  </nav>

<!-- Below is the card container from Bootstrap, this is where we will pull all the database info into -->

  <div class="container">

    <h2 class="pt-2">Top Spotify Songs</h2>

    <div class="card float-left mr-2 mb-2 " style="width: 16rem;">
      <img src="images/music.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Title Here</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Buy</a>
      </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>