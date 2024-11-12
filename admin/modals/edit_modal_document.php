
<?php echo '<div id="editModalDocument' . $row['id'] . '" class="modal fade" tabindex="-1" role="dialog">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:500px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Document Information</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Tracking Number: </label>
                        <input class="form-control input-sm" readonly type="text" value="' . $row['tracking_number'] . '" />
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Control Number: </label>
                        <input class="form-control input-sm" readonly type="text" value="' . $row['control_number'] . '" />
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" value="' . $row['id'] . '" name="hidden_id" id="hidden_id"/>
                    <div class="form-group">
                        <label>Complete Name:</label>
                        <input name="txt_edit_cname" class="form-control input-sm" readonly type="text" value="' . $row['full_name'] . '"/>
                    </div>
                    <div class="form-group">
                        <label>Address: </label>
                        <input name="txt_edit_address" class="form-control input-sm" readonly type="text" value="' . $row['address'] . '" />
                    </div>
                    <div class="form-group">
                        <label>Age: </label>
                        <input name="txt_edit_age" class="form-control input-sm" type="number" value="' . $row['age'] . '" />
                    </div>
                    <div class="form-group">
                        <label>Pick-up Date: </label>
                        <input name="txt_edit_pickup_date" class="form-control input-sm" type="date" value="' . $row['pickup_date'] . '" />
                    </div>
                    <div class="form-group">
                        <label>Pick-up Time: </label>
                        <input name="txt_edit_pickup_time" class="form-control input-sm" type="time" value="' . $row['pickup_time'] . '" />
                    </div>
                    <div class="form-group">
                        <label>Year of Residency: </label>
                        <input name="txt_edit_year_residency" class="form-control input-sm" type="number" value="' . $row['year_residency'] . '" />
                    </div>
                    <div class="form-group">
                        <label>Type of Document: </label>
                        <input name="txt_edit_type_document" class="form-control input-sm" readonly type="text" value="' . $row['type'] . '" />
                    </div>
                    <div class="form-group">
                        <label>Purpose: </label>
                        <input name="txt_edit_purpose" class="form-control input-sm" type="text" value="' . $row['purpose'] . '" />
                    </div>
                    <div class="form-group">
                        <label>Status: </label>
                        <select class="form-control input-sm" name="document_status">
                            <option value="' . $row['status'] . '" selected>' . $row['status'] . '</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Disapproved">Disapproved</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_edit_document" value="Save Changes"/>
        </div>
    </div>
  </div>
</form>
</div>'; 
?>
