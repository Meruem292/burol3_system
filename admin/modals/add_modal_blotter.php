<!-- Add Modal for Blotter Entry -->

<div id="addBlotterModal" class="modal fade">
    <form method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-sm" style="width:500px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Blotter Entry</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date:</label>
                                <input name="add_date" class="form-control input-sm" type="date" placeholder="Date of Incident" required />
                            </div>
                            <div class="form-group">
                                <label>Time:</label>
                                <input name="add_time" class="form-control input-sm" type="time" placeholder="Time of Incident" required />
                            </div>
                            <div class="form-group">
                                <label>Incident Type:</label>
                                <input name="add_incident_type" class="form-control input-sm" type="text" placeholder="Incident Type" required />
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea name="add_description" class="form-control input-sm" placeholder="Brief description of the incident" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Reporting Individual (Complainant):</label>
                                <input name="add_reporter_name" id="add_reporter_name" class="form-control input-sm" type="text" placeholder="Name of the complainant" required autocomplete="off" />
                                <div id="suggestion-box"></div> <!-- Keep the suggestion box here -->
                            </div>

                            <div class="form-group">
                                <label>Accused Individual:</label>
                                <input name="add_accused_name" class="form-control input-sm" type="text" placeholder="Name of the accused" required />
                            </div>
                            <div class="form-group">
                                <label>Status:</label>
                                <select name="add_status" class="form-control input-sm" required>
                                    <option selected="" disabled="">-- Select Status --</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Dismissed">Dismissed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel" />
                    <input type="submit" class="btn btn-primary btn-sm" name="btn_add_blotter" value="Add Entry" />
                </div>
            </div>
        </div>
    </form>
</div>