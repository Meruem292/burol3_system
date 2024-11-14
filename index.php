<?php
session_start();
require "db.php";

if (isset($_SESSION["id"])) {
  // If the user is logged in, retrieve user information
  $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
  $stmt->execute([':id' => $_SESSION["id"]]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Access the 'id' session variable only if it is set
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    .container .info-box {
      color: #444444;
      background: #fafbff;
      padding: 30px;

    }

    .container .info-box i {
      font-size: 38px;
      line-height: 0;
      color: red;


    }

    .container .info-box h3 {
      font-size: 20px;
      color: #012970;
      font-weight: 700;
      margin: 20px 0 10px 0;
    }

    .container .info-box p {
      padding: 0;
      line-height: 24px;
      font-size: 14px;
      margin-bottom: 0;
    }


    @keyframes animate-loading {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Custom styles for hover effect */
    .login-dropdown {
      position: relative;
      display: inline-block;
    }

    .login-dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .login-dropdown:hover .login-dropdown-content {
      display: block;
    }

    .login-dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .login-dropdown-content a:hover {
      background-color: #f1f1f1;
    }
  </style>
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
          <li><a class="nav-link scrollto" href="#" data-bs-toggle="modal" data-bs-target="#trackRequestModal">Track Request</a></li>

          <?php
          if (!isset($id)) {
            echo '
            <li>
                <div class="login-dropdown">
                    <a class="getstarted scrollto" href="#">Login</a>
                    <div class="login-dropdown-content">
                        <a href="login.php">Login as Resident</a>
                        <a href="admin/login.php">Login as Admin</a>
                    </div>
                </div>
            </li>
            ';
          } else {
            echo '<li><a class="getstarted scrollto" href="logout.php">Logout</a></li>';
          }
          ?>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- MODAL TRACK REQUEST -->

  <!-- Modal -->
  <div class="modal fade" id="trackRequestModal" tabindex="-1" aria-labelledby="trackRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="trackRequestModalLabel">Track Your Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if ($id == null) { ?>
            <form id="trackRequestForm">
              <div class="mb-3">
                <label for="trackingNumber" class="form-label">Tracking Number</label>
                <input type="text" class="form-control" id="trackingNumber" placeholder="Enter your tracking number">
              </div>
              <button type="submit" class="btn btn-primary">Check Status</button>
            </form>
          <?php } ?>
          <!-- Datatable to display request details -->
          <!-- Datatable to display request details (initially hidden) -->
          <div class="mt-3 d-none" id="trackingTableContainer">
            <table id="trackingTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Tracking #</th>
                  <th>Delivery Address</th>
                  <th>Type</th>
                  <th>Delivery_mode</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="trackingTableBody">
                <!-- Data will be dynamically inserted here -->
              </tbody>
            </table> 
          </div>

        </div>
      </div>
    </div>
  </div>



  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Welcome to Brgy. Burol III, Dasmariñas City of Cavite</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">"Kaagapay sa Pag-unlad, Serbisyo para sa Bawat Mamamayan, Tapat at Maaasahan"</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>

          </div>
          <div class="info-box mt-5">
            <i class="bi bi-telephone"></i>
            <h3>Emergency? Contact Us!</h3>
            <p> +63 951 290 2433</p>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/b3b.jpg" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section>

  <!-- End Hero -->
  <!-- Announcement start-->
  <header class="section-header">
    <p id="swiper">Recent Announcement</p><br>
    <h2>Check out the latest news, event and Announcement here.</h2>
  </header>

  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php
      // Modify the query to fetch only the latest 10 announcements
      $stmt = $pdo->prepare("SELECT picture FROM announcements ORDER BY id DESC LIMIT 10");
      $stmt->execute();
      $announcements = $stmt->fetchAll();

      // Loop through the announcements and display them
      foreach ($announcements as $announcement) { ?>
        <div class="swiper-slide">
          <img src="assets/post_img/<?php echo $announcement['picture']; ?>" />
        </div>
      <?php } ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <!-- Announcement end-->



  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3></h3>
              <h2>About Us</h2>
              <p>

                Sa Barangay, tayo ay nagtataguyod ng isang komunidad na may pagkakaunawaan, pagkakaisa, at pagmamalasakit sa isa't isa. Ang aming layunin ay mapalakas ang ugnayan
                sa pagitan ng mga residente, pagtibayin ang kapayapaan, at itaguyod ang kaunlaran. Sa bawat hakbang, sama-sama nating binibigyang-pansin ang mga pangangailangan ng bawat
                mamamayan at nagbibigay-daan sa boses ng bawat sektor na maririnig at mapansin. Ang Barangay ay tahanan ng pagkakaibigan, serbisyo, at pag-asa para sa lahat.
              </p>
              <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/pic.jpg" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <p>Barangay Issuance</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue">
              <i class="ri-discuss-line icon"></i>
              <h3>Barangay Clearance</h3>
              <p></p>
              <a href="<?= isset($id) ? 'brgy_clearance.php' : 'login.php' ?>" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-up" data-aos-delay="300">
            <div class="service-box orange">
              <i class="ri-discuss-line icon"></i>
              <h3>Certificate of Indigency</h3>
              <p></p>
              <a href="<?= isset($id) ? 'indigency.php' : 'login.php' ?>" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box green">
              <i class="ri-discuss-line icon"></i>
              <h3>Certificate of Residency</h3>
              <p></p>
              <a href="<?= isset($id) ? 'residency.php' : 'login.php' ?>" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <!-- blotter start -->
          <div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box purple">
              <i class="ri-discuss-line icon"></i>
              <h3>Blotter</h3>
              <p></p>
              <a href="<?= isset($id) ? 'blotter.php' : 'login.php' ?>" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <!-- blotter end -->

        </div>

      </div>

    </section><!-- End Services Section -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team">

      <div class="container" data-aos="fade-up">

        <header class="section-header">

          <p>Our Barangay Official</p>
        </header>

        <div class="row gy-4">

          <?php

          $officialSelect = $pdo->query("SELECT * FROM officials");
          foreach ($officialSelect as $row) {
          ?>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                <div class="member-img">
                  <img src="admin/uploaded_img/<?= $row['image'] ?>" class="img-fluid" style="object-fit: cover;" alt="">
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
                <div class="member-info">
                  <h4><?= $row['full_name'] ?></h4>
                  <span><?= $row['position'] ?></span>

                </div>
              </div>
            </div>
          <?php
          }

          ?>
        </div>

      </div>

    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->

    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">

          <p>Contact Us</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-12">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>Burol III, Dasmariñas, Philippines, 4114</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Emergency? Contact Us!</h3>
                  <p> +63 951 290 2433</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>brgy.burol3@gmail.com<br>
                    <brgy class="b3b"></brgy>@gmail.com
                  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                </div>
              </div>

            </div>


          </div>
        </div>

      </div>

    </section><!-- End Contact Section -->


  </main><!-- End #main -->

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
              <strong>Phone:</strong> 0951 290 2433<br>
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

  <script>
    document.getElementById('trackRequestForm').addEventListener('submit', function(e) {
      e.preventDefault(); // Prevent form submission
      const trackingNumber = document.getElementById('trackingNumber').value;

      if (trackingNumber) {
        // Make an AJAX request to check the status and retrieve details
        fetch('track_status.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              tracking_number: trackingNumber
            })
          })
          .then(response => response.json())
          .then(data => {
            const trackingTableBody = document.getElementById('trackingTableBody');
            const trackingTableContainer = document.getElementById('trackingTableContainer');

            trackingTableBody.innerHTML = ''; // Clear previous results

            if (data.success) {
              const details = data.data;

              // Determine status color based on the status value
              let statusClass = '';
              if (details.status === 'Pending') {
                statusClass = 'bg-warning text-dark';
              } else if (details.status === 'Approved') {
                statusClass = 'bg-success text-white';
              } else if (details.status === 'Disapproved') {
                statusClass = 'bg-danger text-white';
              }

              // Append the row dynamically to the table
              trackingTableBody.innerHTML = `
                    <tr>
                        <td>${details.tracking_number}</td>
                        <td>${details.full_name}</td>
                        <td>${details.address}</td>
                        <td>${details.purpose}</td>
                        <td>${details.type}</td>
                        <td>${request.delivery_mode}</td>
                        <td><span class="${statusClass}" style="padding: 3px 5px; border-radius: 4px;">${details.status}</span></td>
                        
                    </tr>
                `;


              trackingTableContainer.classList.remove('d-none');


              $('#trackingTable').DataTable({
                destroy: true,
                paging: true,
                searching: true,
                ordering: true,
                responsive: true
              });

            } else {
              // Hide the table if no data is found
              trackingTableContainer.classList.add('d-none');
              alert(data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      } else {
        alert('Please enter a tracking number.');
      }
    });
  </script>

  <script>
    // Fetch the user's requests when the page loads
    fetch('fetch_user_requests.php')
      .then(response => response.json())
      .then(data => {
        const tableBody = document.getElementById('trackingTableBody');
        tableBody.innerHTML = ''; // Clear the table body

        // Check if there are any requests
        if (data.length > 0) {
          data.forEach(request => {
            let statusClass = '';

            // Determine the status class based on the request status
            if (request.status === 'Pending') {
              statusClass = 'bg-warning text-dark';
            } else if (request.status === 'Approved') {
              statusClass = 'bg-success text-white';
            } else if (request.status === 'Disapproved') {
              statusClass = 'bg-danger text-white';
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                        <td>${request.tracking_number}</td>
                        <td>${request.address}</td> 
                        <td>${request.type}</td>
                        <td>${request.delivery_mode}</td>
                        <td><span class="${statusClass}" style="padding: 3px 5px; border-radius: 4px;">${request.status}</span></td>
                    `;
            tableBody.appendChild(row);
          });
          document.getElementById('trackingTableContainer').classList.remove('d-none'); // Show the table
        }
      })
      .catch(error => console.error('Error fetching user requests:', error));
  </script>



</body>

</html>