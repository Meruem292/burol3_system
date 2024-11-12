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
                        Barangay Officials
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="box">
                            <div class="box-header">
                                <div style="padding:10px;">

                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addOfficialModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Official</button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>

                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body"> 
                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                if (!isset($_SESSION['staff'])) {
                                                ?>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                <?php
                                                }
                                                ?>
                                                <th>Position</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Start of Term</th>
                                                <th>End of Term</th>
                                                <th style="width: 130px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = $pdo->query("select * from officials WHERE is_archive = 0");
                                            while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                                echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>
                                                        <td>' . $row['position'] . '</td>
                                                        <td>' . $row['full_name'] . '</td>
                                                        <td>' . $row['contact_number'] . '</td>
                                                        <td>' . $row['address'] . '</td>
                                                        <td>' . $row['start_term'] . '</td>
                                                        <td>' . $row['end_term'] . '</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm" data-target="#editModalOfficial' . $row['id'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
                                                echo '</td>
                                                    </tr>
                                                    ';
                                                include "modals/edit_modal_official.php";
                                                include "modals/delete_modal.php";
                                                if (isset($_POST['btn_delete'])) {
                                                    if (isset($_POST['chk_delete'])) {
                                                        foreach ($_POST['chk_delete'] as $value) {
                                                            $delete_query = $pdo->query("DELETE from officials where id = '$value' ");

                                                            if ($delete_query) {
                                                                $_SESSION['delete'] = 1;
                                                                header("location: " . $_SERVER['REQUEST_URI']);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div><!-- /.box -->
                    </div> <!-- /.row -->
                </section>
            </aside>
        </div>

        <?php
        include "modals/add_modal.php";
        include "functions.php";
        include "modals/added_notif.php";
        include "modals/edit_notif.php";
        include "modals/delete_notif.php";
        include "modals/existing_notif.php";
        ?>

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