
<div id="addVoterModal" class="modal fade">
    <form method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Voter</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" name="voter_name" class="form-control" required />
                    </div> 
                    <div class="form-group">
                        <label>Precint No. :</label>
                        <input type="text" name="precint_no" class="form-control" required />
                    </div> 
                    <div class="form-group">
                        <label>Age:</label>
                        <input type="number" name="voter_age" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="voter_address" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="text" name="voter_contact" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" name="btn_add_voter" value="Add Voter" />
                </div>
            </div>
        </div>
    </form>
</div>
