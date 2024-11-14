<?php include('functions.php');?>
<div id="editResidentModal<?php echo $row['id']; ?>" class="modal fade">
    <form method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Resident</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="resident_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="edit_full_name">Full Name:</label>
                        <input id="edit_full_name" name="edit_full_name" class="form-control" type="text" value="<?php echo htmlspecialchars($row['full_name'], ENT_QUOTES, 'UTF-8'); ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email:</label>
                        <input id="edit_email" name="edit_email" class="form-control" type="email" value="<?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="edit_mobile_number">Mobile Number:</label>
                        <input id="edit_mobile_number" name="edit_mobile_number" class="form-control" type="text" value="<?php echo $row['mobile_number']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="edit_date_of_birth">Date of Birth:</label>
                        <input id="edit_date_of_birth" name="edit_date_of_birth" class="form-control" type="date" value="<?php echo $row['date_of_birth']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="edit_gender">Gender:</label>
                        <select id="edit_gender" name="edit_gender" class="form-control" required>
                            <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <!-- Status field -->
                    <div class="form-group">
                        <label for="edit_status">Status:</label>
                        <select id="edit_status" name="edit_status" class="form-control" required>
                            <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Approved" <?php echo ($row['status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                            <option value="Declined" <?php echo ($row['status'] == 'Declined') ? 'selected' : ''; ?>>Declined</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" name="btn_edit_resident" value="Update Resident" />
                </div>
            </div>
        </div>
    </form>
</div>
