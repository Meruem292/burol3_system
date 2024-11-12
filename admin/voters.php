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
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $pdo->query("SELECT * FROM voters ORDER BY created_at DESC");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<tr>
                                            <td>' . htmlspecialchars($row['id']) . '</td>
                                            <td>' . htmlspecialchars($row['full_name']) . '</td>
                                            <td>' . htmlspecialchars($row['age']) . '</td>
                                            <td>' . htmlspecialchars($row['address']) . '</td>
                                            <td>' . htmlspecialchars($row['contact_number']) . '</td>
                                            <td>' . htmlspecialchars($row['status']) . '</td>
                                            <td>' . htmlspecialchars($row['created_at']) . '</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editVoterModal' . htmlspecialchars($row['id']) . '">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteVoterModal' . htmlspecialchars($row['id']) . '">Delete</button>
                                            </td>
                                        </tr>';

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
