<div id="editAnnouncementModal<?php echo $row['id']; ?>" class="modal fade">
    <form method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Announcement</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">
                    
                    <div class="form-group">
                        <label for="edit_title">Title:</label>
                        <input id="edit_title" name="edit_announcement_title" class="form-control" type="text" value="<?php echo $row['title']; ?>" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_body">Body:</label>
                        <textarea id="edit_body" name="edit_announcement_body" class="form-control" rows="4" required><?php echo $row['body']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit_picture">Picture:</label>
                        <input id="edit_picture" name="edit_announcement_picture" class="form-control-file" type="file" />
                        <p class="help-block">Current image: <img src="<?php echo $row['picture']; ?>" alt="Announcement Image" width="50"></p>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" name="btn_edit_announcement" value="Update Announcement" />
                </div>
            </div>
        </div>
    </form>
</div>
