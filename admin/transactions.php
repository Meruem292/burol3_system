<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
}

ob_start();
include('main_style.php');
?>

<body class="skin-black">
    <?php include 'db.php'; ?>
    <?php include 'header.php'; ?>
    <?php
    // At the top of your file, after session_start()
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prices'])) {
        foreach ($_POST['prices'] as $id => $new_price) {
            // Update the price in the database
            $stmt = $pdo->prepare("UPDATE prices SET price = :price WHERE id = :id");
            $stmt->execute([':price' => $new_price, ':id' => $id]);
        }

        // Optionally, set a success message or redirect
        $_SESSION['message'] = "Prices updated successfully.";
        header("Location: transactions.php"); // Redirect back to your page
        exit;
    }

    ?>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php include 'sidebar.php'; ?>

        <aside class="right-side">
            <section class="content-header">
                <h1>Payment Receipts</h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <button class="btn btn-success" data-toggle="modal" data-target="#uploadMopModal">Change MOP</button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#updatePricesModal">Update Prices</button>
                        </div>
                        <div class="box-body">
                            <table id="paymentTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tracking Number</th>
                                        <th>Document ID</th>
                                        <th>Requestor's Name</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Receipt</th>
                                        <th>Actions</th>
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
                                        $statusClass = '';
                                        if ($row['status'] === 'Approved') {
                                            $statusClass = 'alert-success';
                                        } elseif ($row['status'] === 'Pending') {
                                            $statusClass = 'alert-warning';
                                        } elseif ($row['status'] === 'Disapproved') {
                                            $statusClass = 'alert-danger';
                                        }
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="<?= $row['id'] ?>" /></td>
                                            <td><?= htmlspecialchars($row['tracking_number']) ?></td>
                                            <td><?= htmlspecialchars($row['document_id']) ?></td>
                                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                                            <td><?= htmlspecialchars($row['category']) ?></td>
                                            <td><span class="badge <?= $statusClass ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                                            <td>
                                                <a href="<?= htmlspecialchars($row['payment_receipt_path']) ?>" data-lightbox="receipt-<?= htmlspecialchars($row['id']) ?>">
                                                    <img src="<?= htmlspecialchars($row['payment_receipt_path']) ?>" alt="Payment Receipt" style="max-width: 50px; max-height: 50px;">
                                                </a>
                                            </td>
                                            <td>
                                                <?php if ($row['status'] === 'Pending'): ?>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#approveModal<?= $row['id'] ?>">
                                                        <i class="fa fa-check" aria-hidden="true"></i> Approve
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#disapproveModal<?= $row['id'] ?>">
                                                        <i class="fa fa-times" aria-hidden="true"></i> Disapprove
                                                    </button>
                                                <?php endif; ?>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?= $row['id'] ?>">
                                                    <i class="fa fa-eye"></i> View
                                                </button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $row['id'] ?>">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $row['id'] ?>">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                        
                                        include "modals/other_modal_transaction.php";
                                        include "modals/edit_modal_transaction.php";
                                        include "modals/delete_modal_transaction.php";      
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </div>
    <!-- Modals -->
    


    <!-- Upload MOP Modal -->
    <div class="modal fade" id="uploadMopModal" tabindex="-1" role="dialog" aria-labelledby="uploadMopModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Latest Mode of Payment</h4>
                    <div class="mop-container">
                        <?php
                        $mopStmt = $pdo->prepare("SELECT * FROM payment_methods ORDER BY id DESC LIMIT 1");
                        $mopStmt->execute();
                        $latestMop = $mopStmt->fetch(PDO::FETCH_ASSOC);

                        if ($latestMop) {
                            echo "<div class='mop-item' style='margin: 10px; text-align: center;'>
                                    <a href='uploaded_img/mops/{$latestMop['image_path']}' data-lightbox='mop-{$latestMop['id']}' data-title='{$latestMop['method_name']}'>
                                        <img src='uploaded_img/mops/{$latestMop['image_path']}' alt='{$latestMop['method_name']}' style='width: 100px; height: auto;'>
                                    </a>
                                    <div>{$latestMop['method_name']}</div>
                                  </div>";
                        } else {
                            echo "<div>No modes of payment available.</div>";
                        }
                        ?>
                    </div>
                    <form id="uploadMopForm" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="mopImage">Select MOP Image</label>
                            <input type="file" name="mop_image" id="mopImage" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mopName">MOP Name</label>
                            <input type="text" name="mop_name" id="mopName" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload MOP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE PRICES -->
    <div class="modal fade" id="updatePricesModal" tabindex="-1" role="dialog" aria-labelledby="updatePricesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Update Document Prices</h4>
                    <form id="updatePricesForm" method="POST">
                        <div class="mop-container">
                            <?php
                            $mopStmt = $pdo->prepare("SELECT * FROM prices");
                            $mopStmt->execute();
                            $prices = $mopStmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($prices as $price) {
                            ?>
                                <div class="form-group">
                                    <label for="documentType_<?php echo $price['id']; ?>"><?php echo htmlspecialchars($price['doc_type']); ?></label>
                                    <input type="text" name="prices[<?php echo $price['id']; ?>]" id="documentType_<?php echo $price['id']; ?>" class="form-control" value="<?php echo htmlspecialchars($price['price']); ?>" required>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update All Prices</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Lightbox CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <!-- Custom Scripts -->

    <script>
        // Example function to open the modal and populate the form
        function openUpdatePricesModal(priceData) {
            document.getElementById('documentType').value = priceData.doc_type;
            document.getElementById('price').value = priceData.price;
            document.getElementById('priceId').value = priceData.id; // Set the ID for the hidden input

            // Show the modal
            $('#updatePricesModal').modal('show');
        }

        // Example event listener for a button click to open the modal
        document.querySelectorAll('.update-price-button').forEach(button => {
            button.addEventListener('click', () => {
                const priceData = JSON.parse(button.dataset.price); // Assuming data-price holds the JSON of the price data
                openUpdatePricesModal(priceData);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#paymentTable').dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 6] // Adjusted for new actions column
                }],
                "aaSorting": []
            });

            // Handle MOP upload form submission
            $('#uploadMopForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'upload_mop.php', // Create a PHP file to handle the upload
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response); // Show success message
                        $('#uploadMopModal').modal('hide'); // Close the modal
                        location.reload(); // Reload the page to see the changes
                    },
                    error: function() {
                        alert('Error uploading MOP image.');
                    }
                });
            });
        });
    </script>


    <?php include 'footer.php'; ?>
</body>

</html>