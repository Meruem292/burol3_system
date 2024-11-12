<?php
// functions.php

function logAction($pdo, $user, $action)
{
    // Prepare the SQL query
    $query = $pdo->prepare("INSERT INTO logs (user, date_log, action) VALUES (?, NOW(), ?)");
    // Execute the query
    $query->execute([$user, $action]);
}

// Manage Officials
if (isset($_POST['btn_add_official'])) {
    $ddl_pos = $_POST['ddl_pos'];
    $txt_cname = $_POST['txt_cname'];
    $txt_contact = $_POST['txt_contact'];
    $txt_address = $_POST['txt_address'];
    $txt_sterm = $_POST['txt_sterm'];
    $txt_eterm = $_POST['txt_eterm'];

    $fileName = $_FILES["txt_image"]["name"];
    $target_dir = "uploaded_img/";
    $target_file = $target_dir . basename($fileName);

    // Check if the name and position already exist
    $query_check = $pdo->prepare("SELECT * FROM officials WHERE full_name = ? AND position = ?");
    $query_check->execute([$txt_cname, $ddl_pos]);
    $existing_official = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($existing_official) {
        $_SESSION['existing_official'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit(); // Stop further execution
    }

    // Insert into officials
    $query = $pdo->prepare("INSERT INTO officials (full_name, image, position, contact_number, address, start_term, end_term) 
                             VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bindParam(1, $txt_cname);
    $query->bindParam(2, $fileName);
    $query->bindParam(3, $ddl_pos);
    $query->bindParam(4, $txt_contact);
    $query->bindParam(5, $txt_address);
    $query->bindParam(6, $txt_sterm);
    $query->bindParam(7, $txt_eterm);

    move_uploaded_file($_FILES["txt_image"]["tmp_name"], $target_file);

    // Execute the query
    if ($query->execute()) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added Official named ' . $txt_cname);
        }

        $_SESSION['added'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    } else {
        $_SESSION['existing_official'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
};

if (isset($_POST['btn_edit_official'])) {
    $txt_id = $_POST['hidden_id'];
    $txt_edit_cname = $_POST['txt_edit_cname'];
    $txt_edit_contact = $_POST['txt_edit_contact'];
    $txt_edit_address = $_POST['txt_edit_address'];
    $txt_edit_sterm = $_POST['txt_edit_sterm'];
    $txt_edit_eterm = $_POST['txt_edit_eterm'];

    // Update the official
    $query = $pdo->prepare("UPDATE officials SET full_name = ?, contact_number = ?, address = ?, start_term = ?, end_term = ? WHERE id = ?");
    $success = $query->execute([$txt_edit_cname, $txt_edit_contact, $txt_edit_address, $txt_edit_sterm, $txt_edit_eterm, $txt_id]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Updated Official named ' . $txt_edit_cname);
        }

        $_SESSION['edited'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_update'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
};

// Manage Blotters
if (isset($_POST['btn_add_blotter'])) {
    $add_date = $_POST['add_date'];
    $add_time = $_POST['add_time'];
    $add_incident_type = $_POST['add_incident_type'];
    $add_description = $_POST['add_description'];
    $add_reporter_name = $_POST['add_reporter_name'];
    $add_accused_name = $_POST['add_accused_name'];
    $add_status = $_POST['add_status'];

    // Insert the blotter entry
    $query = $pdo->prepare("INSERT INTO blotter (date, time, incident_type, description, reporter_name, accused_name, status, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $success = $query->execute([$add_date, $add_time, $add_incident_type, $add_description, $add_reporter_name, $add_accused_name, $add_status]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added a new blotter entry by ' . $add_reporter_name);
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

if (isset($_POST['btn_edit_blotter'])) {
    $edit_id = $_POST['hidden_id'];
    $edit_date = $_POST['edit_date'];
    $edit_time = $_POST['edit_time'];
    $edit_incident_type = $_POST['edit_incident_type'];
    $edit_description = $_POST['edit_description'];
    $edit_reporter_name = $_POST['edit_reporter_name'];
    $edit_accused_name = $_POST['edit_accused_name'];
    $edit_status = $_POST['edit_status'];

    // Update the blotter entry
    $query = $pdo->prepare("UPDATE blotter SET date = ?, time = ?, incident_type = ?, description = ?, reporter_name = ?, accused_name = ?, status = ? 
                            WHERE id = ?");
    $success = $query->execute([$edit_date, $edit_time, $edit_incident_type, $edit_description, $edit_reporter_name, $edit_accused_name, $edit_status, $edit_id]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Edited blotter entry ID: ' . $edit_id);
        }

        $_SESSION['edited'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_update'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
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
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Manage Voters
// Handle adding a new voter
if (isset($_POST['btn_add_voter'])) {
    // Retrieve form data
    $voter_name = $_POST['voter_name'];
    $voter_age = $_POST['voter_age'];
    $voter_contact = $_POST['voter_contact'];
    $voter_address = $_POST['voter_address'];

    // Insert the voter entry into the 'voters' table
    $query = $pdo->prepare("INSERT INTO `voters`(`id`, `full_name`, `age`, `address`, `contact_number`, `created_at`) VALUES (NULL, ?, ?, ?, ?, NOW())");
    $success = $query->execute([$voter_name, $voter_contact, $voter_address, $voter_age]);

    // Check if the insertion was successful
    if ($success) {
        // Log the action if a user role is set
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added voter named ' . $voter_name);
        }

        // Set a session variable to indicate success and redirect
        $_SESSION['added'] = 1;
    } else {
        // Set a session variable to indicate an error and redirect
        $_SESSION['error_add'] = 1;
    }

    // Redirect back to the same page to refresh the content
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
}


if (isset($_POST['btn_edit_voter'])) {
    include('db.php');
    $voter_id = $_POST['hidden_id'];
    $voter_name = $_POST['edit_voter_name'];
    $voter_contact = $_POST['edit_voter_contact'];
    $voter_address = $_POST['edit_voter_address'];
    $voter_age = $_POST['edit_voter_age'];

    // Update the voter entry
    $query = $pdo->prepare("UPDATE voters SET full_name = ?, contact_number = ?, address = ?, age = ? WHERE id = ?");

    $success = $query->execute([$voter_name, $voter_contact, $voter_address, $voter_age, $voter_id]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Edited voter ID: ' . $voter_name);
        }

        $_SESSION['edited'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_update'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
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
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

if (isset($_POST['btn_add_indigent'])) {
    // Get form data
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];

    // Prepare the SQL statement
    $query = $pdo->prepare("INSERT INTO indigents (full_name, age, address, contact_number) VALUES (?, ?, ?, ?)");
    $success = $query->execute([$full_name, $age, $address, $contact_number]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Added indigent: ' . $full_name);
        }

        // Set a session variable to indicate success
        $_SESSION['added'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']); // Redirect to the same page
        exit();
    } else {
        // Set a session variable to indicate an error
        $_SESSION['error_add'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']); // Redirect to the same page
        exit();
    }
}

if (isset($_POST['btn_edit_indigent'])) {
    $indigent_id = $_POST['hidden_id'];
    $indigent_name = $_POST['edit_indigent_name'];
    $indigent_age = $_POST['edit_indigent_age'];
    $indigent_address = $_POST['edit_indigent_address'];
    $indigent_contact = $_POST['edit_indigent_contact'];

    // Prepare the SQL update statement
    $query = $pdo->prepare("UPDATE indigents SET full_name = ?, age = ?, address = ?, contact_number = ? WHERE id = ?");
    $success = $query->execute([$indigent_name, $indigent_age, $indigent_address, $indigent_contact, $indigent_id]);

    if ($success) {
        // Log the action if needed
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Edited indigent ID: ' . $indigent_name);
        }

        $_SESSION['edited'] = 1; // Success flag
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_update'] = 1; // Error flag
        header("Location: " . $_SERVER['REQUEST_URI']);
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
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
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

// MANAGE POST/ANNOUNCEMENTS 

if (isset($_POST['btn_edit_announcement'])) {
    include('db.php');
    $announcement_id = $_POST['hidden_id'];
    $announcement_title = $_POST['edit_announcement_title'];
    $announcement_body = $_POST['edit_announcement_body'];
    $announcement_picture = $_POST['edit_announcement_picture'];

    // Prepare the SQL update statement
    $query = $pdo->prepare("UPDATE announcements SET title = ?, body = ?, picture = ? WHERE id = ?");
    $success = $query->execute([$announcement_title, $announcement_body, $announcement_picture, $announcement_id]);

    if ($success) {
        // Log the action if needed
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Edited announcement ID: ' . $announcement_title);
        }

        $_SESSION['edited'] = 1; // Success flag
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_update'] = 1; // Error flag
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

if (isset($_POST['btn_delete_announcement'])) {
    include('db.php');
    $announcement_id = $_POST['id'];

    // Delete the announcement entry
    $query = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
    $success = $query->execute([$announcement_id]);

    if ($success) {
        // Log the action
        if (isset($_SESSION['role'])) {
            logAction($pdo, $_SESSION['role'], 'Deleted announcement ID: ' . $announcement_id);
        }

        $_SESSION['deleted'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $_SESSION['error_delete'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

//  MANAGE RESIDENTS / USERS

if (isset($_POST['btn_edit_resident'])) {
    include('db.php');
    
    // Get the data from POST, applying sanitization
    $user_id = filter_var($_POST['resident_id'], FILTER_SANITIZE_NUMBER_INT);
    $full_name = filter_var($_POST['edit_full_name']);
    $email = filter_var($_POST['edit_email'], FILTER_SANITIZE_EMAIL);
    $mobile_number = filter_var($_POST['edit_mobile_number']);
    $date_of_birth = $_POST['edit_date_of_birth'];
    $gender = filter_var($_POST['edit_gender']);
    $status = filter_var($_POST['edit_status']);

    // Update statement with parameterized query for security
    $stmt = $pdo->prepare("UPDATE user SET full_name = :full_name, email = :email, mobile_number = :mobile_number, 
                            date_of_birth = :date_of_birth, gender = :gender, status = :status WHERE user_id = :user_id");
    $stmt->execute([
        ':full_name' => $full_name,
        ':email' => $email,
        ':mobile_number' => $mobile_number,
        ':date_of_birth' => $date_of_birth,
        ':gender' => $gender,
        ':status' => $status,
        ':user_id' => $user_id
    ]);

    // Redirect to avoid form resubmission on refresh
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
