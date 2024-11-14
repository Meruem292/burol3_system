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
                        Resident Profile
                    </h1>
                </section>
                <!-- Main content -->
                <section class="content">
                    <?php
                    $id = $_GET['id'];
                    $selectResident = $pdo->query("SELECT * FROM user WHERE id = '$id'");
                    $row = $selectResident->fetch(PDO::FETCH_ASSOC);
                    $dateString = strtotime($row['date_of_birth']);
                    $formattedDate = date('F j, Y', $dateString);

                    $dateStringIssued = strtotime($row['issued_date']);
                    $formattedDateIssued = date('F j, Y', $dateStringIssued);

                    $dateStringExpiry = strtotime($row['expiry_date']);
                    $formattedDateExpiry = date('F j, Y', $dateStringExpiry);
                    ?>
                    <div class="row">
                        <!-- left column -->
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="../uploaded_img/<?= $row['profile_img'] ?>" class="img-thumbnail" width="600" height="600" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h3 style="font-weight: bold; margin-bottom: 20px;">Personal Information:</h3>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Name:</b></span>
                                                <span style="font-size: 20px;"><?= $row['full_name'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Date of Birth:</b></span>
                                                <span style="font-size: 20px;"><?= $formattedDate ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Email Address:</b></span>
                                                <span style="font-size: 20px;"><?= $row['email'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Mobile Number:</b></span>
                                                <span style="font-size: 20px;"><?= $row['mobile_number'] ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Gender:</b></span>
                                                <span style="font-size: 20px;"><?= $row['gender'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Address:</b></span>
                                                <span style="font-size: 20px;"><?= $row['blk']  .' '. $row['street'].' Phase '. $row['phase'].' '. $row['village']  ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 20px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Category:</b></span>
                                                <span style="font-size: 20px;"><?= $row['category'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Nationality:</b></span>
                                                <span style="font-size: 20px;"><?= $row['nationality'] ?></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 style="font-weight: bold; margin-bottom: 20px;">Identification Information:</h3>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>ID Type:</b></span>
                                                <span style="font-size: 20px;"><?= $row['id_type'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>ID Number:</b></span>
                                                <span style="font-size: 20px;"><?= $row['id_number'] ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Issued Authority:</b></span>
                                                <span style="font-size: 20px;"><?= $row['issued_authority'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Issued State:</b></span>
                                                <span style="font-size: 20px;"><?= $row['issued_state'] ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Issued Date:</b></span>
                                                <span style="font-size: 20px;"><?= $formattedDateIssued ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Expiry Date:</b></span>
                                                <span style="font-size: 20px;"><?= $formattedDateExpiry ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Issued Date:</b></span>
                                                <span style="font-size: 20px;"><?= $formattedDateIssued ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Expiry Date:</b></span>
                                                <span style="font-size: 20px;"><?= $formattedDateExpiry ?></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 style="font-weight: bold; margin-bottom: 20px;">Address Information:</h3>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Address Type:</b></span>
                                                <span style="font-size: 20px;"><?= $row['address_type'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Block Number:</b></span>
                                                <span style="font-size: 20px;"><?= $row['block_number'] ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>District:</b></span>
                                                <span style="font-size: 20px;"><?= $row['district'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>State:</b></span>
                                                <span style="font-size: 20px;"><?= $row['state'] ?></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 style="font-weight: bold; margin-bottom: 20px;">Family Information:</h3>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Father Name:</b></span>
                                                <span style="font-size: 20px;"><?= $row['father_name'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Mother Name:</b></span>
                                                <span style="font-size: 20px;"><?= $row['mother_name'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Grandfather Name:</b></span>
                                                <span style="font-size: 20px;"><?= $row['grandfather'] ?></span>
                                            </div>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin-bottom: 10px;">
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Spouse:</b></span>
                                                <span style="font-size: 20px;"><?= $row['spouse_name'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Father in Law:</b></span>
                                                <span style="font-size: 20px;"><?= $row['father_in_law'] ?></span>
                                            </div>
                                            <div class="mb-2">
                                                <span style="font-size: 20px;"><b>Mother in Law:</b></span>
                                                <span style="font-size: 20px;"><?= $row['mother_in_law'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box -->
                    </div> <!-- /.row -->
                </section>
            </aside>
        </div>

        <!-- jQuery 2.0.2 -->
    <?php }
include "footer.php";
    ?>
    <script type="text/javascript">
        $(function() {
            $("#table").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 7]
                }],
                "aaSorting": []
            });
        });
    </script>
    </body>

</html>