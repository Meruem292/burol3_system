<?php
session_start();
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];
    $gender = $_POST['gender'];
    $village = $_POST['village'];
    $phase = $_POST['phase'];
    $blk = $_POST['blk'];
    $street = $_POST['street'];
    $address_type = $_POST['address_type'];
    $nationality = $_POST['nationality'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $block_number = $_POST['block_number'];
    $category = $_POST['category'];

    $profile_img = $_FILES['profile_img']['name'];
    $profile_img_tmp = $_FILES['profile_img']['tmp_name'];

    // Set the target directory
    $target_dir = "uploaded_img/";
    $target_file = $target_dir . basename($profile_img);

    // Calculate age
    $dob = new DateTime($date_of_birth);
    $now = new DateTime();
    $age = $now->diff($dob)->y;

    // Hash the email to use as the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            $_SESSION['message'] = "User with email: $email already exists.";
            $_SESSION['status'] = "warning";
        } else {
            // Attempt to move the uploaded file to the target directory
            if (move_uploaded_file($profile_img_tmp, $target_file)) {
                $sql = "INSERT INTO user (full_name, date_of_birth, age, email, password, mobile_number, gender, village, phase, blk, street, address_type, nationality, state, district, block_number, profile_img, category) 
                VALUES (:full_name, :date_of_birth, :age, :email, :password, :mobile_number, :gender, :village, :phase, :blk, :street, :address_type, :nationality, :state, :district, :block_number, :profile_img, :category)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':full_name' => $full_name,
                    ':date_of_birth' => $date_of_birth,
                    ':age' => $age,
                    ':email' => $email,
                    ':password' => $hashed_password,
                    ':mobile_number' => $mobile_number,
                    ':gender' => $gender,
                    ':village' => $village,
                    ':phase' => $phase,
                    ':blk' => $blk,
                    ':street' => $street,
                    ':address_type' => $address_type,
                    ':nationality' => $nationality,
                    ':state' => $state,
                    ':district' => $district,
                    ':block_number' => $block_number,
                    ':profile_img' => $profile_img,
                    ':category' => $category
                ]);
                $_SESSION['message'] = "Registered successfully.";
                $_SESSION['status'] = "success";
            } else {
                $_SESSION['message'] = "Error uploading profile image.";
                $_SESSION['status'] = "error";
            }
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['status'] = "error";
    }
}
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="assets/css/register.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Brgy. Burol III</title>
    <link href="assets/img/bground.png" rel="icon">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            position: relative;
            /* Make body relative for absolute positioning of logo */
            overflow: hidden;
            /* Prevent scrolling */
        }

        .field {
            opacity: 0.1;
        }

        .container.forms {
            position: relative;
            z-index: 10;
            /* Form appears above the logo */
            background-color: rgba(255, 255, 255, 0.85);
            /* Slight opacity */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-content header {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .field.input-field input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;

        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Waves CSS */
        .waves {
            position: absolute;
            bottom: 0;
            /* Moves the waves to the bottom */
            left: 0;
            width: 100%;
            height: 8vh;
            /* Control wave height */
            z-index: 0;
            /* Waves behind the form */
            pointer-events: none;
            /* Prevent interaction */
        }

        .parallax>use {
            animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }

        .parallax>use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }

        .parallax>use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }

        .parallax>use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }

        .parallax>use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
        }

        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }

            100% {
                transform: translate3d(85px, 0, 0);
            }
        }

        /* Shrinking for mobile */
        @media (max-width: 768px) {
            .waves {
                height: 40px;
                min-height: 40px;
            }

            .container.forms {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>Registration</header>
        <form method="POST" enctype="multipart/form-data">
            <!-- First Section -->
            <div class="form first">
                <div class="details personal">
                    <h2>Personal Information</h2>
                    <div class="fields">
                        <div class="input-field">
                            <label for="full_name">Full Name</label>
                            <input id="full_name" type="text" name="full_name" placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label for="date_of_birth">Date of Birth</label>
                            <input id="date_of_birth" type="date" name="date_of_birth" required>
                        </div>
                        <div class="input-field">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-field">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="input-field">
                            <label for="mobile_number">Mobile Number</label>
                            <input id="mobile_number" type="number" name="mobile_number" placeholder="Enter mobile number" required>
                        </div>
                        <div class="input-field">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="village">Village</label>
                            <select id="village" name="village" required>
                                <option disabled selected>Select Village</option>
                                <option value="Accacia Homes">Accacia Homes</option>
                                <option value="Sitio Parang">Sitio Parang</option>
                                <option value="Tierra Verde">Tierra Verde</option>
                                <option value="Windsor">Windsor</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="phase">Phase</label>
                            <input id="phase" type="text" name="phase" placeholder="Enter your address">
                        </div>
                        <div class="input-field">
                            <label for="blk">Blk & Lot</label>
                            <input id="blk" type="text" name="blk" placeholder="Blk A-1 Lot 1" required>
                        </div>
                        <div class="input-field">
                            <label for="street">Street</label>
                            <input id="street" type="text" name="street" placeholder="Street name">
                        </div>
                    </div>
                </div>
                <div class="form-link">
                    <span>Already have an account? <a href="login.php">Login</a></span>
                </div>
                <button type="button" class="nextBtn" onclick="nextForm(0)">
                    <span class="btnText">Next</span>
                    <i class="uil uil-arrow-right"></i>
                </button>
            </div>

            <!-- Second Section -->
            <div class="form second" style="display: none;">
                <div class="details address">
                    <h2>Address Details</h2>
                    <div class="fields">
                        <div class="input-field">
                            <label for="profile_img">Profile Image</label>
                            <input id="profile_img" type="file" name="profile_img" accept="image/*" required>
                        </div>
                        <div class="input-field">
                            <label for="category">Category</label>
                            <select id="category" name="category" required>
                                <option disabled selected>Select category</option>
                                <option value="Kids">Kids</option>
                                <option value="Teenage">Teenage</option>
                                <option value="Adult">Adult</option>
                                <option value="PWD">PWD</option>
                                <option value="Senior Citizen">Senior Citizen</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="address_type">Address Type</label>
                            <input id="address_type" type="text" name="address_type" placeholder="Permanent or Temporary" required>
                        </div>
                        <div class="input-field">
                            <label for="nationality">Nationality</label>
                            <input id="nationality" type="text" name="nationality" placeholder="Enter nationality" required>
                        </div>
                        <div class="input-field">
                            <label for="state">State</label>
                            <input id="state" type="text" name="state" placeholder="Enter your state" required>
                        </div>
                        <div class="input-field">
                            <label for="district">District</label>
                            <input id="district" type="text" name="district" placeholder="Enter your district" required>
                        </div>
                        <div class="input-field">
                            <label for="block_number">Block Number</label>
                            <input id="block_number" type="number" name="block_number" placeholder="Enter block number" required>
                        </div>

                    </div>
                </div>
                <div class="buttons">
                    <button type="button" class="btn btn-secondary" onclick="previousForm(0)" style="background-color: gray; border-color: gray;">
                        <i class="uil uil-arrow-left" style="margin-right: 5px;"></i>
                        <span class="btnText">Back</span>
                    </button>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Submit
                    </button>
                </div>
            </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">PRIVACY POLICY</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    PRIVACY POLICY HERE!!
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_resident" class="btn btn-primary">
                        <i class="uil uil-navigator"></i> I AGREE </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Disagree</button>
                </div>
            </div>
        </div>
    </div>

    </form>
    <div class="waves-container">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(0, 123, 255, 0.7)" /> <!-- Deep Blue -->
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(0, 123, 255, 0.5)" /> <!-- Medium Blue -->
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(0, 123, 255, 0.3)" /> <!-- Lighter Blue -->
                <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(0, 123, 255, 0.1)" /> <!-- Lightest Blue -->
            </g>
        </svg>
    </div>



    <script src="assets/js/sweetalert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <script>
        function nextForm(index) {
            console.log("Next button clicked. Index:", index);
            var forms = document.querySelectorAll('.form');
            if (forms[index]) {
                forms[index].style.display = 'none';
            }
            if (forms[index + 1]) {
                forms[index + 1].style.display = 'block';
            }
        }

        function previousForm() {
            const forms = document.querySelectorAll('.form');
            forms[1].style.display = 'none'; // Hide the second form
            forms[0].style.display = 'block'; // Show the first form
        }

        document.addEventListener('DOMContentLoaded', function() {
            function checkInputs() {
                var firstFormInputs = document.querySelectorAll('.form.first input[required], .form.first select[required]');
                var nextBtn = document.querySelector('.nextBtn');
                var allFilled = true;

                for (var i = 0; i < firstFormInputs.length; i++) {
                    if (firstFormInputs[i].value.trim() === '') {
                        allFilled = false;
                        break;
                    }
                }

                if (allFilled) {
                    nextBtn.classList.remove('disabled');
                } else {
                    nextBtn.classList.add('disabled');
                }
            }

            var form = document.querySelector('form');
            var nextBtn = document.getElementById('nextBtn');

            form.addEventListener('change', function() {
                checkInputs();
            });
        });
    </script>

    <?php if (isset($_SESSION['message']) && isset($_SESSION['status'])) { ?>
        <script>
            Swal.fire({
                text: "<?php echo $_SESSION['message']; ?>",
                icon: "<?php echo $_SESSION['status']; ?>",
            });
        </script>
    <?php
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    } ?>
</body>

</html>