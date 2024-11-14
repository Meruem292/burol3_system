<?php
session_start();
// Include your database connection file
include('db.php'); // Adjust this to your actual connection file

// Include the function for archiving
include('functions.php'); // Make sure archiveData is correctly defined in this file

if (isset($_POST['unarchive'])) {
    // Get the record ID from the form
    $id = $_POST['id'];
    $table = $_POST['table'];

    // Call the archiveData function to archive the record
    $result = unArchiveData($pdo, $table, $id);

    // Redirect back to the previous page
    if ($result) {
        // Use HTTP_REFERER to go back to the last visited page
        logAction($pdo, $_SESSION['role'], "Unarchived a record from $table");
        
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Failed to Unarchive the record.";
    }
}
