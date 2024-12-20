<!-- Delete Announcement Modal -->
<div id="deleteAnnouncementModal<?php echo $row['id']; ?>" class="modal fade">
    <form method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Announcement</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the announcement titled <strong><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></strong>?</p>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" name="btn_delete_announcement" value="Delete" />
                </div>
            </div>
        </div>
    </form>
</div>
