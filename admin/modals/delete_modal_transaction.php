
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $row['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Form that submits to delete_transaction.php -->
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $row['id'] ?>">Delete Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Hidden input to pass the transaction ID -->
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <p>Are you sure you want to delete the transaction with tracking number <strong><?= htmlspecialchars($row['tracking_number']) ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="btn_delete_transaction">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
