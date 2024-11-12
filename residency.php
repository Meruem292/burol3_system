<?php
session_start();
require "db.php";

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

if (isset($_SESSION["user_id"])) {
    // If the user is logged in, retrieve user information
    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = :id");
    $stmt->execute([':id' => $_SESSION["user_id"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
    header("Location: login.php");
}   

// Access the 'user_id' session variable only if it is set
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (isset($_POST['add_certificate_residency'])) {
    $complete_name = trim($_POST['complete_name']);
    $age = trim($_POST['age']);
    $purpose = trim($_POST['purpose']);
    $address = trim($_POST['address']);
    $year_residency = trim($_POST['year_residency']);
    $category = "on request";
    $notes = trim($_POST['notes']);
    $type = "Certificate of Residency";
    $tracking_number = $_POST['tracking_number'];
    $control_number = generateControlNumber();
    $delivery_mode = $_POST['delivery_mode'];

    try {
        // Insert into documents table
        if ($delivery_mode == 'pick-up') {
            $pickup_date = $_POST['pickup_date'];
            $pickup_time = $_POST['pickup_time'];
            $amount_to_prepare = $_POST['amount_to_prepare'];

            $insertQuery = $pdo->prepare("INSERT INTO `documents` 
                (`tracking_number`, `full_name`, `address`, `age`, `pickup_date`, `pickup_time`, `amount_to_prepare`, `year_residency`, `purpose`, `category`, `note`, `type`, `control_number`, `delivery_mode`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insertQuery->execute([$tracking_number, $complete_name, $address, $age, $pickup_date, $pickup_time, $amount_to_prepare, $year_residency, $purpose, $category, $notes, $type, $control_number, $delivery_mode]);
            $document_id = $pdo->lastInsertId(); // Get the last inserted ID

        } else if ($delivery_mode == 'delivery') {
            $insertQuery = $pdo->prepare("INSERT INTO `documents` 
                (`tracking_number`, `full_name`, `address`, `age`, `year_residency`, `purpose`, `category`, `note`, `type`, `control_number`, `delivery_mode`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insertQuery->execute([$tracking_number, $complete_name, $address, $age, $year_residency, $purpose, $category, $notes, $type, $control_number, $delivery_mode]);
            $document_id = $pdo->lastInsertId(); // Get the last inserted ID
        }

        // Handle receipt upload for both pick-up and delivery
        if ($delivery_mode == 'delivery' && $_FILES['payment_receipt']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'admin/uploaded_img/receipts/';
            $fileName = basename($_FILES['payment_receipt']['name']);
            $uploadFile = $uploadDir . time() . '_' . $fileName;

            $dbreceipt_path = "uploaded_img/receipts/" . time() . '_' . $fileName;

            if (move_uploaded_file($_FILES['payment_receipt']['tmp_name'], $uploadFile)) {
                // Insert receipt record
                $stmt = $pdo->prepare("INSERT INTO payment_receipts (document_id, payment_receipt_path) VALUES (?, ?)");
                $stmt->execute([$document_id, $dbreceipt_path]);
            } else {
                throw new Exception("File upload failed!");
            }
        }

        // If it's a pick-up, we don't need to handle receipt upload here as per your original logic
        if ($delivery_mode == 'pick-up') {
            $_SESSION['message'] = "Requested Successfully! Tracking Number: " . $tracking_number;
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['message'] = "Requested Successfully! Please upload your payment receipt.";
            $_SESSION['status'] = "success";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "An error occurred: " . $e->getMessage();
        $_SESSION['status'] = "error";
    }
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <title>Brgy. Burol III</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="assets/img/bground.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/sweetalert.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/bground.png" alt="">
                <span>Brgy. Burol III </span>


            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#swiper">Announcement</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#team">Brgy. Official</a></li>

                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="nav-link scrollto" href="track_request.php">Track Request</a></li>
                    <?php
                    if (!isset($user_id)) {
                        echo '<li><a class="getstarted scrollto" href="login.php">Login</a></li>';
                    } else {
                        echo '<li><a class="getstarted scrollto" href="logout.php">Logout</a></li>';
                    }
                    ?>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <section style="margin-top: 50px;">
        <div class="container">
            <form method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-4 mb-5">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="assets/img/sk.png" width="150" alt="">
                                <h3 class="h3 fw-bold">Certificate of Residency</h3>
                                <hr>
                                <?php 
                                 $stmt = $pdo->prepare("SELECT price FROM prices WHERE doc_type = 'certificate of residency'");
                                 $stmt->execute();
                                 $prices = $stmt->fetch(PDO::FETCH_ASSOC);
                                 $stmt1 = $pdo->prepare("SELECT price FROM prices WHERE doc_type = 'delivery' ");
                                 $stmt1->execute();
                                 $delivery = $stmt1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <p><b>Fee: </b><?php echo $prices['price'] .".00"?></p>
                                <p><b class="text-danger">Note: </b>Please copy the tracking number after you successfully process your Certificate of Residency.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3 class="fw-bold">Certificate of Residency Form</h3>
                        <div class="row mt-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tracking Number: &nbsp;<i class="bi bi-copy" id="copyIcon" style="cursor: pointer;"></i></label>
                                <input type="text" readonly name="tracking_number" id="trackingNumber" value="<?= generateTrackingNumber(); ?>" required class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Complete Name: <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter your complete name" name="complete_name" value="<?= !isset($user['full_name']) ? "" : $user['full_name'] ?>" required class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Purpose: <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter your purpose" name="purpose" required class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Complete Address: (Block, Lot, Street) <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter your complete address" name="address" value="<?= !isset($user['address']) ? "" : $user['address'] ?>" required class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Age: <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter your age" name="age" value="<?= !isset($user['age']) ? "" : $user['age'] ?>" required class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Year of Residency: <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter your year of residency" name="year_residency" required class="form-control">
                            </div>
                            <div class="col-auto">
                                <label class="form-label">Mode of Delivery: <span class="text-danger">*</span></label>
                                <select class="form-select" name="delivery_mode" id="deliveryMode" required onchange="toggleFields()">
                                    <option value="pick-up">Pick-up</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                            </div>

                            <div class="row" id="pickupFields" style="display:none;">
                                <div class="col-auto">
                                    <label class="form-label">Pick-up Date: <span class="text-danger">*</span></label>
                                    <input type="date" name="pickup_date" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <label class="form-label">Pick-up Time: <span class="text-danger">*</span></label>
                                    <input type="time" name="pickup_time" class="form-control">
                                </div>
                                <div class="col-auto" id="amountToPrepareField" style="display:none;">
                                    <label class="form-label mt-2">Amount to Prepare on Pick-up: <strong><?php echo $prices['price']?>.00 Php</strong><span class="text-danger">*</span></label>
                                    <input type="hidden" name="amount_to_prepare" value="<?php echo $prices['price']?>" class="text">
                                </div>  
                            </div>
                            <div id="deliveryFields" class="row" style="display:none;">
                                <div class="col-md-6 mb-3" id="gcashPaymentMethodField" style="display:none;">
                                    <label class="form-label mt-2">GCASH Payment Method: <span class="text-danger">*</span></label>
                                    <?php $gcashMOP = getGcashMOP(); ?>
                                    <img src="admin/uploaded_img/mops/<?php echo $gcashMOP['image_path']; ?>" alt="GCASH MOP" style="max-width:60%" class="img-fluid">
                                    <p class="mt-2">Please send payment to the GCASH number displayed above.</p>
                                    <p class="mt-2"><?php echo $prices['price'].".00 Php (Certificate of Residency)<br>". + $delivery['price'] .'.00 Php (Delivery Fee)'?></p>
                                    <p><strong>Total: <?php echo ($prices['price'] + $delivery['price']) .".00"?></strong></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="paymentReceipt" class="form-label">Upload Payment Receipt: <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="payment_receipt" id="paymentReceipt" accept="image/*" >
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Note/Comments: (optional)</label>
                                <input type="text" name="notes" placeholder="Enter your note or comments" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" name="add_certificate_residency">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.php" class="logo d-flex align-items-center">


                        </a>
                        <p>For the health and safety of everyone in our community. Let's continue to support each other during these challenging times.
                            Together, we can make Barangay Burol 3 an even better place to live. Stay connected and stay positive!</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="https://www.facebook.com/profile.php?id=61554183993470&sk=about" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Our Products</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Barangay Volunteering</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Generate a report</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Sport and Event</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>
                            Brgy. Burol III <br>
                            Dasmariñas City of Cavite<br>
                            Philippines, 4114 <br><br>
                            <strong>Phone:</strong> 09**********<br>
                            <strong>Email:</strong> brgy.burol3@gmail.com<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Kolehiyo <strong><span>ng Lungsod ng Dasmariñas</span></strong>. IS Student a Capstone Project
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->

            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert.js"></script>

    <script>
        function toggleFields() {
            const deliveryMode = document.getElementById('deliveryMode').value;
            const pickupFields = document.getElementById('pickupFields');
            const deliveryFields = document.getElementById('deliveryFields');
            const amountToPrepareField = document.getElementById('amountToPrepareField');
            const gcashPaymentMethodField = document.getElementById('gcashPaymentMethodField');

            if (deliveryMode === 'pick-up') {
                pickupFields.style.display = 'block';
                amountToPrepareField.style.display = 'block';
                deliveryFields.style.display = 'none';
                gcashPaymentMethodField.style.display = 'none';
            } else if (deliveryMode === 'delivery') {
                pickupFields.style.display = 'none';
                amountToPrepareField.style.display = 'none';
                deliveryFields.style.display = 'block';
                gcashPaymentMethodField.style.display = 'block';
            } else {
                // Hide all fields if no mode is selected
                pickupFields.style.display = 'none';
                amountToPrepareField.style.display = 'none';
                deliveryFields.style.display = 'none';
                gcashPaymentMethodField.style.display = 'none';
            }
        }

        // Call the function once on page load to ensure the fields are hidden initially
        toggleFields();
    </script>

    <script>
        // Function to copy tracking number to clipboard
        function copyTrackingNumber() {
            var copyText = document.getElementById("trackingNumber");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            alert("Tracking number copied to clipboard: " + copyText.value);
        }

        // Add click event listener to copy icon
        document.getElementById("copyIcon").addEventListener("click", copyTrackingNumber);
    </script>

    <?php
    if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
        // Replace newline characters with <br> tags
        $message = nl2br($_SESSION['message']);
    ?>
        <script>
            Swal.fire({
                html: "<?php echo $message; ?>",
                icon: "<?php echo $_SESSION['status']; ?>",
            });
        </script>
    <?php
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    }
    ?>

</body>

</html>