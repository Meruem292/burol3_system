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
                        Indigents
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- left column -->
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addIndigentModal">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i> Add Indigent
                                </button>
                            </div>
                        </div><!-- /.box-header -->

                        <div class="box-body">
                            <table id="indigentsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Created At</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $pdo->query("SELECT * FROM indigents WHERE is_archive = 0  ORDER BY created_at DESC");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['full_name'] ?></td>
                                            <td><?php echo $row['age'] ?></td>
                                            <td><?php echo $row['address'] ?></td>
                                            <td><?php echo $row['contact_number'] ?></td>
                                            <td><?php echo $row['created_at'] ?></td>
                                            <td>
                                                <div style="display: flex; gap: 5px;">
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editIndigentModal<?php echo $row['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>

                                                    <form method="post" action="archive.php">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                        <input type="hidden" name="table" value="indigents" />
                                                        <button type="submit" name="archive" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to archive this log?')"><i class="fa fa-archive"></i> Archive</button>
                                                    </form>

                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteIndigentModal<?php echo $row['id'] ?>"><i class="fa fa-trash"></i> Delete</button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        include "modals/edit_modal_indigents.php";
                                        include "modals/delete_modal_indigents.php";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box -->
                </section>
            </aside>
        </div>

        <!-- Include Modals -->
        <?php include "modals/add_modal_indigents.php"; ?>
        <?php include "functions.php"; ?>

        <!-- jQuery and DataTables initialization -->
        <script>
            $(document).ready(function() {
                $('#indigentsTable').DataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [7] // Disable sorting on the "Options" column
                    }],
                    "aaSorting": [] // Disable initial sorting
                });
            });
        </script>

        <?php include "footer.php"; ?>
    </body>
<?php } ?>

</html>