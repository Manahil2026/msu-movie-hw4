<?php

require('database.php');


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
elseif(isset($_POST["MovieID"])){


    $movieID = $_POST["MovieID"];
    //Get the movie deets
    $query = "select * from Movie where MovieID = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue("id", $movieID);
    $stmt->execute();
    $selectedMovie = $stmt->fetch();
}

else{
    header("Location: index.php"); //No get requests
}

?>

<!DOCTYPE html>

<html>
    <header><title>Edit a Movie</title></header>
    
    
    <body>


    <!--Header-->
    <a href="/index.php">Go Back</a>
    <center>
        <h1>MSU Movie Center</h1>
        <h4>Team Members: Manahil Imran, Anthony Dalauro, Jeanine Gomez, Angelee Sullivan-Quintana</h2>
        <hr/>
    </center>

    
        <h1>Editing <?= $selectedMovie['MovieTitle'] ?></h1>
        <form method="POST" action="/edit_movie.php">
            <input type="hidden" name="id" value=<?= $selectedMovie['MovieID']?>> <!--Just need the id to change-->
            <input type="text" name="title" placeholder="Title" value="<?= htmlspecialchars($selectedMovie['MovieTitle']) ?>">
            <input type="date" name="date" placeholder="Release date" value="<?= htmlspecialchars($selectedMovie['ReleaseDate']) ?>">
            <input type="text" name="genre" placeholder="Movie Genre" value="<?= htmlspecialchars($selectedMovie['Genre']) ?>">
            <input type="submit" name="newValues" value="Update">
        </form>
        <p>This page was made by Ant.</p>
    

        
        
    </body>

</html>
