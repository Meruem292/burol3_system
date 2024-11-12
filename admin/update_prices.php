<?php
session_start();
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $new_price = $_POST['price'];

    // Update the price in the database
    $stmt = $pdo->prepare("UPDATE prices SET price = :price WHERE id = :id");
    $stmt->execute([':price' => $new_price, ':id' => $id]);

    // Optionally, you can set a success message or redirect
    $_SESSION['message'] = "Price updated successfully.";
    header("Location: transactions.php"); // Redirect back to your page
    exit;
}
?>
