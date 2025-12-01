<?php
//This page is done by Jeanine Gomez
//Page to add a new movie to the MSU_Movies database

require('database.php');

$error_message = '';

//if the form has been submitted, process the insert

if (isset($_POST['insert'])) {
  $title  = trim($_POST['MovieTitle'] ??'');
  $release_date  = trim($_POST['ReleaseDate'] ?? '');
  $genre  = trim($_POST['Genre'] ?? '');
  
  if ($title === '' || $release_date === '' || $genre === '') {
    $error_message = 'All fields are required.';
    } else {
        $query = "INSERT INTO Movie (MovieTitle, ReleaseDate, Genre)
                  VALUES (:title, :release_date, :genre)";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':release_date', $release_date);
        $statement->bindValue(':genre', $genre);
        $statement->execute();
        $statement->closeCursor();

        header("Location: index.php");
        exit();
        }
 }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add Movie - MSU Movie Center</title>
    <link rel="stylesheet" href="css/add_movie.css">
  </head>
  <body>


    <div class="header">
      <div class="header-content">
          <h1>MSU Movie Center</h1>
          <h4>Team Members: Manahil Imran, Anthony Dalauro, Jeanine Gomez, Angelee Sullivan-Quintana</h2>
      </div>
    </div>


    <div class="main-area">
      <h1>Adding a Movie</h1>

      <!-- Form to add a movie -->
      <div class="form-content">
        <form action="add_movie.php" method="POST">
            <div class="input-group">
              <label>Enter a title for the new movie:</label>
              <input type="text" name="MovieTitle" value="<?= isset($title) ? htmlspecialchars($title) : '' ?>">
            </div>
            
            <div class="input-group">
              <label>Enter the release date for the movie: </label>
              <input type="date" name="ReleaseDate" value="<?= isset($release_date) ? htmlspecialchars($release_date) : '' ?>">
            </div>
          
            <div class="input-group">
              <label>Enter the Genre for the movie:</label>
              <input type="text" name="Genre" value="<?= isset($genre) ? htmlspecialchars($genre) : '' ?>">
            </div>
                      
          <button class="btn" type="submit" name="insert">Add The Movie</button>
        </form>
      </div>

      <a class="btn" href="index.php">Go back</a>

    </div>
    
  </body>
</html>


