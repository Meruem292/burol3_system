<?php
session_start();
require "db.php";

$user_requests = [];

if (isset($_SESSION['user_id'])) {
    // If the user is logged in, retrieve their full name
    $stmt = $pdo->prepare("SELECT full_name FROM user WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Use full_name to fetch user's documents
        $full_name = $user['full_name'];
        $stmt = $pdo->prepare("SELECT * FROM documents WHERE full_name = :full_name");
        $stmt->execute([':full_name' => $full_name]);
        $user_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Convert requests to JSON format
echo json_encode($user_requests);
?>