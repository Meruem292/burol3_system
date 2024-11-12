<?php if(isset($_SESSION['existing_official'])){
    echo '<script>$(document).ready(function (){existing_official();});</script>';
    unset($_SESSION['existing_official']);
    } 
echo '<div class="alert alert-duplicate alert-autocloseable-duplicate" style="background: #d9534f; position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Existing official record !
</div>';
?>