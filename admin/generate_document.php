<!DOCTYPE html>
<html id="clearance">

<style>
    @media print {
        .noprint {
            visibility: hidden;
        }

        .print-bg {
            background-color: #01aefd;
            width: 81.6rem;
            padding: 20px;
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
    }

    @page {
        size: auto;
        margin: 4mm;
    }

    h5 {
        font-family: 'Times New Roman', Times, serif !important;
        font-weight: bold !important;
        margin: 0 !important;
    }

    p {
        font-family: 'Times New Roman', Times, serif !important;
    }
</style>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
} else {
    ob_start();
    include "db.php";
    $_SESSION['clr'] = $_GET['clearance'];
    include('main_style.php');


    $deliveryMode = $_GET['delivery_mode'] ?? ''; // Adjust according to your logic
    $documentId = $_GET['clearance'];

    // Update the category based on delivery mode
    $newCategory = '';
    if ($deliveryMode === 'delivery') {
        $newCategory = 'for delivery';
    } elseif ($deliveryMode === 'pick-up') {
        $newCategory = 'for pick-up';
    }

    if (!empty($newCategory) && !empty($documentId)) {
        $updateCategory = $pdo->prepare("UPDATE documents SET category = '$newCategory' WHERE id = '$documentId'");
        $updateCategory->execute();
    }

    
    $generatePrintData = $pdo->query("SELECT * FROM documents WHERE id = '$documentId'");
    $rowData = $generatePrintData->fetch(PDO::FETCH_ASSOC);

    $day = date('j');
    $month = date('F');
    $year = date('Y');

    function getDaySuffix($day)
    {
        if ($day >= 11 && $day <= 13) {
            return 'th';
        }
        switch ($day % 10) {
            case 1:
                return 'st';
            case 2:
                return 'nd';
            case 3:
                return 'rd';
            default:
                return 'th';
        }
    }

    $formatted_date = "<p style=\"font-size: 18px; text-indent: 30px;\">Issued this <u>" . $day . getDaySuffix($day) . "</u> day of <u>" . $month . "</u> " . $year . ".</p>";

?>

    <body class="skin-black">
        
        <div>
            <div style="display: flex; flex-direction: column; align-items: center; width: 100%; margin-top: 20px;">
                <div class="header-img">
                    <img src="assets/img/header.png">
                </div>
                <div class="print-bg" style="background-color: #01aefd; width: 81.6rem; padding: 20px; display: flex; gap: 10px; margin-bottom: 10px;">
                    <div class="col-md-4" style="background-color: white; padding: 20px 0;">
                        <h3 class="text-center" style="font-family: 'Times New Roman', Times, serif; margin-bottom: 20px; margin-top: 0; font-weight: bold;">Barangay Officials</h3>
                        <?php
                        $officialSelect = $pdo->query("SELECT * FROM officials");
                        while ($row = $officialSelect->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <div style="display: flex; flex-direction: column; text-align: center; margin-bottom: 20px;">
                                <h5><?= strtoupper($row['full_name']) ?></h5>
                                <p><?= strtoupper($row['position']) ?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <div style="display: flex; flex-direction: column; text-align: center; margin-bottom: 20px; margin-top: 70px;">
                            <p>Control No. <u><?= strtoupper($rowData['control_number']) ?></u></p>
                        </div>
                    </div>
                    <div class="col-md-8" style="background-color: white; padding: 20px; position: relative;">
                        <img src="assets/img/logo.png" style="opacity: 15%; position: absolute; width: 450px; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="">
                        <div style="position: relative; z-index: 3;">
                            <h3 class="text-center" style="font-family: 'Times New Roman', Times, serif; margin-bottom: 20px; margin-top: 0; font-weight: bold;"><?= strtoupper($rowData['type']) ?></h3>
                            <p style="margin-bottom: 10px;">TO WHOM IT MAY CONCERN:</p>
                            <p style="font-size: 18px; text-indent: 30px;">This is to certify that <u><?= strtoupper($rowData['full_name']) ?></u> is a resident of <u><?= strtoupper($rowData['address']) ?> BARANGAY BUROL III, CITY OF DASMARINAS, CAVITE</u> since <u><?= strtoupper($rowData['year_residency']) ?></u> up to present.</p>
                            <p style="font-size: 18px; text-indent: 30px;">He/She is not a registered voter of this barangay.</p>
                            <p style="font-size: 18px; text-indent: 30px;">This certification is issued upon the request of the said person for <u><?= strtoupper($rowData['purpose']) ?></u> purpose/s only.</p>
                            <?= $formatted_date; ?>
                            <div style="display: flex; align-items: center; justify-content: space-around; gap: 20px; margin-top: 100px;">
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 5px;">
                                        <div style="width: 80px; height: 100px; border: 1px solid black; background-color: white;"></div>
                                        <p style="margin: 0 !important; font-size: 10px;">LEFT THUMBMARK</p>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 5px;">
                                        <div style="width: 80px; height: 100px; border: 1px solid black; background-color: white;"></div>
                                        <p style="margin: 0 !important; font-size: 10px;">RIGHT THUMBMARK</p>
                                    </div>
                                </div>
                                <div>
                                    <div style="width: 200px; height: 1px; background-color: black; margin-bottom: 5px;"></div>
                                    <p class="text-center">Resident's Signature</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-around; gap: 20px; margin-top: 100px;">
                                <div style="border: 1px solid black; padding: 5px 10px;">
                                    <p style="font-size: 10px; font-weight: bold; margin: 0 !important;">*NOT VALID WITHOUT OFFICIAL SEAL</p>
                                    <p style="font-size: 10px; margin: 0 !important;">*VALIDITY of this DOCUMENT:</p>
                                    <p style="font-size: 10px; margin: 0 !important;">3 months after the date of issuance</p>
                                </div>
                                <div class="text-center">
                                    <p style="font-size: 20px; font-weight: bold; margin: 0 !important;">ALMA M. LAPNO</p>
                                    <P>PUNONG BARANGAY</P>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success noprint" id="printpagebutton" onclick="PrintElem('#clearance')">Print</button>
            </div>
        </div>

        <!-- jQuery 2.0.2 -->
    <?php }
    ?>
    <script>
        function PrintElem(elem) {
            window.print();
        }

        function Popup(data) {
            var mywindow = window.open('', 'my div', 'height=400,width=600');
            //mywindow.document.write('<html><head><title>my div</title>');
            /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            //mywindow.document.write('</head><body class="skin-black" >');
            var printButton = document.getElementById("printpagebutton");
            //Set the print button visibility to 'hidden' 
            printButton.style.visibility = 'hidden';
            mywindow.document.write(data);
            //mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10

            mywindow.print();

            printButton.style.visibility = 'visible';
            mywindow.close();

            return true;
        }
    </script>
    </body>



</html>