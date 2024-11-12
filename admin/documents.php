<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
} else {
    ob_start();
    include('main_style.php');
?>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php
        include "db.php";
        include('header.php');
        ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Requesting of Documents</h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box">
                            <div class="box-header">
                                <div style="padding:10px;">
                                    Baranggay Clearance / Certificate of Indigency / Certificate of Residency
                                    <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addOfficialModal">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Request Document
                                    </button> -->
                                    <!-- <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                    </button> -->
                                </div>
                            </div><!-- /.box-header -->

                            <div class="box-body table-responsive">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a data-target="#pending" data-toggle="tab">Pending</a></li>
                                    <li><a data-target="#approved" data-toggle="tab">Approved</a></li>
                                    <li><a data-target="#disapproved" data-toggle="tab">Disapproved</a></li>
                                </ul>

                                <form method="post">
                                    <div class="tab-content">
                                        <!-- Pending Tab -->
                                        <div class="tab-pane active in" id="pending">
                                            <table id="table" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <?php if (!isset($_SESSION['staff'])) { ?>
                                                            <th style="width: 20px !important;">
                                                                <input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" />
                                                            </th>
                                                        <?php } ?>
                                                        <th>Tracking #</th>
                                                        <th>Name</th>
                                                        <th>Village</th>
                                                        <th>Address</th>
                                                        <th>Mode of Delivery</th>
                                                        <th>Note</th>
                                                        <th>Type</th>
                                                        <th>Progress</th>
                                                        <th>Status</th>
                                                        <th style="width: 130px !important;">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // SQL query to select documents along with the user's full name using full_name as a reference
                                                    $squery = $pdo->query("
                                                        SELECT d.*, u.full_name, u.village 
                                                        FROM documents d 
                                                        JOIN user u ON d.full_name = u.full_name 
                                                        WHERE d.status = 'Pending'
                                                    ");

                                                    while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                                        echo '<tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>
                                                            <td>' . $row['tracking_number'] . '</td>
                                                            <td>' . $row['full_name'] . '</td>
                                                            <td>' . $row['village'] . ' </td>
                                                            <td>'  . $row['address'] . '</td>
                                                            <td>' . $row['delivery_mode'] . '</td>
                                                            <td>' . $row['note'] . '</td>
                                                            <td>' . $row['type'] . '</td>
                                                            <td>' . $row['category'] . '</td>
                                                            <td><span class="btn-warning" style="padding: 3px 5px; border-radius: 4px;">' . $row['status'] . '</span></td>
                                                            <td>
                                                                <div style="display: flex; gap: 5px;">
                                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalDocument' . $row['id'] . '">
                                                                        <i class="fa fa-pencil-square-o"></i> Edit
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>';

                                                        // Include modals for editing and deleting documents
                                                        include "modals/edit_modal_document.php";
                                                        include "modals/delete_modal.php";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Approved Tab -->
                                        <div class="tab-pane" id="approved">
                                            <table id="approvedTable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Tracking #</th>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Mode of Delivery</th>
                                                        <th>Note</th>
                                                        <th>Type</th>
                                                        <th>Progress</th>
                                                        <th>Status</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $squery = $pdo->query("SELECT * FROM documents WHERE status = 'Approved'");
                                                    while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                                        echo '<tr>
                                                        <td>' . $row['tracking_number'] . '</td>
                                                        <td>' . $row['full_name'] . '</td>
                                                        <td>' . $row['address'] . '</td>
                                                        <td>' . $row['delivery_mode'] . '</td>
                                                        <td>' . $row['note'] . '</td>
                                                        <td>' . $row['type'] . '</td>
                                                        <td>' . $row['category'] . '</td>
                                                        <td><span class="btn-success" style="padding: 3px 5px; border-radius: 4px;">' . $row['status'] . '</span></td>
                                                        <td>
                                                            <a href="generate_document.php?clearance=' . $row['id'] . '&val=' . base64_encode($row['control_number'] . '|' . $row['full_name'] . '|' . $row['address'] . '|' . $row['age'] . '|' . $row['note'] . '|' . $row['date_added'] . '|' . $row['year_residency']) . '&category=' . $row['category'] . '&delivery_mode=' . $row['delivery_mode'] . '" class="btn btn-success btn-sm">
                                                                <i class="fa fa-upload"></i> Generate
                                                            </a>
                                                        </td>
                                                    </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Disapproved Tab -->
                                        <div class="tab-pane" id="disapproved">
                                            <table id="disapprovedTable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Tracking #</th>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Mode of Delivery</th>
                                                        <th>Note</th>
                                                        <th>Type</th>
                                                        <th>Progress</th>
                                                        <th>Status</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $squery = $pdo->query("SELECT * FROM documents WHERE status = 'Disapproved'");
                                                    while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                                        echo '<tr>
                                                        <td>' . $row['tracking_number'] . '</td>
                                                        <td>' . $row['full_name'] . '</td>
                                                        <td>' . $row['delivery_mode'] . '</td>
                                                        <td>' . $row['address'] . '</td>
                                                        <td>' . $row['note'] . '</td>
                                                        <td>' . $row['type'] . '</td>
                                                        <td>' . $row['category'] . '</td>
                                                        <td><span class="btn-danger" style="padding: 3px 5px; border-radius: 4px;">' . $row['status'] . '</span></td>
                                                        <td>
                                                            <div style="display: flex; gap: 5px;">
                                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalDocument' . $row['id'] . '">
                                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                                    include "modals/edit_modal_document.php";
                                                        include "modals/delete_modal.php";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.box -->
                    </div> <!-- /.row -->
                </section>
            </aside>
        </div>

        <?php
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

        // Checkbox select all function
        function checkMain(cbx) {
            $('.chk_delete').prop('checked', cbx.checked);
        }
    </script>
    <script type="text/javascript">
        $(function() {
            $("#disapprovedTable").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 7]
                }],
                "aaSorting": []
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $("#approvedTable").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 7]
                }],
                "aaSorting": []
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // When delete button is clicked
            $('#btn_delete').on('click', function() {
                // Get all selected checkboxes
                let selectedIds = [];
                $('.chk_delete:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                // Check if any checkbox is selected
                if (selectedIds.length > 0) {
                    // Join the selected IDs and set it to the hidden input field
                    $('#delete_ids').val(selectedIds.join(','));
                    // Submit the form
                    $('#deleteForm').submit();
                } else {
                    alert('Please select at least one document to delete.');
                }
            });
        });
    </script>


    </body>

</html>