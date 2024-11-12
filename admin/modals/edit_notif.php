<?php if(isset($_SESSION['edited'])){
    echo '<script>$(document).ready(function (){success();});</script>';
    unset($_SESSION['edited']);
    } ?>
<div class="alert alert-success alert-autocloseable-success" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Edit Successfully Saved!
</div>

<?php if(isset($_SESSION['error_update'])){
    echo '<script>$(document).ready(function (){error_update();});</script>';
    unset($_SESSION['error_update']);
    } ?>
<div class="alert alert-duplicate alert-autocloseable-duplicate" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Update failed!
</div>