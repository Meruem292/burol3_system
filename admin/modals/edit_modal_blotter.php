<!-- Edit Modal for Blotter Entry -->

<div id="editModalBlotter<?php echo $row['id']; ?>" class="modal fade">
  <form method="post">
    <div class="modal-dialog modal-sm" style="width:500px !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Blotter Entry</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Date:</label>
                <input class="form-control input-sm" type="date" name="edit_date" value="<?php echo $row['date']; ?>" />
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Time:</label>
                <input class="form-control input-sm" type="time" name="edit_time" value="<?php echo $row['time']; ?>" />
              </div>
            </div>
            <div class="col-md-12">
              <input type="hidden" value="<?php echo $row['id']; ?>" name="hidden_id"/>
              <div class="form-group">
                <label>Incident Type:</label>
                <input name="edit_incident_type" class="form-control input-sm" type="text" value="<?php echo $row['incident_type']; ?>" />
              </div>
              <div class="form-group">
                <label>Description:</label>
                <textarea name="edit_description" class="form-control input-sm"><?php echo $row['description']; ?></textarea>
              </div>
              <div class="form-group">
                <label>Reporter Name:</label>
                <input name="edit_reporter_name" class="form-control input-sm" type="text" value="<?php echo $row['reporter_name']; ?>" />
              </div>
              <div class="form-group">
                <label>Accused Name:</label>
                <input name="edit_accused_name" class="form-control input-sm" type="text" value="<?php echo $row['accused_name']; ?>" />
              </div>
              <div class="form-group">
                <label>Status:</label>
                <select class="form-control input-sm" name="edit_status">
                  <option value="<?php echo $row['status']; ?>" selected><?php echo $row['status']; ?></option>
                  <option value="Pending">Pending</option>
                  <option value="Resolved">Resolved</option>
                  <option value="Dismissed">Dismissed</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
          <input type="submit" class="btn btn-primary btn-sm" name="btn_edit_blotter" value="Save Changes"/>
        </div>
      </div>
    </div>
  </form>
</div>
