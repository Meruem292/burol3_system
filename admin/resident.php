<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

ob_start();
include('main_style.php');
?>

<body class="skin-black">
    <!-- header logo: style can be found in header.less -->
    <?php include "db.php"; ?>
    <?php include('header.php'); ?>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Residents</h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- left column -->
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                </button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <?php if (!isset($_SESSION['staff'])): ?>
                                            <th style="width: 20px !important;">
                                                <input type="checkbox" class="cbxMain" onchange="checkMain(this)" />
                                            </th>
                                        <?php endif; ?>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Address Type</th>
                                        <th>Status</th>
                                        <th style="width: 130px !important;">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $squery = $pdo->query("SELECT * FROM user WHERE is_archive = 0");
                                    while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                        $userId = $row['id'];
                                        $statusColor = ($row['status'] === "Pending" ? "gray" : ($row['status'] === "Approved" ? "green" : "red"));
                                    ?>
                                        <tr>
                                            <?php if (!isset($_SESSION['staff'])): ?>
                                                <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?= $userId ?>" /></td>
                                            <?php endif; ?>
                                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                                            <td><?= htmlspecialchars($row['age']) ?></td>
                                            <td><?= htmlspecialchars($row['gender']) ?></td>
                                            <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                                            <td><?= htmlspecialchars($row['blk'] . ' ' . $row['street'] . ' Phase ' . $row['phase'] . ' ' . $row['village']) ?></td>
                                            <td><?= htmlspecialchars($row['address_type']) ?></td>
                                            <td><span class="badge" style="background-color: <?= $statusColor ?>;"><?= htmlspecialchars($row['status']) ?></span></td>
                                            <td>
                                                <div style="display: flex; gap: 5px;">
                                                    <a class="btn btn-primary btn-sm" href="view_resident.php?id=<?= $userId ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editResidentModal<?= $userId ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                                    <form method="post" action="archive.php">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                        <input type="hidden" name="table" value="user" />
                                                        <button type="submit" name="archive" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to archive this log?')"><i class="fa fa-archive"></i> Archive</button>
                                                    </form>

                                                    <form method="post" action="delete.php">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                    <input type="hidden" name="table" value="user" />
                                                    <button type="submit" name="archive" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Delete this log?')"><i class="fa fa-trash"></i> Delete</button>
                                                </form>
                                                </div>

                                            </td>
                                        </tr>
                                        <?php include "modals/edit_modal_resident.php"; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php include "modals/delete_modal.php"; ?>


                            <?php
                            if (isset($_POST['btn_delete'])) {
                                if (!empty($_POST['chk_delete'])) {
                                    foreach ($_POST['chk_delete'] as $value) {
                                        $deleteQuery = $pdo->prepare("DELETE FROM user WHERE id = :userId");
                                        $deleteQuery->execute(['userId' => $value]);

                                        if ($deleteQuery) {
                                            $_SESSION['delete'] = 1;
                                            header("Location: " . $_SERVER['REQUEST_URI']);
                                            exit();
                                        }
                                    }
                                }
                            }
                            ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.row -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- /.wrapper -->

    <?php include "modals/add_modal.php"; ?>
    <?php include "modals/added_notif.php"; ?>
    <?php include "modals/edit_notif.php"; ?>
    <?php include "modals/delete_notif.php"; ?>
    <?php include "modals/existing_notif.php"; ?>
    <?php include "footer.php"; ?>

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