<?php

require "db.php";
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['status'] === "Approved") {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['full_name'] = $user['full_name'];
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Invalid email or password.";
                    $_SESSION['status'] = "error";
                }
            } else {
                $_SESSION['message'] = "You are not approved yet, please wait the admin for approval.";
                $_SESSION['status'] = "error";
            }
        } else {
            $_SESSION['message'] = "User not found.";
            $_SESSION['status'] = "error";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['status'] = "error";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brgy. Burol III</title>
    <link href="assets/img/bground.png" rel="icon">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
            position: relative; /* Make body relative for absolute positioning of logo */
            overflow: hidden; /* Prevent scrolling */
        }

        .logo {
            position: absolute; /* Position logo absolutely */
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%) rotate(0deg); /* Adjust position */
            z-index: 1; /* Ensure logo is behind the form */
            opacity: 0.1; /* Make it semi-transparent */
            cursor: grab; /* Change cursor to indicate dragging */
            transition: transform 0.1s; /* Smooth rotation */
        }

        .container.forms {
            position: relative;
            z-index: 10; /* Form appears above the logo */
            background-color: rgba(255, 255, 255, 0.85); /* Slight opacity */
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
            bottom: 0; /* Moves the waves to the bottom */
            left: 0;
            width: 100%;
            height: 20vh; /* Control wave height */
            z-index: 1; /* Waves behind the form */
            pointer-events: none; /* Prevent interaction */
        }

        .parallax > use {
            animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }

        .parallax > use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }

        .parallax > use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }

        .parallax > use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }

        .parallax > use:nth-child(4) {
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

    <!-- Logo -->
    <img src="assets/img/b3b.jpg" alt="Logo" class="logo" id="draggable-logo">

    <!-- Login Form -->
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Login</header>
                <form method="POST">
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" name="email" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password" name="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <button type="submit" name="login">Login</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Don't have an account? <a href="register.php" class="link signup-link">Register</a></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Waves Overlay -->
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
        const logo = document.getElementById('draggable-logo');
        let isDragging = false;
        let previousMouseX, previousMouseY;
        let rotationX = 0; // Rotation angle around the X axis
        let rotationY = 0; // Rotation angle around the Y axis

        logo.addEventListener('mousedown', (e) => {
            isDragging = true;
            previousMouseX = e.clientX;
            previousMouseY = e.clientY;
            logo.style.cursor = 'grabbing'; // Change cursor when dragging
        });

        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                // Calculate the distance moved
                const deltaX = e.clientX - previousMouseX;
                const deltaY = e.clientY - previousMouseY;

                // Rotate the logo based on mouse movement
                rotationX += deltaY * 0.1; // Adjust the speed of rotation
                rotationY += deltaX * 0.1; // Adjust the speed of rotation
                logo.style.transform = `translate(-50%, -50%) rotateX(${rotationX}deg) rotateY(${rotationY}deg)`;

                // Update the previous mouse position
                previousMouseX = e.clientX;
                previousMouseY = e.clientY;
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            logo.style.cursor = 'grab'; // Change cursor back when not dragging
        });

        // Prevent default drag behavior on the image
        logo.addEventListener('dragstart', (e) => {
            e.preventDefault();
        });

        // SweetAlert for session messages
        <?php if (isset($_SESSION['message']) && isset($_SESSION['status'])) { ?>
            Swal.fire({
                text: "<?php echo $_SESSION['message']; ?>",
                icon: "<?php echo $_SESSION['status']; ?>",
            });
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['status']);
        } ?>
    </script>

</body>

</html>
