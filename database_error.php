//This page is done by Angelee Sullivan-Quintana
//Page for database_error

<?php
session_start();
require('database.php');

$error_message = null;
$movies = [];

try {
  if (isset($_POST['delete'])) {
    $id = $_POST['MovieID'];
    $query = "DELETE FROM Movie WHERE MovieID = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();

  }

  $query = "SELECT * FROM Movie ORDER BY MovieID";
  $movies = $db->query($query)->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $error_message = $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MSU Movie Center</title>
  </head>
  <body>
    <center>
      <h1>MSU Movie Center</h1>
      <h4>Team Members: Manahil Imran, Anthony Dalauro, Jeanine Gomez, Angelee Sullivan-Quintana</h4>
      <a href="add_movie.php">Add a New Movie</a>
      <br><br>

      <?php if ($error_message): ?>
          <h2>Database Error</h2>
          <p>There was a problem accessing the database:</p>
          <p><strong>Error Message:</strong> <?= htmlspecialchars($error_message) ?></p>
          <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">Try Again</a>
      <?php else: ?>
          <h2>All Movies</h2>
          <table border="1" cellpadding="10" cellspacing="0">
              <tr>
                <th>Movie ID</th>
                <th>Title</th>
                <th>Release Date</th>
                <th>Genre</th>
                <th>Update</th>
                <th>Remove</th>
              </tr>
              <?php foreach ($movies as $movie): ?>
                  <tr>
                    <td><?= htmlspecialchars($movie['MovieID']) ?></td>
                    <td><?= htmlspecialchars($movie['MovieTitle']) ?></td>
                    <td><?= htmlspecialchars($movie['ReleaseDate']) ?></td>
                    <td><?= htmlspecialchars($movie['Genre']) ?></td>
                    <td>
                        <form action="edit_movie.php" method="POST">
                            <input type="hidden" name="MovieID" value="<?= htmlspecialchars($movie['MovieID']) ?>">
                                <button name="edit">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                              <input type="hidden" name="MovieID" value="<?= htmlspecialchars($movie['MovieID']) ?>">
                                    <button name="delete">Delete</button>
                        </form>
                    </td>
                  </tr>
            <?php endforeach; ?>
          </table>
      <?php endif; ?>
    </center>
  </body>
</html>
