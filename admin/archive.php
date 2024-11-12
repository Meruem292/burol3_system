<?php
// Include your database connection file
include('db.php'); // Adjust this to your actual connection file

// Include the function for archiving
include('functions.php'); // The function we wrote earlier

if (isset($_POST['archive'])) {
    // Get the record ID from the form
    $id = $_POST['id'];
    $table = $_POST['table'];
    
    // Call the archiveData function to archive the record
    $result = archiveData($pdo, $table, $id); // Replace 'announcements' with your actual table
    
    // Show the result message
    echo $result;
}
?>
