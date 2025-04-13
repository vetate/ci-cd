<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Top Spotify Songs</title>
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

  <br><br>
    <!-- FORM -->
    <form id="songForm" action="apiCreate.php" method="post">
      <!-- Artist Section of Form -->
      <div class="form-group row">
        <label class="col-4 col-form-label" for="artist" style="color: #f8f9fa;">Artist:</label>
        <div class="col-8">
          <input name="artist" type="text" class="form-control" required="required">
        </div>
      </div>

      <!-- Genre Drop Down List Section of Form -->
      <div class="form-group row">
        <label for="genre" class="col-4 col-form-label" style="color: #f8f9fa;">Genre</label>
        <div class="col-8">
          <select name="genre" class="custom-select" required="required">
            <option value="Rock">Rock</option>
            <option value="Pop">Pop</option>
            <option value="Metal">Heavy Metal</option>
            <option value="Hip ">Hip Hop</option>
            <option value="Reggae">Reggae</option>
            <option value="Jazz">Jazz</option>
            <option value="Electronic">Electronic</option>
            <option value="Blues">Blues</option>
          </select>
        </div>
      </div>

      <!-- Song Title Section of Form -->
      <div class="form-group row">
        <label class="col-4 col-form-label" for="album" style="color: #f8f9fa;">Song Title</label>
        <div class="col-8">
          <input name="song" type="text" class="form-control" required="required">
        </div>
      </div>

      <!-- Album Section of Form -->
      <div class="form-group row">
        <label class="col-4 col-form-label" for="album" style="color: #f8f9fa;">Album</label>
        <div class="col-8">
          <input name="album" type="text" class="form-control" required="required">
        </div>
      </div>

      <!-- Cover Image URL Section of Form -->
      <div class="form-group row">
        <label class="col-4 col-form-label" for="album_cover" style="color: #f8f9fa;">Album Cover URL</label>
        <div class="col-8">
          <input name="album_cover" type="text" class="form-control" required="required">
        </div>
      </div>

      <!-- song Rank Section of Form -->
      <div class="form-group row">
        <label for="song_popularity" class="col-4 col-form-label" style="color: #f8f9fa;">Song Rank</label>
        <div class="col-8">
          <input name="song_popularity" placeholder="0-100" type="text" class="form-control" required="required">
        </div>
      </div>

      <!-- Artist Rank Section of Form -->
      <div class="form-group row">
        <label for="artist_popularity" class="col-4 col-form-label" style="color: #f8f9fa;">Artist Rank</label>
        <div class="col-8">
          <input name="artist_popularity" placeholder="0-100" type="text" class="form-control" required="required">
        </div>
      </div>

      <!-- Form Submit button takes the FORM ACTION ABOVE  -->
      <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-dark">Submit</button>
        </div>
      </div>
    </form>

   <!-- Display flash message -->
   <?php if (isset($_SESSION['flash_message'])): ?>
            <div id="message" class="alert <?php echo strpos($_SESSION['flash_message'], 'Error') !== false ? 'alert-danger' : 'alert-success'; ?>">
                <?php echo $_SESSION['flash_message']; ?>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

  </div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>




</body>

</html>
