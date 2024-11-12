<?php 

function generateTrackingNumber()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $trackingNumber = 'BRGYB3-';

    // Generate 3 groups of 3 characters
    for ($i = 0; $i < 3; $i++) {
        $group = '';
        for ($j = 0; $j < 3; $j++) {
            $group .= $characters[rand(0, strlen($characters) - 1)];
        }
        $trackingNumber .= $group . '-';
    }

    // Add the last group of 4 characters
    for ($i = 0; $i < 4; $i++) {
        $trackingNumber .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $trackingNumber;
}

function generateControlNumber()
{
    $numbers = array();

    for ($i = 0; $i < 6; $i++) {
        $numbers[] = rand(0, 9);
    }

    $controlNumber = implode("", $numbers);
    return $controlNumber;
}

function getGcashMOP()
{
    global $pdo;
    // Adjust the SQL to order by 'updated_at' and limit to the latest record
    $stmt = $pdo->prepare("SELECT image_path FROM payment_methods ORDER BY updated_at DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

?>