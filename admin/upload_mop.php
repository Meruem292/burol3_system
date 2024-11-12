<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mop_name = $_POST['mop_name'];
    $mop_image = $_FILES['mop_image'];

    // Check if the file is an image
    $check = getimagesize($mop_image["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit();
    }

    // Define the target directory and file name
    $target_dir = "uploaded_img/mops/";
    $image_name = basename($mop_image["name"]);
    $target_file = $target_dir . $image_name;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($mop_image["tmp_name"], $target_file)) {
        // Insert the new MOP into the database
        $stmt = $pdo->prepare("INSERT INTO payment_methods (method_name, image_path) VALUES (?, ?)");
        if ($stmt->execute([$mop_name, $image_name])) {
            echo "MOP picture uploaded successfully!";
        } else {
            echo "Error saving to the database.";
        }
    } else {
        echo "Error uploading the MOP picture.";
    }
}
?>
