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
  </head>
  <body>
    <center>
      <h1>MSU Movie Center</h1>
      <h4>Team Members: Manahil Imran, Anthony D'Alauro, Jeanine Gomez, Angelee Sullivan-Quintana</h4>

      <!-- nav links -->
      <a href="add_movie.php">Add a New Movie</a>
      <br><br>

      <h2>Add Movie</h2>

      <!-- Form to add a movie -->
      <form action="add_movie.php" method="POST">
        <label>
          Title:<br>
          <input type="text" name="MovieTitle"
                  value="<?= isset($title) ? htmlspecialchars($title) : '' ?>">
        </label>
        <br><br>

        <label>
          Release Date (YYYY-MM-DD):<br>
          <input type="text" name="ReleaseDate"
                  value="<?= isset($release_date) ? htmlspecialchars($release_date) : '' ?>">
        </label>
      
      
        <br><br>
        <label>
          Genre: <br>
          <input type="text" name="Genre" 
                  value="<?= isset($title) ? htmlspecialchars($title) : '' ?>">
        </label>


        <br><br>
        <button type="submit" name="insert">Insert Movie</button>
      </form>
      <p>$copy; 2025 MSU</p>
    </center>
  </body>
</html>
