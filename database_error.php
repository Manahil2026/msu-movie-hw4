//This page is done by Angelee Sullivan-Quintana
//Page for database_error

<?php

// Start session to pass error messages if needed
session_start();

// Include your database connection file (adjust path as needed)
require('database.php');

try {

  $query = "SELECT * FROM Movie LIMIT 1";
  $statement = $db->prepare($query);
  $statement->execute();
} catch (PDOException $e) {
    // Display a user-friendly database error message
    echo "</DOCTYPE html>";
    echo "<html><head><meta charset='UTF-8'><title>Database Error</title></head><body>";
    echo "<center>";
    echo "<h2>Database Error</h2>";
    echo "<p>There was a problem accessing the database:</p>";
    echo "<p><strong>Error Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>Error Code:</strong> " . htmlspecialchars($e->getCode()) . "</p>";
    echo "</center>";
    echo "</body></html>";

    // Optional: log the error for developers/admins (uncomment to enable)
    // error_log($e->getMessage());

    exit; // Stop further execution on error
}

// If no error, optionally redirect back or display normal content
header("Location: index.php");
exit;
?>
