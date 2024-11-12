<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

if (isset($_POST['btn_login'])) {
    $username = $_POST['txt_username'];
    $password = $_POST['txt_password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username AND password = :password AND type = 'administrator'");
    $stmt->execute(['username' => $username, 'password' => $password]);
    $numrow_admin = $stmt->rowCount();

    if ($numrow_admin > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['role'] = "administrator";
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header('Location: index.php');
        exit(); // Always call exit after a redirect
    } else {
        $error_message = "Invalid Account"; // Store error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barangay Burol III</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(0deg);
            z-index: 1;
            opacity: 0.1;
        }

        .waves-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20vh;
            z-index: 2;
            pointer-events: none;
        }

        .container.forms {
            position: relative;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 20px;
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
            z-index: 15;
            position: relative;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .waves-container {
                height: 30px;
            }

            .container.forms {
                padding: 20px;
                margin-top: 20px;
            }
        }

        /* Waves CSS */
        .parallax > use {
            animation: move-forever 10s cubic-bezier(.55, .5, .45, .5) infinite; /* General speed for all waves */
        }

        .parallax > use:nth-child(1) {
            animation-delay: -1s; /* First wave with slight delay */
            animation-duration: 8s; /* Faster wave */
        }

        .parallax > use:nth-child(2) {
            animation-delay: -2s; /* Second wave with slight delay */
            animation-duration: 10s; /* Medium speed wave */
        }

        .parallax > use:nth-child(3) {
            animation-delay: -3s; /* Third wave with slight delay */
            animation-duration: 12s; /* Slower wave */
        }

        .parallax > use:nth-child(4) {
            animation-delay: -4s; /* Fourth wave with slight delay */
            animation-duration: 15s; /* Slowest wave */
        }

        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }

            100% {
                transform: translate3d(85px, 0, 0);
            }
        }
    </style>
</head>

<body class="skin-black">
    <img src="assets/img/b3b.jpg" alt="Logo" class="logo" id="draggable-logo">

    <div class="waves-container">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(0, 123, 255, 0.7)" />
                <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(0, 123, 255, 0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="4" fill="rgba(0, 123, 255, 0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="6" fill="rgba(0, 123, 255, 0.1)" />
            </g>
        </svg>
    </div>

    <div class="container forms">
        <div class="col-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <img src="assets/img/b3b.jpg" style="height:130px; margin-bottom: 10px;" />
                    <h3 class="panel-title">
                        <strong>Welcome Admin</strong>
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="txt_username">Username</label>
                            <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label for="txt_password">Password</label>
                            <input type="password" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary" name="btn_login">Log in</button>
                        <?php if (isset($error_message)): ?>
                            <label id="error" class="label label-danger pull-right"><?= $error_message; ?></label>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const logo = document.getElementById('draggable-logo');
        let isDragging = false;
        let previousMouseX, previousMouseY;
        let rotationX = 0;
        let rotationY = 0;

        logo.addEventListener('mousedown', (e) => {
            isDragging = true;
            previousMouseX = e.clientX;
            previousMouseY = e.clientY;
            logo.style.cursor = 'grabbing';
        });

        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                const deltaX = e.clientX - previousMouseX;
                const deltaY = e.clientY - previousMouseY;

                rotationX += deltaY * 0.1;
                rotationY += deltaX * 0.1;
                logo.style.transform = `translate(-50%, -50%) rotateX(${rotationX}deg) rotateY(${rotationY}deg)`;

                previousMouseX = e.clientX;
                previousMouseY = e.clientY;
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            logo.style.cursor = 'grab';
        });

        logo.addEventListener('dragstart', (e) => {
            e.preventDefault();
        });
    </script>

</body>
</html>
