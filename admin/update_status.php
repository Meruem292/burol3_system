<?php
include 'db.php';
$document_id = $_POST['document_id'];
if (isset($_POST['document_id'], $_POST['status'])) {
    $document_id = $_POST['document_id'];
    $status = $_POST['status'];

    // Validate the status value to prevent unwanted input
    $valid_statuses = ['Pending', 'Approved', 'Disapproved'];

    try {
        // Prepare the SQL query to update the status of the document
        $stmt = $pdo->prepare("UPDATE documents SET status = :status WHERE id = :id");
        // Execute the query
        $result = $stmt->execute([':status' => $status, ':id' => $document_id]);

        // Check if the update was successful
        if ($result) {
            header("Location: transactions.php");
        } else {
            echo "No changes were made to the document. Please check if the document ID exists.";
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating status: " .$document_id . $e->getMessage() ;
    }
} else {
    echo "Invalid request. Document ID and status are required." .$document_id ;
}
?>
