<?php include "db.php"; ?>
<script>
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Barangay Clearance",
            value: <?php
                    $q = $pdo->query("SELECT * from documents where type = 'Barangay Clearance' and status = 'Approved'");
                    $numrow = $q->rowCount();
                    echo $numrow;
                    ?>
        }, {
            label: "Certificate of Indigency",
            value: <?php
                    $q = $pdo->query("SELECT * from documents where type = 'Certificate of Indigency' and status = 'Approved'");
                    $numrow = $q->rowCount();
                    echo $numrow;
                    ?>
        }, {
            label: "Certificate of Residency",
            value: <?php
                    $q = $pdo->query("SELECT * from documents where type = 'Certificate of Residency' and status = 'Approved'");
                    $numrow = $q->rowCount();
                    echo $numrow;
                    ?>
        }],
        resize: true
    });
</script>