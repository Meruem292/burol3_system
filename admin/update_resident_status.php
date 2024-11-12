<?php 
session_start();
include "db.php";
function updateResidentStatus($pdo, $resident_id, $new_status) {
    // Check if the status is valid
    $allowed_statuses = ['Pending', 'Approved', 'Declined'];
    if (!in_array($new_status, $allowed_statuses)) {
        return false;
    }

    try {
        // Prepare the update statement
        $stmt = $pdo->prepare("UPDATE user SET status = :status WHERE user_id = :resident_id");
        $stmt->bindParam(':status', $new_status);
        $stmt->bindParam(':resident_id', $resident_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['status_update_success'] = true;
            header("Location: resident.php"); // Redirect to the residents page after update
            exit();
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Error updating resident status: " . $e->getMessage());
        return false;
    }
}

// Handle form submission
if (isset($_POST['edit_resident_status'])) {
    $resident_id = $_POST['resident_id'];
    $new_status = $_POST['resident_status'];

    // Call the function to update status
    if (updateResidentStatus($pdo, $resident_id, $new_status)) {
        echo "Status updated successfully.";
    } else {
        echo "Failed to update status.";
    }
}
?>
?>