<!-- Add Indigent Modal -->

<div id="addIndigentModal" class="modal fade">
    <form method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Indigent</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="full_name">Full Name:</label>
                        <input id="full_name" name="full_name" class="form-control" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input id="age" name="age" class="form-control" type="number" min="0" required />
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input id="address" name="address" class="form-control" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number:</label>
                        <input id="contact_number" name="contact_number" class="form-control" type="tel" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" name="btn_add_indigent" value="Add Indigent" />
                </div>
            </div>
        </div>
    </form>
</div>
