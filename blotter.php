<?php
session_start();
require "db.php";

if (isset($_SESSION["user_id"])) {
    // If the user is logged in, retrieve user information
    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = :id");
    $stmt->execute([':id' => $_SESSION["user_id"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $full_name = $user['full_name'];
}

// Access the 'user_id' session variable only if it is set
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


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

    <section style="margin: 20px 10%;">
        <section class="content">
            <!-- left column -->
            <div class="box">
                <div class="box-header">
                    <div style="padding:10px;">
                        <h3>Blotter</h3>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <form method="post">
                        <!-- Table for displaying blotter entries -->
                        <table id="blotterTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Incident Type</th>
                                    <th>Description</th>
                                    <th>Reporter</th>
                                    <th>Accused</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch blotter entries where the full name matches either reporter or accused
                                $squery = $pdo->prepare("SELECT * FROM blotter WHERE reporter_name = :full_name OR accused_name = :full_name ORDER BY created_at DESC");
                                $squery->execute(['full_name' => $full_name]);

                                if ($squery->rowCount() > 0) {
                                    // If results are found, display them
                                    while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                        <tr>
                                            <td>' . $row['id'] . '</td>
                                            <td>' . $row['date'] . '</td>
                                            <td>' . $row['time'] . '</td>
                                            <td>' . $row['incident_type'] . '</td>
                                            <td>' . $row['description'] . '</td>
                                            <td>' . $row['reporter_name'] . '</td>
                                            <td>' . $row['accused_name'] . '</td>
                                            <td>' . $row['status'] . '</td>
                                            <td>' . $row['created_at'] . '</td>  
                                        </tr>
                                    ';
                                    }
                                } else {
                                    // If no results, display "No result."
                                    echo '<tr><td colspan="9" style="text-align:center;">No result.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div><!-- /.box -->
        </section>
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
</body>

</html>