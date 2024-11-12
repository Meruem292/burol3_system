
<div id="editIndigentModal<?php echo $row['id']; ?>" class="modal fade">
    <form method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Indigent</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <label for="edit_full_name">Full Name:</label>
                        <input id="edit_full_name" name="edit_indigent_name" class="form-control" type="text" value="<?php echo $row['full_name']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="edit_age">Age:</label>
                        <input id="edit_age" name="edit_indigent_age" class="form-control" type="number" value="<?php echo $row['age']; ?>" min="0" required />
                    </div>
                    <div class="form-group">
                        <label for="edit_address">Address:</label>
                        <input id="edit_address" name="edit_indigent_address" class="form-control" type="text" value="<?php echo $row['address']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="edit_contact_number">Contact Number:</label>
                        <input id="edit_contact_number" name="edit_indigent_contact" class="form-control" type="text" value="<?php echo $row['contact_number']; ?>" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" name="btn_edit_indigent" value="Update Indigent" />
                </div>
            </div>
        </div>
    </form>
</div>
