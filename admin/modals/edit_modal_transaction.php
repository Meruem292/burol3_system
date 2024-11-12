<!-- Edit Modal -->
<?php include "functions.php" ?>
<div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Hidden field to store the transaction ID -->
                    <input type="hidden" name="transaction_id" value="<?= $row['id'] ?>">

                    <!-- Tracking Number -->
                    <div class="form-group">
                        <label for="tracking_number">Tracking Numbers</label>
                        <input type="text" name="edit_tracking_number" class="form-control" value="<?= htmlspecialchars($row['tracking_number']) ?>" required>
                    </div>

                    <!-- Requestor's Name -->
                    <div class="form-group">
                        <label for="full_name">Requestor's Name</label>
                        <input type="text" name="edit_full_name" class="form-control" value="<?= htmlspecialchars($row['full_name']) ?>" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="edit_category" class="form-control" value="<?= htmlspecialchars($row['category']) ?>" required>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="edit_status" class="form-control" required>
                            <option value="Pending" <?= ($row['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="Approved" <?= ($row['status'] == 'Approved') ? 'selected' : '' ?>>Approved</option>
                            <option value="Disapproved" <?= ($row['status'] == 'Disapproved') ? 'selected' : '' ?>>Disapproved</option>
                        </select>
                    </div>

                    <!-- Payment Receipt Path -->
                    <div class="form-group">
                        <label for="payment_receipt_path">Payment Receipt Path</label>
                        <input type="text" name="edit_payment_receipt_path" class="form-control" value="<?= htmlspecialchars($row['payment_receipt_path']) ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Close Button -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Save Changes Button -->
                    <button type="submit" name="btn_edit_transaction" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
