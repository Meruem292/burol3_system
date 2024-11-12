<?php

function getPendingDocumentsCount($pdo)
{
    $sql = "SELECT COUNT(*) FROM documents WHERE status = :status";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':status' => 'pending']);
    return $stmt->fetchColumn();
}
function getPendingResidentsCount($pdo)
{
    $sql = "SELECT COUNT(*) FROM user WHERE status = :status";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':status' => 'pending']);
    return $stmt->fetchColumn();
}

function getPendingBlotterCount($pdo)
{
    $sql = "SELECT COUNT(*) FROM blotter WHERE status = :status";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':status' => 'pending']);
    return $stmt->fetchColumn();
}


$pendingDocumentCount = getPendingDocumentsCount($pdo);
$pendingResidentCount = getPendingResidentsCount($pdo);
$PendingBlotterCount = getPendingBlotterCount($pdo);

?>


<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">

            <div class="pull-left info">
                <h4> &nbsp;&nbsp;Barangay Burol III</h4>

            </div>
        </div>


        <ul class="sidebar-menu">
            <li>
                <a href="index.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="officials.php">
                    <i class="fa fa-user"></i> <span>Barangay Officials</span>
                </a>
            </li>
            <li>
                <a href="resident.php">
                    <i class="fa fa-users"></i> <span>Resident</span>
                    <?php if ($pendingResidentCount > 0): ?>
                        <span class="badge"><?php echo $pendingResidentCount; ?></span>
                    <?php endif; ?>
                </a>
            </li>

            <li>
                <a href="documents.php">
                    <i class="fa fa-folder"></i> <span>Documents</span>
                    <?php if ($pendingDocumentCount > 0): ?>
                        <span class="badge"><?php echo $pendingDocumentCount; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="transactions.php">
                    <i class="fa fa-exchange"></i> <span>Transactions</span>
                </a>
            </li>
            <li>
                <a href="blotter.php">
                    <i class="fa fa-file"></i> <span>Blotter</span>
                    <?php if ($PendingBlotterCount > 0): ?>
                        <span class="badge"><?php echo $PendingBlotterCount; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="activity.php">
                    <i class="fa fa-calendar"></i> <span>Announcement</span>
                </a>
            </li>
            <li>
                <a href="logs.php">
                    <i class="fa fa-history"></i> <span>Logs</span>
                </a>
            </li>
            <li>
                <a href="voters.php">
                    <i class="fa fa-users"></i> <span>Voters</span>
                </a>
            </li>
            <li>
                <a href="indigents.php">
                    <i class="fa fa-user"></i> <span>Indigents</span>
                </a>
            </li>


        </ul>

    </section>
    <!-- /.sidebar -->
</aside>