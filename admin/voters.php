<?php
session_start();
ob_start(); // Start output buffering before any HTML output
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
} else {
    include('main_style.php');
    include('functions.php')
?>

    <body class="skin-black">
        <?php include "db.php"; ?>
        <?php include('header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php include('sidebar.php'); ?>

            <aside class="right-side">
                <section class="content-header">
                    <h1>Voters</h1>
                </section>

                <section class="content">
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addVoterModal">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i> Add Voter
                                </button>
                            </div>
                        </div>

                        <div class="box-body">
                            <table id="votersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th style="width: 20%;">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $pdo->query("SELECT * FROM voters WHERE is_archive = 0 ORDER BY created_at DESC");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['full_name'] ?></td>
                                            <td><?php echo $row['age'] ?></td>
                                            <td><?php echo $row['address'] ?></td>
                                            <td><?php echo $row['contact_number'] ?></td>
                                            <td><?php echo $row['status'] ?></td>
                                            <td><?php echo $row['created_at'] ?></td>
                                            <td>
                                                <div style="display: flex; gap: 5px;">
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editVoterModal<?php echo $row['id'] ?>" style="height: 30px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit
                                                    </button>

                                                    <form method="POST" action="archive.php">
                                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                        <input type="hidden" name="table" value="voters">
                                                        <button class="btn btn-warning btn-sm" type="submit" name="archive" value="1"><i class="fa fa-archive"></i> Archive</button>
                                                    </form>

                                                    <form method="post" action="delete.php">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                        <input type="hidden" name="table" value="voters" />
                                                        <button type="submit" name="archive" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Delete this log?')"><i class="fa fa-trash"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        // Include the edit and delete modal files with voter-specific data
                                        include "modals/edit_modal_voters.php";
                                        include "modals/delete_modal_voters.php";
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <script>
                                $(document).ready(function() {
                                    $('#votersTable').DataTable({
                                        "aoColumnDefs": [{
                                            "bSortable": false,
                                            "aTargets": [7]
                                        }],
                                        "aaSorting": []
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        <?php include "modals/add_modal_voters.php"; ?>
        <?php include "footer.php"; ?>

    </body>

    </html>
<?php } ?>