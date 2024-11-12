
<!-- Delete Modal for Blotter Entry -->
<div id="deleteModalBlotter<?php echo $row['id']; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the blotter entry for <strong><?php echo $row['reporter_name']; ?></strong>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
        <form method="post" style="display:inline;">
          <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>"/>
          <input type="submit" class="btn btn-primary btn-sm" name="btn_delete_blotter" value="Yes"/>
        </form>
      </div>
    </div>
  </div>
</div>
