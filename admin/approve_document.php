<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
include('db.php');

// Check if the document_id is set in the POST request
if (isset($_POST['document_id'])) {
    $documentId = $_POST['document_id'];

    try {
        // Prepare and execute the update statement
        $stmt = $pdo->prepare("UPDATE documents SET status = 'Approved' WHERE id = :document_id");
        $stmt->bindParam(':document_id', $documentId);
        
        if ($stmt->execute()) {
            // Success message
            $_SESSION['success_message'] = "Document request approved successfully.";
        } else {
            // Error message
            $_SESSION['error_message'] = "Failed to approve document request.";
        }
    } catch (PDOException $e) {
        // Error handling
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }
}

// Redirect back to the previous page
header("Location: transactions.php"); // Change this to your actual page
exit();
?>
