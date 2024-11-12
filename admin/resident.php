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
    <!-- Header and other includes -->
    <?php include "db.php"; ?>
    <?php include('header.php'); ?>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>

        <aside class="right-side">
            <!-- Content Header -->
            <section class="content-header">
                <h1>Payment Receipts</h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <button class="btn btn-success" data-toggle="modal" data-target="#uploadMopModal">Change MOP</button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#updatePricesModal">Update Prices</button>
                        </div>
                        <div class="box-body">
                            <form method="post">
                                <table id="paymentTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px !important;">
                                                <input type="checkbox" class="cbxMain" onchange="checkMain(this)" />
                                            </th>
                                            <th>Tracking Number</th>
                                            <th>Document ID</th>
                                            <th>Requestor's Name</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th>Receipt</th>
                                            <th style="width: 130px !important;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $squery = $pdo->query("
                                            SELECT pr.id, pr.document_id, pr.payment_receipt_path, d.full_name, d.category, d.status, d.tracking_number 
                                            FROM payment_receipts pr
                                            JOIN documents d ON pr.document_id = d.id
                                        ");
                                        while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                            $statusColor = ($row['status'] === "Approved" ? "green" : ($row['status'] === "Pending" ? "gray" : "red"));
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?= $row['id'] ?>" /></td>
                                            <td><?= htmlspecialchars($row['tracking_number']) ?></td>
                                            <td><?= htmlspecialchars($row['document_id']) ?></td>
                                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                                            <td><?= htmlspecialchars($row['category']) ?></td>
                                            <td><span class="badge" style="background-color: <?= $statusColor ?>;"><?= htmlspecialchars($row['status']) ?></span></td>
                                            <td>
                                                <a href="<?= htmlspecialchars($row['payment_receipt_path']) ?>" data-lightbox="receipt-<?= htmlspecialchars($row['id']) ?>">
                                                    <img src="<?= htmlspecialchars($row['payment_receipt_path']) ?>" alt="Payment Receipt" style="max-width: 50px; max-height: 50px;">
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="view_receipt.php?id=<?= $row['id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editReceiptModal<?= $row['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteReceiptModal<?= $row['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </td>
                                        </tr>
                                        <?php include "modals/edit_modal_receipt.php"; ?>
                                        <?php include "modals/delete_modal_receipt.php"; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.row -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- /.wrapper -->

    <!-- Include modals for adding, editing, and deleting -->
    <?php include "modals/add_modal_receipt.php"; ?>
    <?php include "modals/added_notif.php"; ?>
    <?php include "modals/edit_notif.php"; ?>
    <?php include "modals/delete_notif.php"; ?>

    <?php include "footer.php"; ?>

    <script type="text/javascript">
        $(function() {
            $("#paymentTable").dataTable({
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
