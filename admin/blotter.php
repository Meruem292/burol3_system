<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit(); // Ensure script stops after redirect
}

ob_start();
include('main_style.php');
include('db.php'); // Ensure database connection is established here
?>

<body class="skin-black">
    <?php include('header.php'); ?>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php include('sidebar.php'); ?>

        <aside class="right-side">
            <section class="content-header">
                <h1>Blotter</h1>
            </section>

            <section class="content">
                <div class="box">
                    <div class="box-header">
                        <div style="padding:10px;">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBlotterModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Blotter Entry</button>
                        </div>
                    </div>

                    <div class="box-body">
                        <form method="post">
                            <table id="blotterTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Incident Type</th>
                                        <th>Description</th>
                                        <th>Reporter</th>
                                        <th>Accused</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th style="width: 130px;">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch blotter entries from the database
                                    $squery = $pdo->query("SELECT * FROM blotter ORDER BY created_at DESC");
                                    while ($row = $squery->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                            <tr>
                                                <td>' . $row['id'] . '</td>
                                                <td>' . $row['date'] . '</td>
                                                <td>' . $row['time'] . '</td>
                                                <td>' . $row['incident_type'] . '</td>
                                                <td>' . $row['description'] . '</td>
                                                <td>' . $row['reporter_name'] . '</td>
                                                <td>' . $row['accused_name'] . '</td>
                                                <td>' . $row['status'] . '</td>
                                                <td>' . $row['created_at'] . '</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-target="#editModalBlotter' . $row['id'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                </td>   
                                            </tr>';
                                        include "modals/edit_modal_blotter.php";
                                        include "modals/delete_modal_blotter.php";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </section>
        </aside>
    </div>

    <style>
        #suggestion-box {
            background: #fff;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            width: calc(100% - 30px);
            /* Adjust to match the input field */
            position: absolute;
            /* Position it relative to the input field */
            z-index: 1000;
            /* Ensure it's on top of other elements */
        }

        .suggestion-item {
            padding: 5px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>


    <!-- Include Modals -->
    <?php
    include "modals/add_modal_blotter.php";
    include "modals/edit_modal_blotter.php";
    include "modals/delete_modal_blotter.php";
    include "functions.php";
    ?>

    <!-- jQuery and DataTables initialization -->
    <?php include "footer.php"; ?>
    <script type="text/javascript">
        $(function() {
            $("#blotterTable").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [9]
                }],
                "aaSorting": []
            });
        });

        $(document).ready(function() {
            // When typing in the input field
            $("#add_reporter_name").on("keyup", function() {
                let query = $(this).val();

                if (query.length > 0) { // Trigger search only when 3 or more characters are entered
                    $.ajax({
                        url: 'fetch_users.php', // Target PHP file
                        method: 'GET', // Request method
                        data: {
                            query: query // Pass the input value as 'query'
                        },
                        success: function(data) {
                            // Parse the JSON response from PHP
                            let users = JSON.parse(data);
                            let suggestions = '';

                            // Check if users are returned
                            if (users.length > 0) {
                                // Loop through users and create suggestion elements
                                users.forEach(user => {
                                    suggestions += `<div class="suggestion-item">${user.full_name}</div>`;
                                });
                            } else {
                                // If no matches found, show a 'No matches found' message
                                suggestions = '<div style="padding: 5px;">No matches found</div>';
                            }

                            // Display suggestions in the suggestion-box div
                            $("#suggestion-box").html(suggestions);
                        }
                    });
                } else {
                    // Clear suggestions when input has fewer than 3 characters
                    $("#suggestion-box").html('');
                }
            });

            // Handle when a suggestion is clicked
            $(document).on("click", ".suggestion-item", function() {
                $("#add_reporter_name").val($(this).text()); // Set the clicked suggestion as input value
                $("#suggestion-box").html(''); // Clear the suggestion box
            });

            // Clear suggestions when the input field loses focus
            $("#add_reporter_name").on("blur", function() {
                setTimeout(() => { // Use timeout to allow click event to register
                    $("#suggestion-box").html('');
                }, 100);
            });

            // Optionally clear suggestions when the form is submitted
            $("form").on("submit", function() {
                $("#suggestion-box").html('');
            });
        });
    </script>

</body>

</html>