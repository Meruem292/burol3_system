<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

include "db.php";
$documentId = $_GET['clearance'] ?? null;
$deliveryMode = $_GET['delivery_mode'] ?? '';

if ($documentId) {
    $newCategory = ($deliveryMode === 'delivery') ? 'for delivery' : (($deliveryMode === 'pick-up') ? 'for pick-up' : '');
    if ($newCategory) {
        $updateQuery = $pdo->prepare("UPDATE documents SET category = :category WHERE id = :id");
        $updateQuery->execute(['category' => $newCategory, 'id' => $documentId]);
    }

    $documentQuery = $pdo->prepare("SELECT * FROM documents WHERE id = :id");
    $documentQuery->execute(['id' => $documentId]);
    $documentData = $documentQuery->fetch(PDO::FETCH_ASSOC);

    $officialsQuery = $pdo->query("SELECT * FROM officials");
}
?>
<!DOCTYPE html>
<html lang="en" id="clearance">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Barangay Clearance</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .page-container {
            width: 210mm;
            /* A4 width */
            height: 297mm;
            /* A4 height */
            padding: 20px;
            box-sizing: border-box;
            margin: 0 auto;
            position: relative;
        }

        .header-img img {
            max-width: 100%;
            height: auto;
        }

        .clearance-content {
            display: flex;
            flex-direction: row;
            gap: 10px;
            background-color: #01aefd;
            padding: 20px;
            height: calc(100% - 60px);
            /* Ensures the content fits inside the page container */
            box-sizing: border-box;
        }

        .officials-section {
            flex: 1;
            background-color: white;
            padding: 20px;
        }

        .document-section {
            flex: 2;
            position: relative;
            background-color: white;
            padding: 20px;
        }

        .document-section img {
            position: absolute;
            opacity: 0.1;
            width: 80%;
            height: auto;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .document-content {
            position: relative;
            z-index: 2;
        }

        .signature-section,
        .thumb-section {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .thumb-box {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .thumb-box div {
            width: 80px;
            height: 100px;
            border: 1px solid black;
            background-color: white;
        }

        .text-center {
            text-align: center;
        }

        .print-note {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
        }

        .action-buttons {
            position: absolute;
            /* Place the buttons below the page */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            /* Layer above other elements */
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 0;
            /* Avoid additional margins */
        }

        .btn-print {
            background-color: #4CAF50;
            color: white;
        }

        .btn-close {
            background-color: #f44336;
            color: white;
        }

        .signature-section {
            display: flex;
            justify-content: space-around;
            margin-top: 130px;
            /* Increased margin to push it 100px lower */
        }



        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .noprint,
            .action-buttons {
                display: none;
            }

            .page-container {
                width: 210mm;
                height: 277mm;
                padding: 20px;
                box-sizing: border-box;
            }

            .clearance-content {
                background-color: #01aefd !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            @page {
                size: A4;
                /* Sets A4 size explicitly */
                margin: 0;
                /* Removes default page margins */
            }
        }
    </style>
</head>

<body>
    <div class="page-container">
        <div class="header-img">
            <img src="assets/img/header.png" alt="Header Image">
        </div>

        <div class="clearance-content">
            <!-- Officials Section -->
            <div class="officials-section">
                <h3 class="text-center">Barangay Officials</h3>
                <?php while ($official = $officialsQuery->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="text-center">
                        <h5><?= strtoupper($official['full_name']) ?></h5>
                        <p><?= strtoupper($official['position']) ?></p>
                    </div>
                <?php endwhile; ?>
                <div class="text-center" style="margin-top: 50px;">
                    <p>Control No.: <u><?= $documentData['control_number'] ?? '' ?></u></p>
                </div>
            </div>

            <!-- Document Section -->
            <div class="document-section">
                <img src="assets/img/logo.png" alt="Barangay Logo">
                <div class="document-content">
                    <h3 class="text-center"><?= strtoupper($documentData['type'] ?? '') ?></h3>
                    <p>TO WHOM IT MAY CONCERN:</p>
                    <p>This is to certify that <u><?= strtoupper($documentData['full_name'] ?? '') ?></u> is a resident of <u><?= strtoupper($documentData['address'] ?? '') ?></u> since <u><?= strtoupper($documentData['year_residency'] ?? '') ?></u> up to present.</p>
                    <p>He/She is not a registered voter of this barangay.</p>
                    <p>This certification is issued upon the request of the said person for <u><?= strtoupper($documentData['purpose'] ?? '') ?></u> purpose/s only.</p>
                    <p>Issued this <u><?= date('jS') ?></u> day of <u><?= date('F') ?></u>, <?= date('Y') ?>.</p>
                </div>

                <!-- Signature Section -->
                <div class="signature-section">
                    <div class="thumb-box">
                        <div></div>
                        <p>LEFT THUMBMARK</p>
                    </div>
                    <div class="thumb-box">
                        <div></div>
                        <p>RIGHT THUMBMARK</p>
                    </div>
                    <div class="text-center">
                        <div style="width: 200px; height: 1px; background: black;"></div>
                        <p>Resident's Signature</p>
                    </div>
                </div>

                <div class="print-note">
                    <p>*NOT VALID WITHOUT OFFICIAL SEAL</p>
                    <p>*VALIDITY: 3 months after issuance</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Action Buttons -->
    <div class="action-buttons noprint">
        <button type="button" class="btn btn-success" onclick="window.print()">Print</button>
        <button type="button" class="btn btn-danger" onclick="window.history.back()">Close</button>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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