<?php
require 'db.php'; // Include your database connection file

header('Content-Type: application/json');

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$tracking_number = $data['tracking_number'] ?? null;

if ($tracking_number) {
    // Query to check the request details using the tracking number
    $stmt = $pdo->prepare("SELECT id, tracking_number, full_name, address, age, pickup_date, pickup_time, year_residency, purpose, category, note, type, status, control_number, date_added, delivery_mode, amount_to_prepare FROM documents WHERE tracking_number = :tracking_number");
    $stmt->execute(['tracking_number' => $tracking_number]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        // Return all the details in JSON format
        echo json_encode(['success' => true, 'data' => $result]);
    } else {
        // Return an error if no record found
        echo json_encode(['success' => false, 'message' => 'Tracking number not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No tracking number provided.']);
}
?>
