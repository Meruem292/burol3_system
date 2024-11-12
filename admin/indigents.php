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
                                    $query = $pdo->query("SELECT * FROM indigents ORDER BY created_at DESC");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                        <tr>
                                            <td>' . $row['id'] . '</td>
                                            <td>' . $row['full_name'] . '</td>
                                            <td>' . $row['age'] . '</td>
                                            <td>' . $row['address'] . '</td>
                                            <td>' . $row['contact_number'] . '</td>
                                            <td>' . $row['created_at'] . '</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editIndigentModal' . $row['id'] . '">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteIndigentModal' . $row['id'] . '">Delete</button>
                                            </td>
                                        </tr>
                                        ';
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
