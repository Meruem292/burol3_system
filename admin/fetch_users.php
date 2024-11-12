<?php
require 'db.php'; // Include your PDO connection

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    
    // Use prepared statement to search for matching names
    $stmt = $pdo->prepare("SELECT full_name FROM user WHERE full_name LIKE ? LIMIT 10");
    $stmt->execute(['%' . $query . '%']);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If results exist, return them as JSON, otherwise return an empty array
    if ($results) {
        echo json_encode($results);
    } else {
        echo json_encode([]); // Return empty array if no match is found
    }
}
?>
