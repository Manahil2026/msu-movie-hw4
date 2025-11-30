<?php
    // This page is done by Manahil Imran
    require('database.php'); // include databse connection

    //Delete a movie if movie button is clicked
    if(isset($_POST['delete'])){ //checks if delete button is clicked
        $id = $_POST['MovieID']; //gets the movie id from the form
        $query = "DELETE FROM Movie WHERE MovieID = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();

    }

    //Query all movies from the databse
    $query = "SELECT * FROM Movie ORDER BY MovieID";
    $movies = $db->query($query);


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8"> 
        <title>MSU Movie Center</title>
    </head>
    <body>
        <center>
        <h1>MSU Movie Center</h1>
        <h4>Team Members: Manahil Imran, Anthony Dalauro, Jeanine Gomez, Angelee Sullivan-Quintana</h2>

        <a href="add_movie.php">Add a New Movie</a>
        <br><br>
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
                    <td><?= $movie['MovieID']?></td>
                    <td><?= $movie['MovieTitle']?></td>
                    <td><?= $movie['ReleaseDate']?></td>
                    <td><?= $movie['Genre']?></td>

                    <td>
                        <form action="edit_movie.php" method="POST">
                            <input type="hidden" name="MovieID" value="<?= $movie['MovieID']?>">
                            <button name="edit">Edit</button>
                        </form>
                    </td>
                    
                    <td>
                        <form action="index.php" method="POST">
                            <input type="hidden" name="MovieID" value="<?= $movie['MovieID']?>">
                            <button name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
            </center>
    </body>
</html>