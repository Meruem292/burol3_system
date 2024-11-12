
<div id="deleteVoterModal<?php echo $row['id']; ?>" class="modal fade">
    <form method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Voter</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong><?php echo $row['full_name']; ?></strong>?</p>
                    <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>"> <!-- Changed to hidden_id -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" name="btn_delete_voter" value="Delete" />
                </div>
            </div>
        </div>
    </form>
</div>
