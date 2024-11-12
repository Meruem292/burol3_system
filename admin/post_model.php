<?php
session_start(); // Start the session

require_once 'db.php'; // Include the existing database connection

global $pdo; // Use the $pdo object from db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $pictureFile = $_FILES['picture'];

    // File upload logics
    $targetDir = "../assets/post_img/";

    // Get the current date and time to rename the file
    $currentDate = date('Ymd_His'); // e.g., 20241024_153045

    // Extract the file extension from the original image name
    $imageFileType = strtolower(pathinfo($pictureFile["name"], PATHINFO_EXTENSION));

    // Construct the new file name with date and time
    $newFileName = $currentDate . "." . $imageFileType; // e.g., 20241024_153045.jpg

    $targetFilePath = $targetDir . $newFileName;
    $uploadOk = 1;

    // Check if image file is a real image or fake image
    $check = getimagesize($pictureFile["tmp_name"]);
    if ($check === false) {
        $_SESSION['message'] = "File is not a valid image.";
        $_SESSION['status'] = "error";
        $uploadOk = 0;
        header('Location: activity.php');
        exit();
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['message'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $_SESSION['status'] = "error";
        $uploadOk = 0;
        header('Location: activity.php');
        exit();
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        // Ensure the directory exists, if not create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($pictureFile["tmp_name"], $targetFilePath)) {
            // Insert the announcement into the database
            $sql = "INSERT INTO announcements (title, body, picture) VALUES (:title, :body, :picture)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':body', $body);
            $stmt->bindParam(':picture', $newFileName);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Announcement posted successfully!";
                $_SESSION['status'] = "success";
            } else {
                $_SESSION['message'] = "Error posting announcement.";
                $_SESSION['status'] = "error";
            }
        } else {
            $_SESSION['message'] = "Sorry, there was an error uploading your file.";
            $_SESSION['status'] = "error";
        }
    }

    header('Location: activity.php'); // Redirect back to the main page
    exit();
}
?>
