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
                    <div class="row">
                        <!-- left column -->
                        <div class="box">

                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="resident.php"><span class="info-box-icon bg-green"><i class="fa fa-users"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Resident 
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from user");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="resident.php"><span class="info-box-icon bg-yellow"><i class="fa fa-child"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Kids</span>
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from user WHERE category = 'Kids'");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="resident.php"><span class="info-box-icon bg-red"><i class="fa fa-user"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Teenage</span>
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from user WHERE category = 'Teenage  '");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="resident.php"><span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Adult</span>
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from user WHERE category = 'Adult'");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="resident.php"><span class="info-box-icon bg-green"><i class="fa fa-wheelchair"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total PWD</span>
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from user WHERE category = 'PWD'");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="resident.php"><span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Senior Citizen</span>
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from user WHERE category = 'Senior Citizen'");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="documents.php"><span class="info-box-icon bg-red"><i class="fa fa-file"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Requested Documents</span>
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from documents where status = 'Approved'");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                <div class="info-box">
                                    <a href="documents.php"><span class="info-box-icon bg-blue"><i class="fa fa-folder"></i></span></a>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Blotter Records</span>
                                        <span class="info-box-number">
                                            <?php
                                            $q = $pdo->query("SELECT * from blotter where status = 'Solved'");
                                            $num_rows = $q->rowCount();
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                        </div><!-- /.box -->
                    </div>
                    <div class="row">
                        <!-- left column -->
                        <div class="box">
                            <div class="box-header">
                                <div style="padding:10px;">
                                    <form action="export.php" method="post">
                                        <button class="btn btn-primary btn-sm" type="submit" name="export"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                                    </form>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Total residents based on their age
                                            </div>
                                            <div class="panel-body">
                                                <div id="morris-bar-chart1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Total requested documents
                                            </div>
                                            <div class="panel-body">
                                                <div id="morris-donut-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Total residents based on their gender
                                            </div>
                                            <div class="panel-body">
                                                <div id="morris-bar-chart2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </aside>
        </div>

        <!-- jQuery 2.0.2 -->
    <?php }
include "footer.php";
include "./charts/bar-chart.php";
include "./charts/pie-chart.php";
?>
    <script type="text/javascript">
        $(function() {
            $("#table").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 5]
                }],
                "aaSorting": []
            });
        });
    </script>
    </body>

    

</html>