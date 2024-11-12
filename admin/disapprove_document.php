<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $document_id = $_POST['document_id'];

    // Update the document's status to disapproved in the database
    $stmt = $pdo->prepare("UPDATE documents SET status = 'Disapproved' WHERE id = :document_id");
    $stmt->execute([':document_id' => $document_id]);

    // Optionally, you can set a success message
    $_SESSION['message'] = "Document disapproved successfully.";

    // Redirect to the transactions or payment receipts page
    header("Location: transactions.php");
    exit;
}
?>
