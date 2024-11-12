
<div class="modal fade" id="approveModal' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Approve Document Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve the document request for <strong>' . htmlspecialchars($row['full_name']) . '</strong>?
            </div>
            <div class="modal-footer">
                <form action="approve_document.php" method="POST">
                    <input type="hidden" name="document_id" value="' . $row['document_id'] . '">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="disapproveModal' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="disapproveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disapproveModalLabel">Disapprove Document Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to disapprove the document request for <strong>' . htmlspecialchars($row['full_name']) . '</strong>?
            </div>
            <div class="modal-footer">
                <form action="disapprove_document.php" method="POST">
                    <input type="hidden" name="document_id" value="' . $row['document_id'] . '">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Disapprove</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Document Request Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Tracking Number:</strong> ' . htmlspecialchars($row['tracking_number']) . '</p>
                <p><strong>Requestors Name:</strong> ' . htmlspecialchars($row['full_name']) . '</p>
                <p><strong>Address:</strong> ' . htmlspecialchars($row['address']) . '</p>
                <p><strong>Age:</strong> ' . htmlspecialchars($row['age']) . '</p>
                <p><strong>Years of Residency:</strong> ' . htmlspecialchars($row['year_residency']) . '</p>
                <p><strong>Purpose:</strong> ' . htmlspecialchars($row['purpose']) . '</p>
                <p><strong>Notes:</strong> ' . htmlspecialchars($row['note']) . '</p>
                <p><strong>Document Type:</strong> ' . htmlspecialchars($row['type']) . '</p>
                <p><strong>Control Number:</strong> ' . htmlspecialchars($row['control_number']) . '</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>