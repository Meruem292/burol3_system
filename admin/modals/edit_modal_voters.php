<!-- edit_modal_voters.php -->
<div class="modal fade" id="editVoterModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Voter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input type="text" name="edit_voter_name" class="form-control" value="<?php echo $row['full_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" name="edit_voter_age" class="form-control" value="<?php echo $row['age']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="edit_voter_address" class="form-control" value="<?php echo $row['address']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number:</label>
                        <input type="text" name="edit_voter_contact" class="form-control" value="<?php echo $row['contact_number']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="ddl_status" class="form-control" required>
                            <option value="Active" <?php echo ($row['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                            <option value="Inactive" <?php echo ($row['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="btn_edit_voter" class="btn btn-primary" value="Update Voter">
                </div>
            </form>
        </div>
    </div>
</div>
