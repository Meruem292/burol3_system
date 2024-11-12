
<div id="addOfficialModal" class="modal fade">
    <form method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-sm" style="width:500px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Manage Officials</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Positions</label>
                                <select name="ddl_pos" class="form-control input-sm">
                                    <option selected="" disabled="">-- Select Positions -- </option>
                                    <option value="Barangay Captain">Barangay Captain</option>
                                    <option value="Barangay Councilor">Barangay Councilor</option>
                                    <option value="Barangay Secretary">Barangay Secretary</option>
                                    <option value="SK Chairman">SK Chairman</option>
                                    <option value="SK Kagawad">SK Kagawad</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Complete Name:</label>
                                <input name="txt_cname" class="form-control input-sm" type="text" placeholder="Full Name" />
                            </div>
                            <div class="form-group">
                                <label>Contact Number:</label>
                                <input name="txt_contact" class="form-control input-sm" type="number" placeholder="Contact Number" />
                            </div>
                            <div class="form-group">
                                <label>Address:</label>
                                <input name="txt_address" class="form-control input-sm" type="text" placeholder="Address" />
                            </div>
                            <div class="form-group">
                                <label>Start Term:</label>
                                <input id="txt_sterm" name="txt_sterm" class="form-control input-sm" type="date" placeholder="Start Term" />
                            </div>
                            <div class="form-group">
                                <label>End Term:</label>
                                <input name="txt_eterm" class="form-control input-sm" type="date" placeholder="End Term" />
                            </div>
                            <div class="form-group">
                                <label>Image:</label>
                                <input name="txt_image" class="form-control input-sm" type="file" accept="image/*" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel" />
                    <input type="submit" class="btn btn-primary btn-sm" name="btn_add_official" value="Add Official" />
                </div>
            </div>
        </div>
    </form>
</div>

