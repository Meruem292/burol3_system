<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
} else {
    ob_start();
    include('main_style.php'); ?>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php

        include "db.php";
        ?>
        <?php include('header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- left column -->
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        <!-- jQuery 2.0.2 -->
    <?php }
include "footer.php";
unset($_SESSION['message']);
unset($_SESSION['status']);
    ?>

    </body>



</html>