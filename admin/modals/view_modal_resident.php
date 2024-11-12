
<?php echo '<div id="viewModalResident'.$row['user_id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:500px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">View Resident Information</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p><b>Name:</b> <span>'.$row['full_name'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Date of Birth:</b> <span>'.$row['date_of_birth'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Age:</b> <span>'.$row['age'].' years old</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Age:</b> <span>'.$row['email'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Contact Number:</b> <span>'.$row['mobile_number'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Gender:</b> <span>'.$row['gender'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Address:</b> <span>'.$row['blk']  .' '. $row['street'].' Phase '. $row['phase'].' '. $row['village'] .'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>ID Type:</b> <span>'.$row['id_type'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>ID Number:</b> <span>'.$row['id_number'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Address Type:</b> <span>'.$row['blk']  .' '. $row['street'].' Phase '. $row['phase'].' '. $row['village'] .'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Nationality:</b> <span>'.$row['nationality'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Block Number:</b> <span>'.$row['block_number'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Father Name:</b> <span>'.$row['father_name'].'</span></p>
            </div>
            <div class="col-md-12">
                <p><b>Mother Name:</b> <span>'.$row['mother_name'].'</span></p>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
        </div>
    </div>
  </div>
</form>
</div>';?>