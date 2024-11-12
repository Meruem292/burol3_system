<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
} else {
    ob_start();
    include('main_style.php'); ?>

    <body class="skin-black">
        <?php include "db.php"; ?>
        <?php include('header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php include('sidebar.php'); ?>

            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Logs
                    </h1>
                </section>

                <section class="content">
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
                                <h3 class="box-title">Logs Data</h3>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="logsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        <th><Details></Details></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch logs from the database
                                    $query = $pdo->query("SELECT * FROM logs ORDER BY date_log DESC");
                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                        <tr>
                                            <td>' . $row['id'] . '</td>
                                            <td>' . $row['user'] . '</td>
                                            <td>' . date('Y-m-d H:i:s', strtotime($row['date_log'])) . '</td>
                                            <td>' . $row['action'] . '</td>
                                            <td>' . $row['details'] . '</td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        <?php include "footer.php"; ?>
        
        <script>
            $(document).ready(function() {
                $('#logsTable').DataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [] // Adjust this if you want to disable sorting on specific columns
                    }],
                    "aaSorting": [] // Disable initial sorting
                });
            });
        </script>
    </body>

<?php }
?>

</html>
