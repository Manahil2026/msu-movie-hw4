<?php

require('database.php');

//You gave me a movie id, and a set of new values, so you probably are changing a movie
if(isset($_POST["newValues"]) and isset($_POST['id'])){
            $newValues = $_POST["newValues"];

            $query = "
                update Movie set
                    MovieTitle = :title,
                    ReleaseDate = :date,
                    Genre = :genre                            
                where MovieID = :id";
            $stmt = $db->prepare($query);
            $stmt->bindValue("title", $_POST["title"] ?? "");
            $stmt->bindValue("date", $_POST["date"] ?? "");
            $stmt->bindValue("genre", $_POST["genre"] ?? "");
            $stmt->bindValue("id", $_POST["id"]); //Because I need to identify it SOMEHOW. You can't change the ID.
            $stmt->execute();
            header("Location: index.php");
        }

//You gave me just a movie id, so you probably just want to change a movie
elseif(isset($_POST["MovieID"])){
    $movieID = $_POST["MovieID"];
    //Get the movie deets
    $query = "select * from Movie where MovieID = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue("id", $movieID);
    $stmt->execute();
    $selectedMovie = $stmt->fetch();
    $stmt->closeCursor();
}

else{
    //You are probably sending a get request. I reject your get request.
    header("Location: index.php"); //No get requests
}

?>

<!DOCTYPE html>

<html>
    <header>
        <title>Edit a Movie</title>
        <link rel="stylesheet" href="css/edit_movie.css">
        
    </header>
    
    
    <body>


    <!--Header-->
    <div class="header">
        <div class="header-content">
            <h1>MSU Movie Center</h1>
            <h4>Team Members: Manahil Imran, Anthony Dalauro, Jeanine Gomez, Angelee Sullivan-Quintana</h2>
        </div>
    </div>


    <div class="main-area">
        <h1>Editing <?= $selectedMovie['MovieTitle'] ?></h1>
        <p>The below values are the current values for this movie. Change the desired value and click on "Set New Values" to update them</p>
        <form method="POST" action="edit_movie.php">

            <div class="form-content">
                <input type="hidden" name="id" value="<?= $selectedMovie['MovieID'] ?>">

                <div class="input-group">
                    <label>Movie Title: </label>
                    <input type="text" name="title" placeholder="Title" value="<?= htmlspecialchars($selectedMovie['MovieTitle']) ?>">
                </div>
                
                <div class="input-group">
                    <label>Release Date:</label>
                    <input type="date" name="date" placeholder="Release date" value="<?= htmlspecialchars($selectedMovie['ReleaseDate']) ?>">
                </div>
                
                <div class="input-group">
                    <label>Movie Genre:</label>
                    <input type="text" name="genre" placeholder="Movie Genre" value="<?= htmlspecialchars($selectedMovie['Genre']) ?>">
                </div>

                <input class="button" type="submit" name="newValues" value="Set New Values">
            </div>
    
            
            
        </form>
        <!--Go back button-->
        <a class="button" href="index.php">Go back</a>
        
    </div>

    <!--Footer-->
    <p class="footer">This page was made by Ant.</p>    
    


    </body>

</html>
