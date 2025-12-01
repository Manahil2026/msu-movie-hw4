
<?php
  //This page is done by Angelee Sullivan-Quintana</p>
  //Page for database_error
  
  $err = $error_message ?? "Unkown Error"
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MSU Movie Center</title>
    <link rel="stylesheet" href="css/database_error.css">
  </head>


  <body>

    <div class="header">
        <div class="header-content">
            <h1>MSU Movie Center</h1>
            <h4>Team Members: Manahil Imran, Anthony Dalauro, Jeanine Gomez, Angelee Sullivan-Quintana</h2>
        </div>
    </div>
    
    <div class="main-area">
      <div class="error-box">
        <h2>Database Error</h2>
        <p>There was a problem accessing the database:</p>
        <p><strong>Error Message:</strong> <?= htmlspecialchars($error_message) ?></p>
        <a class="btn" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">Try Again</a>
      </div>
    </div>  
      
  </body>
</html>
