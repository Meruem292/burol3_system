<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Archives</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library (required for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <?php
    session_start();
    if (!isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }
    include('main_style.php');
    ?>
</head>
<body class="skin-black">
    <?php
    include "db.php";
    include "functions.php";
    include "header.php";
    ?>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php include('sidebar.php'); ?>

        <aside class="right-side">
            <section class="content-header">
                <h1>All Archives</h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;"></div>
                        </div>

                        <div class="box-body table-responsive">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#residents" data-toggle="tab">Residents</a></li>
                                <li><a href="#documents" data-toggle="tab">Documents</a></li>
                                <li><a href="#transactions" data-toggle="tab">Transactions</a></li>
                                <li><a href="#blotters" data-toggle="tab">Blotters</a></li>
                                <li><a href="#logs" data-toggle="tab">Logs</a></li>
                                <li><a href="#voters" data-toggle="tab">Voters</a></li>
                                <li><a href="#indigents" data-toggle="tab">Indigents</a></li>
                            </ul>

                            <div class="tab-content">
                                <!-- Residents -->
                                <div class="tab-pane active in" id="residents" role="tabpanel">
                                    <?php
                                    $user_columns = ['id', 'full_name', 'age', 'email', 'mobile_number', 'gender', 'village', 'phase', 'blk', 'street', 'nationality', 'state', 'district', 'status'];
                                    displayTable($pdo, 'user', $user_columns);
                                    ?>
                                </div>

                                <!-- Documents -->
                                <div class="tab-pane" id="documents" role="tabpanel">
                                    <?php
                                    $documents_columns = ['id', 'tracking_number', 'full_name', 'address', 'age', 'pickup_date', 'pickup_time', 'year_residency', 'purpose', 'category', 'note', 'type', 'status', 'control_number', 'date_added', 'delivery_mode', 'amount_to_prepare'];
                                    displayTable($pdo, 'documents', $documents_columns);
                                    ?>
                                </div>

                                <!-- Transactions -->
                                <div class="tab-pane" id="transactions" role="tabpanel">
                                    <?php
                                    
                                    $payment_methods_columns = ['id', 'document_id'];
                                    displayTable($pdo, 'payment_receipts', $payment_methods_columns);
                                    ?>
                                </div>

                                <!-- Blotters -->
                                <div class="tab-pane" id="blotters" role="tabpanel">
                                    <?php
                                    $blotter_columns = ['id', 'date', 'time', 'incident_type', 'description', 'reporter_name', 'accused_name', 'status', 'created_at'];
                                    displayTable($pdo, 'blotter', $blotter_columns);
                                    ?>
                                </div>

                                <!-- Logs -->
                                <div class="tab-pane" id="logs" role="tabpanel">
                                    <?php
                                    $logs_columns = ['id', 'user', 'date_log', 'action', 'details'];
                                    displayTable($pdo, 'logs', $logs_columns);
                                    ?>
                                </div>

                                <!-- Voters -->
                                <div class="tab-pane" id="voters" role="tabpanel">
                                    <?php
                                    $voters_columns = ['id', 'full_name', 'age', 'address', 'contact_number', 'status', 'created_at'];
                                    displayTable($pdo, 'voters', $voters_columns);
                                    ?>
                                </div>

                                <!-- Indigents -->
                                <div class="tab-pane" id="indigents" role="tabpanel">
                                    <?php
                                    $indigents_columns = ['id', 'full_name', 'age', 'address', 'contact_number', 'created_at'];
                                    displayTable($pdo, 'indigents', $indigents_columns);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </div>

    <?php include "footer.php"; ?>

    <script>
        $(document).ready(function() {
            $('#myTab a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
</body>
</html>
