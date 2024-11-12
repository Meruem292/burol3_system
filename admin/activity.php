<!-- Add SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
} else {
    ob_start();
    include('main_style.php'); 
    include('functions.php');
    ?>
   
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php
        include "db.php";
        ?>
        <?php include('header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Post an Announcement
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- left column -->
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
                                <form action="post_model.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter announcement title" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="body">Body:</label>
                                        <textarea class="form-control" name="body" id="body" rows="5" placeholder="Enter announcement body" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="picture">Picture:</label>
                                        <input type="file" class="form-control-file" name="picture" id="picture" accept="image/*" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Post Announcement</button>
                                </form>

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <table id="announcementsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Body</th>
                                            <th>Picture</th>
                                            <th>Created At</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC");
                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                        <tr>
                                            <td>' . $row['id'] . '</td>
                                            <td>' . $row['title'] . '</td>
                                            <td>' . $row['body'] . '</td>
                                            <td><img src="' . $row['picture'] . '" alt="Announcement Image" width="50"></td>
                                            <td>' . $row['created_at'] . '</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAnnouncementModal' . $row['id'] . '">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAnnouncementModal' . $row['id'] . '">Delete</button>
                                            </td>
                                        </tr>
                                        ';
                                            include "modals/edit_modal_announcements.php";
                                            include "modals/delete_modal_announcements.php";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
        <?php include "footer.php"; ?>
        <!-- jQuery 2.0.2 -->

        <!-- SweetAlert2 Popup -->
        <?php if (isset($_SESSION['message']) && isset($_SESSION['status'])) { ?>
            <script>
                Swal.fire({
                    text: "<?php echo $_SESSION['message']; ?>",
                    icon: "<?php echo $_SESSION['status']; ?>",
                });
            </script>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['status']);
        } ?>
    </body>
<?php } ?>