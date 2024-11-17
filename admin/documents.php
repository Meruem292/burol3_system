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
                                                $squery = $pdo->query("SELECT d.*, u.full_name, u.village 
                                                FROM documents d 
                                                JOIN user u ON d.full_name = u.full_name 
                                                WHERE d.status = 'Pending' AND d.is_archive = 0");

                                                while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?php echo $row['id'] ?>" /></td>
                                                        <td><?php echo $row['tracking_number'] ?></td>
                                                        <td><?php echo $row['full_name'] ?></td>
                                                        <td><?php echo $row['village'] ?> </td>
                                                        <td><?php echo $row['address'] ?></td>
                                                        <td><?php echo $row['delivery_mode'] ?></td>
                                                        <td><?php echo $row['note'] ?></td>
                                                        <td><?php echo $row['type'] ?></td>
                                                        <td><?php echo $row['category'] ?></td>
                                                        <td>
                                                            <?php
                                                            // Set label class based on the status value
                                                            $statusClass = '';
                                                            switch ($row['status']) {
                                                                case 'Pending':
                                                                    $statusClass = 'btn-warning'; // Yellow for Pending
                                                                    break;
                                                                case 'Approved':
                                                                    $statusClass = 'btn-success'; // Green for Approved
                                                                    break;
                                                                case 'Disapproved':
                                                                    $statusClass = 'btn-danger'; // Red for Delete
                                                                    break;
                                                                default:
                                                                    $statusClass = 'btn-secondary'; // Default class if none match
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class="<?php echo $statusClass; ?>" style="padding: 3px 5px; border-radius: 4px;"><?php echo $row['status']; ?></span>
                                                        </td>

                                                        <td>
                                                            <div style="display: flex; gap: 5px;">
                                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalDocument<?php echo $row['id'] ?>">
                                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                                </button>

                                                                <form method="post" action="archive.php">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                                    <input type="hidden" name="table" value="documents" />
                                                                    <button type="submit" name="archive" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to archive this log?')"><i class="fa fa-archive"></i> Archive</button>
                                                                </form>

                                                                <form method="post" action="delete.php">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                                    <input type="hidden" name="table" value="documents" />
                                                                    <button type="submit" name="archive" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Delete this log?')"><i class="fa fa-trash"></i> Delete</button>
                                                                </form>

                                                                

                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
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
                                            </thead>
                                            <tbody>
                                                <?php
                                                $squery = $pdo->query("SELECT d.*, u.full_name, u.village 
                                                        FROM documents d 
                                                        JOIN user u ON d.full_name = u.full_name 
                                                        WHERE d.status = 'Approved' AND d.is_archive = 0 ");
                                                while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?php echo $row['id'] ?>" /></td>
                                                        <td><?php echo $row['tracking_number'] ?></td>
                                                        <td><?php echo $row['full_name'] ?></td>
                                                        <td><?php echo $row['village'] ?> </td>
                                                        <td><?php echo $row['address'] ?></td>
                                                        <td><?php echo $row['delivery_mode'] ?></td>
                                                        <td><?php echo $row['note'] ?></td>
                                                        <td><?php echo $row['type'] ?></td>
                                                        <td><?php echo $row['category'] ?></td>
                                                        <td>
                                                            <?php
                                                            // Set label class based on the status value
                                                            $statusClass = '';
                                                            switch ($row['status']) {
                                                                case 'Pending':
                                                                    $statusClass = 'btn-warning'; // Yellow for Pending
                                                                    break;
                                                                case 'Approved':
                                                                    $statusClass = 'btn-success'; // Green for Approved
                                                                    break;
                                                                case 'Disapproved':
                                                                    $statusClass = 'btn-danger'; // Red for Delete
                                                                    break;
                                                                default:
                                                                    $statusClass = 'btn-secondary'; // Default class if none match
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class="<?php echo $statusClass; ?>" style="padding: 3px 5px; border-radius: 4px;"><?php echo $row['status']; ?></span>
                                                        </td>

                                                        <td>
                                                            <div style="display: flex; gap: 5px;">
                                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalDocument<?php echo $row['id'] ?>">
                                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                                </button>
                                                                <form method="post" action="archive.php">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                                    <input type="hidden" name="table" value="documents" />
                                                                    <button type="submit" name="archive" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to archive this log?')"><i class="fa fa-archive"></i> Archive</button>
                                                                </form>
                                                                <form method="post" action="delete.php">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                                    <input type="hidden" name="table" value="documents" />
                                                                    <button type="submit" name="archive" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Delete this log?')"><i class="fa fa-trash"></i> Delete</button>
                                                                </form>

                                                                <a href="generate_document.php?clearance=<?= $row['id']?>&delivery_mode=<?= $row['delivery_mode']?>" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Generate</a>

                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    // Include modals for editing and deleting documents
                                                    include "modals/edit_modal_document.php";
                                                    include "modals/delete_modal.php";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Disapproved Tab -->
                                    <div class="tab-pane" id="disapproved">
                                        <table id="disapprovedTable" class="table table-bordered table-striped">
                                            <thead>
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
                                            </thead>
                                            <tbody>
                                                <?php
                                                $squery = $pdo->query("SELECT d.*, u.full_name, u.village 
                                                        FROM documents d 
                                                        JOIN user u ON d.full_name = u.full_name 
                                                        WHERE d.status = 'Disapproved' AND d.is_archive = 0 ");
                                                while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?php echo $row['id'] ?>" /></td>
                                                        <td><?php echo $row['tracking_number'] ?></td>
                                                        <td><?php echo $row['full_name'] ?></td>
                                                        <td><?php echo $row['village'] ?> </td>
                                                        <td><?php echo $row['address'] ?></td>
                                                        <td><?php echo $row['delivery_mode'] ?></td>
                                                        <td><?php echo $row['note'] ?></td>
                                                        <td><?php echo $row['type'] ?></td>
                                                        <td><?php echo $row['category'] ?></td>
                                                        <td>
                                                            <?php
                                                            // Set label class based on the status value
                                                            $statusClass = '';
                                                            switch ($row['status']) {
                                                                case 'Pending':
                                                                    $statusClass = 'btn-warning'; // Yellow for Pending
                                                                    break;
                                                                case 'Approved':
                                                                    $statusClass = 'btn-success'; // Green for Approved
                                                                    break;
                                                                case 'Disapproved':
                                                                    $statusClass = 'btn-danger'; // Red for Delete
                                                                    break;
                                                                default:
                                                                    $statusClass = 'btn-secondary'; // Default class if none match
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class="<?php echo $statusClass; ?>" style="padding: 3px 5px; border-radius: 4px;"><?php echo $row['status']; ?></span>
                                                        </td>

                                                        <td>
                                                            <div style="display: flex; gap: 5px;">
                                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalDocument<?php echo $row['id'] ?>">
                                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                                </button>
                                                                <form method="post" action="archive.php">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                                    <input type="hidden" name="table" value="documents" />
                                                                    <button type="submit" name="archive" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to archive this log?')"><i class="fa fa-archive"></i> Archive</button>
                                                                </form>

                                                                <form method="post" action="delete.php">
                                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                                    <input type="hidden" name="table" value="documents" />
                                                                    <button type="submit" name="archive" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Delete this log?')"><i class="fa fa-trash"></i> Delete</button>
                                                                </form>
                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    // Include modals for editing and deleting documents
                                                    include "modals/edit_modal_document.php";
                                                    include "modals/delete_modal.php";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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