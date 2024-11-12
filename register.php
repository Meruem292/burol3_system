<?php

require "db.php";
session_start();

if (isset($_POST['add_resident'])) {
    $full_name = $_POST['full_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $gender = $_POST['gender'];
    $village = $_POST['village'];
    $phase = $_POST['phase'];
    $blk = $_POST['blk'];
    $street = $_POST['street'];
    $id_type = $_POST['id_type'];
    $id_number = $_POST['id_number'];
    $issued_authority = $_POST['issued_authority'];
    $issued_state = $_POST['issued_state'];
    $issued_date = $_POST['issued_date'];
    $expiry_date = $_POST['expiry_date'];
    $address_type = $_POST['address_type'];
    $nationality = $_POST['nationality'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $block_number = $_POST['block_number'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $grandfather = $_POST['grandfather'];
    $spouse_name = $_POST['spouse_name'];
    $father_in_law = $_POST['father_in_law'];
    $mother_in_law = $_POST['mother_in_law'];
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

    $hashed_password = password_hash($email, PASSWORD_DEFAULT);

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
                $sql = "INSERT INTO user (full_name, date_of_birth, age, email, password, mobile_number, gender, village, phase, blk, street, id_type, id_number, issued_authority, issued_state, issued_date, expiry_date, address_type, nationality, state, district, block_number, father_name, mother_name, grandfather, spouse_name, father_in_law, mother_in_law, profile_img, category) 
                VALUES (:full_name, :date_of_birth, :age, :email, :password, :mobile_number, :gender, :village, :phase, :blk, :street, :id_type, :id_number, :issued_authority, :issued_state, :issued_date, :expiry_date, :address_type, :nationality, :state, :district, :block_number, :father_name, :mother_name, :grandfather, :spouse_name, :father_in_law, :mother_in_law, :profile_img, :category)";

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
                    ':id_type' => $id_type,
                    ':id_number' => $id_number,
                    ':issued_authority' => $issued_authority,
                    ':issued_state' => $issued_state,
                    ':issued_date' => $issued_date,
                    ':expiry_date' => $expiry_date,
                    ':address_type' => $address_type,
                    ':nationality' => $nationality,
                    ':state' => $state,
                    ':district' => $district,
                    ':block_number' => $block_number,
                    ':father_name' => $father_name,
                    ':mother_name' => $mother_name,
                    ':grandfather' => $grandfather,
                    ':spouse_name' => $spouse_name,
                    ':father_in_law' => $father_in_law,
                    ':mother_in_law' => $mother_in_law,
                    ':profile_img' => $profile_img,
                    ':category' => $category
                ]);
                $_SESSION['message'] = "Register successfully.";
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
            <div class="form first">
                <div class="details personal">

                    <div class="fields">
                        <div class="input-field">
                            <label>Full Name</label>
                            <input type="text" name="full_name" placeholder="Enter your name" required>
                        </div>

                        <div class="input-field">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" placeholder="Enter birth date" required>
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="number" name="mobile_number" placeholder="Enter mobile number" required>
                        </div>

                        <div class="input-field">
                            <label>Gender</label>
                            <select name="gender" required>
                                <option disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Village</label>
                            <select name="village" required>
                                <option disabled selected>Select Village</option>
                                <option value="Accacia Homes">Accacia Homes</option>
                                <option value="Sitio Parang">Sitio Parang</option>
                                <option value="Tierra Verde">Tierra Verde</option>
                                <option value="Windsor">Windsor</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Phase</label>
                            <input type="text" name="phase" placeholder="Enter your address">
                        </div>

                        <div class="input-field">
                            <label>Blk & Lot</label>
                            <input type="text" name="blk" placeholder="Blk A-1 Lot 1" required>
                        </div>
                        <div class="input-field">
                            <label>Street</label>
                            <input type="text" name="street" placeholder="St.">
                        </div>


                    </div>
                </div>

                <div class="details ID">
                    <div class="fields">
                        <div class="input-field">
                            <label>ID Type</label>
                            <input type="text" name="id_type" placeholder="Enter ID type" required>
                        </div>

                        <div class="input-field">
                            <label>ID Number</label>
                            <input type="number" name="id_number" placeholder="Enter ID number" required>
                        </div>

                        <div class="input-field">
                            <label>Issued Authority</label>
                            <input type="text" name="issued_authority" placeholder="Enter issued authority" required>
                        </div>

                        <div class="input-field">
                            <label>Issued State</label>
                            <input type="text" name="issued_state" placeholder="Enter issued state" required>
                        </div>

                        <div class="input-field">
                            <label>Issued Date</label>
                            <input type="date" name="issued_date" placeholder="Enter your issued date" required>
                        </div>

                        <div class="input-field">
                            <label>Expiry Date</label>
                            <input type="date" name="expiry_date" placeholder="Enter expiry date" required>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; width: 100%;">
                            <div class="input-field" style="width: 100%;">
                                <label>Profile Image</label>
                                <input type="file" name="profile_img" accept="image/*" required>
                            </div>
                            <div class="input-field" style="width: 100%;">
                                <label>Category</label>
                                <select name="category" required>
                                    <option disabled selected>Select category</option>
                                    <option value="Kids">Kids</option>
                                    <option value="Teenage">Teenage</option>
                                    <option value="Adult">Adult</option>
                                    <option value="PWD">PWD</option>
                                    <option value="Senior Citizen">Senior Citizen</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-link">
                        <span>Already have an account? <a href="login.php" class="link signup-link">Login</a></span>
                    </div>  

                    <button type="button" class="nextBtn disabled" onclick="nextForm(0)" id="nextBtn">
                        <span class="btnText">Next</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                    
                </div>
            </div>

            <div class="form second" style="display: none;">
                <div class="details address">
                    <span class="title">Address Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Address Type</label>
                            <input type="text" name="address_type" placeholder="Permanent or Temporary" required>
                        </div>

                        <div class="input-field">
                            <label>Nationality</label>
                            <input type="text" name="nationality" placeholder="Enter nationality" required>
                        </div>

                        <div class="input-field">
                            <label>State</label>
                            <input type="text" name="state" placeholder="Enter your state" required>
                        </div>

                        <div class="input-field" style="width: 100%;">
                            <label>District</label>
                            <input type="text" name="district" placeholder="Enter your district" required>
                        </div>

                        <div class="input-field" style="width: 100%;">
                            <label>Block Number</label>
                            <input type="number" name="block_number" placeholder="Enter block number" required>
                        </div>
                    </div>
                </div>

                <div class="details family">
                    <span class="title">Family Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Father Name</label>
                            <input type="text" name="father_name" placeholder="Enter father name" required>
                        </div>

                        <div class="input-field">
                            <label>Mother Name</label>
                            <input type="text" name="mother_name" placeholder="Enter mother name" required>
                        </div>

                        <div class="input-field">
                            <label>Grandfather</label>
                            <input type="text" name="grandfather" placeholder="Enter grandfather name" required>
                        </div>

                        <div class="input-field">
                            <label>Spouse Name</label>
                            <input type="text" name="spouse_name" placeholder="Enter spouse name" required>
                        </div>

                        <div class="input-field">
                            <label>Father in Law</label>
                            <input type="text" name="father_in_law" placeholder="Father in law name" required>
                        </div>

                        <div class="input-field">
                            <label>Mother in Law</label>
                            <input type="text" name="mother_in_law" placeholder="Mother in law name" required>
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="submit" name="add_resident" class="submit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="form-link">
            <span>Already have an account? <a href="login.php" class="link signup-link">Login</a></span>
        </div>

    </div>
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