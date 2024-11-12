<?php

// functions.php

function logAction($pdo, $user, $action, $details = null)
{
    // Prepare the SQL query
    $query = $pdo->prepare("INSERT INTO logs (user, date_log, action, details) VALUES (?, NOW(), ?, ?)");
    $query->execute([$user, $action, $details]);
}

// Manage Officials
if (isset($_POST['btn_add_official'])) {
    $txt_cname = $_POST['txt_cname'];
    $txt_contact = $_POST['txt_contact'];
    $txt_address = $_POST['txt_address'];
    $txt_sterm = $_POST['txt_sterm'];
    $txt_eterm = $_POST['txt_eterm'];

    // Add the official
    $query = $pdo->prepare("INSERT INTO officials (full_name, contact_number, address, start_term, end_term) VALUES (?, ?, ?, ?, ?)");

    if ($query->execute([$txt_cname, $txt_contact, $txt_address, $txt_sterm, $txt_eterm])) {
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added Official', 'Name: ' . $txt_cname);
        }
        $_SESSION['added'] = 1;
        header("location: officials.php");
    } else {
        $_SESSION['existing_official'] = 1;
        header("location: officials.php");
    }
}
if (isset($_POST['btn_edit_official'])) {
    $txt_id = $_POST['hidden_id'];
    $txt_edit_cname = $_POST['txt_edit_cname'];
    $txt_edit_contact = $_POST['txt_edit_contact'];
    $txt_edit_address = $_POST['txt_edit_address'];
    $txt_edit_sterm = $_POST['txt_edit_sterm'];
    $txt_edit_eterm = $_POST['txt_edit_eterm'];

    // Get current data for comparison
    $query_current = $pdo->prepare("SELECT full_name, contact_number, address, start_term, end_term FROM officials WHERE id = ?");
    $query_current->execute([$txt_id]);
    $current_data = $query_current->fetch(PDO::FETCH_ASSOC);

    // Update the official
    $query = $pdo->prepare("UPDATE officials SET full_name = ?, contact_number = ?, address = ?, start_term = ?, end_term = ? WHERE id = ?");
    $success = $query->execute([$txt_edit_cname, $txt_edit_contact, $txt_edit_address, $txt_edit_sterm, $txt_edit_eterm, $txt_id]);

    if ($success) {
        // Log the action with details of the changes
        if (isset($_SESSION['role'])) {
            $changes = [];
            if ($current_data['full_name'] !== $txt_edit_cname) {
                $changes[] = sprintf('Name: "%s" to "%s"', $current_data['full_name'], $txt_edit_cname);
            }
            if ($current_data['contact_number'] !== $txt_edit_contact) {
                $changes[] = sprintf('Contact: "%s" to "%s"', $current_data['contact_number'], $txt_edit_contact);
            }
            if ($current_data['address'] !== $txt_edit_address) {
                $changes[] = sprintf('Address: "%s" to "%s"', $current_data['address'], $txt_edit_address);
            }
            if ($current_data['start_term'] !== $txt_edit_sterm) {
                $changes[] = sprintf('Start Term: "%s" to "%s"', $current_data['start_term'], $txt_edit_sterm);
            }
            if ($current_data['end_term'] !== $txt_edit_eterm) {
                $changes[] = sprintf('End Term: "%s" to "%s"', $current_data['end_term'], $txt_edit_eterm);
            }

            // Log only if there are changes
            if (!empty($changes)) {
                logAction($pdo, $_SESSION['role'], 'Updated Official', 'Edited Official ID: ' . $txt_id . '. Changes: ' . implode(', ', $changes));
            }
        }

        $_SESSION['edited'] = 1;
        header("location: officials.php");
        exit();
    } else {
        $_SESSION['error_update'] = 1;
        header("location: officials.php");
        exit();
    }
}


// Manage residents
if (isset($_POST['edit_resident_status'])) {
    $residentId = $_POST['resident_id'];
    $residentStatus = $_POST['resident_status'];

    $sql = "UPDATE user SET status = :status WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->bindParam(':status', $residentStatus);
        $stmt->bindParam(':user_id', $residentId);
        $stmt->execute();
        return "Resident status updated successfully!";
    } catch (PDOException $e) {
        return "Error updating resident status: " . $e->getMessage();
    }
}

// Manage Blotters
if (isset($_POST['btn_add_blotter'])) {
    $add_reporter_name = $_POST['add_reporter_name'];
    $add_incident_type = $_POST['add_incident_type'];
    $add_description = $_POST['add_description'];

    // Add the blotter
    $query = $pdo->prepare("INSERT INTO blotter (date, time, incident_type, description, reporter_name) VALUES (NOW(), NOW(), ?, ?, ?)");
    $success = $query->execute([$add_incident_type, $add_description, $add_reporter_name]);

    if ($success) {
        // Log the action with the reporter's name
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added a new blotter entry', 'Reported by: ' . $add_reporter_name);
        }

        $_SESSION['added'] = 1;
        header("location: blotter.php");
        exit();
    } else {
        $_SESSION['error_add'] = 1;
        header("location: blotter.php");
        exit();
    }
}
if (isset($_POST['btn_edit_blotter'])) {
    $edit_id = $_POST['hidden_id'];
    $edit_date = $_POST['edit_date'];
    $edit_time = $_POST['edit_time'];
    $edit_incident_type = $_POST['edit_incident_type'];
    $edit_description = $_POST['edit_description'];
    $edit_reporter_name = $_POST['edit_reporter_name'];
    $edit_accused_name = $_POST['edit_accused_name'];
    $edit_status = $_POST['edit_status'];

    // Get current data for comparison
    $query_current = $pdo->prepare("SELECT * FROM blotter WHERE id = ?");
    $query_current->execute([$edit_id]);
    $current_data = $query_current->fetch(PDO::FETCH_ASSOC);

    // Update the blotter entry
    $query = $pdo->prepare("UPDATE blotter SET date = ?, time = ?, incident_type = ?, description = ?, reporter_name = ?, accused_name = ?, status = ? WHERE id = ?");
    $success = $query->execute([$edit_date, $edit_time, $edit_incident_type, $edit_description, $edit_reporter_name, $edit_accused_name, $edit_status, $edit_id]);

    if ($success) {
        // Log the action with details of the changes
        if (isset($_SESSION['role'])) {
            $changes = [];
            if ($current_data['date'] !== $edit_date) {
                $changes[] = sprintf('Date: "%s" to "%s"', $current_data['date'], $edit_date);
            }
            if ($current_data['time'] !== $edit_time) {
                $changes[] = sprintf('Time: "%s" to "%s"', $current_data['time'], $edit_time);
            }
            if ($current_data['incident_type'] !== $edit_incident_type) {
                $changes[] = sprintf('Incident Type: "%s" to "%s"', $current_data['incident_type'], $edit_incident_type);
            }
            if ($current_data['description'] !== $edit_description) {
                $changes[] = sprintf('Description: "%s" to "%s"', $current_data['description'], $edit_description);
            }
            if ($current_data['reporter_name'] !== $edit_reporter_name) {
                $changes[] = sprintf('Reporter: "%s" to "%s"', $current_data['reporter_name'], $edit_reporter_name);
            }
            if ($current_data['accused_name'] !== $edit_accused_name) {
                $changes[] = sprintf('Accused: "%s" to "%s"', $current_data['accused_name'], $edit_accused_name);
            }
            if ($current_data['status'] !== $edit_status) {
                $changes[] = sprintf('Status: "%s" to "%s"', $current_data['status'], $edit_status);
            }

            // Log only if there are changes
            if (!empty($changes)) {
                logAction($pdo, $_SESSION['role'], 'Edited Blotter Entry', 'Edited Blotter Entry ID: ' . $edit_id . '. Changes: ' . implode(', ', $changes));
            }
        }

        $_SESSION['edited'] = 1;
        header("location: blotter.php");
        exit();
    } else {
        $_SESSION['error_update'] = 1;
        header("location: blotter.php");
        exit();
    }
}
if (isset($_POST['btn_delete_blotter'])) {
    $delete_id = $_POST['hidden_id'];

    // Delete the blotter entry
    $query = $pdo->prepare("DELETE FROM blotter WHERE id = ?");
    $success = $query->execute([$delete_id]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Deleted blotter entry ID: ' . $delete_id);
        }

        $_SESSION['deleted'] = 1;
        header("location: blotter.php");
        exit();
    } else {
        $_SESSION['error_delete'] = 1;
        header("location: blotter.php");
        exit();
    }
}


// Manage Voters
// Manage Voters
if (isset($_POST['btn_add_voter'])) {
    $voter_name = $_POST['voter_name'];
    $voter_contact = $_POST['voter_contact'];
    $voter_address = $_POST['voter_address'];

    // Insert the voter entry
    $query = $pdo->prepare("INSERT INTO voters (name, contact_number, address) VALUES (?, ?, ?)");
    $success = $query->execute([$voter_name, $voter_contact, $voter_address]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added voter named ' . $voter_name);
        }

        $_SESSION['added'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_add'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}
if (isset($_POST['btn_edit_voter'])) {
    $voter_id = $_POST['hidden_id'];
    $edit_voter_name = $_POST['edit_voter_name'];
    $edit_voter_contact = $_POST['edit_voter_contact'];
    $edit_voter_address = $_POST['edit_voter_address'];

    // Get current data for comparison
    $query_current = $pdo->prepare("SELECT * FROM voters WHERE id = ?");
    $query_current->execute([$voter_id]);
    $current_data = $query_current->fetch(PDO::FETCH_ASSOC);

    // Update the voter
    $query = $pdo->prepare("UPDATE voters SET name = ?, contact_number = ?, address = ? WHERE id = ?");
    $success = $query->execute([$edit_voter_name, $edit_voter_contact, $edit_voter_address, $voter_id]);

    if ($success) {
        // Log the action with details of the changes
        if (isset($_SESSION['role'])) {
            $changes = [];
            if ($current_data['name'] !== $edit_voter_name) {
                $changes[] = sprintf('Name: "%s" to "%s"', $current_data['name'], $edit_voter_name);
            }
            if ($current_data['contact_number'] !== $edit_voter_contact) {
                $changes[] = sprintf('Contact: "%s" to "%s"', $current_data['contact_number'], $edit_voter_contact);
            }
            if ($current_data['address'] !== $edit_voter_address) {
                $changes[] = sprintf('Address: "%s" to "%s"', $current_data['address'], $edit_voter_address);
            }

            // Log only if there are changes
            if (!empty($changes)) {
                logAction($pdo, $_SESSION['role'], 'Updated Voter', 'Edited Voter ID: ' . $voter_id . '. Changes: ' . implode(', ', $changes));
            }
        }

        $_SESSION['edited'] = 1;
        header("location: voters.php");
        exit();
    } else {
        $_SESSION['error_update'] = 1;
        header("location: voters.php");
        exit();
    }
}
if (isset($_POST['btn_delete_voter'])) {
    $voter_id = $_POST['hidden_id'];

    // Delete the voter entry
    $query = $pdo->prepare("DELETE FROM voters WHERE id = ?");
    $success = $query->execute([$voter_id]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Deleted voter ID: ' . $voter_name);
        }

        $_SESSION['deleted'] = 1;
        header("location: voters.php");
        exit();
    } else {
        $_SESSION['error_delete'] = 1;
        header("location: voters.php");
        exit();
    }
}


// Manage Indigents
if (isset($_POST['btn_add_indigent'])) {
    $indigent_name = $_POST['indigent_name'];
    $indigent_address = $_POST['indigent_address'];

    // Add the indigent
    $query = $pdo->prepare("INSERT INTO indigents (name, address) VALUES (?, ?)");
    $success = $query->execute([$indigent_name, $indigent_address]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added Indigent', 'Indigent Name: ' . $indigent_name);
        }

        $_SESSION['added'] = 1;
        header("location: indigents.php");
        exit();
    } else {
        $_SESSION['error_add'] = 1;
        header("location: indigents.php");
        exit();
    }
}
if (isset($_POST['btn_edit_indigent'])) {
    $indigent_id = $_POST['hidden_id'];
    $edit_indigent_name = $_POST['edit_indigent_name'];
    $edit_indigent_address = $_POST['edit_indigent_address'];

    // Get current data for comparison
    $query_current = $pdo->prepare("SELECT * FROM indigents WHERE id = ?");
    $query_current->execute([$indigent_id]);
    $current_data = $query_current->fetch(PDO::FETCH_ASSOC);

    // Update the indigent
    $query = $pdo->prepare("UPDATE indigents SET name = ?, address = ? WHERE id = ?");
    $success = $query->execute([$edit_indigent_name, $edit_indigent_address, $indigent_id]);

    if ($success) {
        // Log the action with details of the changes
        if (isset($_SESSION['role'])) {
            $changes = [];
            if ($current_data['name'] !== $edit_indigent_name) {
                $changes[] = sprintf('Name: "%s" to "%s"', $current_data['name'], $edit_indigent_name);
            }
            if ($current_data['address'] !== $edit_indigent_address) {
                $changes[] = sprintf('Address: "%s" to "%s"', $current_data['address'], $edit_indigent_address);
            }

            // Log only if there are changes
            if (!empty($changes)) {
                logAction($pdo, $_SESSION['role'], 'Updated Indigent', 'Edited Indigent ID: ' . $indigent_id . '. Changes: ' . implode(', ', $changes));
            }
        }

        $_SESSION['edited'] = 1;
        header("location: indigents.php");
        exit();
    } else {
        $_SESSION['error_update'] = 1;
        header("location: indigents.php");
        exit();
    }
}
if (isset($_POST['btn_delete_indigent'])) {
    $indigent_id = $_POST['id']; // Adjusted to match the hidden input in the modal

    // Delete the indigent entry
    $query = $pdo->prepare("DELETE FROM indigents WHERE id = ?");
    $success = $query->execute([$indigent_id]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Deleted indigent ID: ' . $indigent_name);
        }

        $_SESSION['deleted'] = 1;
        header("location: indigents.php");
        exit();
    } else {
        $_SESSION['error_delete'] = 1;
        header("location: indigents.php");
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_delete'])) {
    // Get the IDs from the hidden input field
    $delete_ids = $_POST['delete_ids'];
    $ids = explode(',', $delete_ids); // Convert string of IDs into an array

    // Prepare the SQL statement
    $sql = "DELETE FROM documents WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")";

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        // Redirect or notify user
        $_SESSION['success_message'] = "Documents deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to delete documents. Please try again.";
    }
    header("Location: documents.php"); // Change this to your actual page
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_edit_document'])) {
    $hidden_id = $_POST['hidden_id'];
    $name = $_POST['txt_edit_cname'];
    $address = $_POST['txt_edit_address'];
    $age = $_POST['txt_edit_age'];
    $pickup_date = $_POST['txt_edit_pickup_date'];
    $pickup_time = $_POST['txt_edit_pickup_time'];
    $year_residency = $_POST['txt_edit_year_residency'];
    $type_document = $_POST['txt_edit_type_document'];
    $purpose = $_POST['txt_edit_purpose'];
    $document_status = $_POST['document_status'];

    // Update query
    $sql = "UPDATE documents SET 
                full_name = :full_name,
                address = :address,
                age = :age,
                pickup_date = :pickup_date,
                pickup_time = :pickup_time,
                year_residency = :year_residency,
                purpose = :purpose,
                status = :status 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':full_name' => $name,
        ':address' => $address,
        ':age' => $age,
        ':pickup_date' => $pickup_date,
        ':pickup_time' => $pickup_time,
        ':year_residency' => $year_residency,
        ':purpose' => $purpose,
        ':status' => $document_status,
        ':id' => $hidden_id,
    ]);

    // Redirect or notify user
    $_SESSION['success_message'] = "Document updated successfully!";
    header("Location: documents.php"); // Change this to your actual page
    exit;
}
