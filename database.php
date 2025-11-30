<?php
    // This page is done by Manahil Imran
    // Establish a databse connection
    // Copied from the instrcutions given by professor

    $dsn = 'mysql:host=localhost;dbname=MSU_Movies';
    $username = 'mgs_user';
    $password = 'pa55word';
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?> 
