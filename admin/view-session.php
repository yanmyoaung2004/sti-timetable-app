<?php
include "includes/header.php";
include "includes/sidebar.php";

if (isset($_POST['update_session'])) {
    $id = $_POST['session_id'];
    $session_year = $_POST['session_year'];

    if ($session->update_session($id, $session_year)) {
        $message = '<div class="alert alert-success">Session updated successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger">Update failed.</div>';
    }
}

if (isset($_POST['add_session'])) {
    $session_year = $_POST['session_year'];

    if ($session->add_session($session_year)) {
        $message = '<div class="alert alert-success">Session added successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger">Add failed.</div>';
    }
}

$editing = false;
$edit_data = null;
if (isset($_GET['edit'])) {
    $edit_data = $session->get_session_by_id($_GET['edit']);
    if ($edit_data) {
        $editing = true;
    }
}
?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h4 class="page-title"><?= $editing ? 'Edit Session' : 'View Sessions' ?></h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><?= $editing ? 'Edit Session' : 'View Sessions' ?>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sessions Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="d-flex justify-content-end align-items-center gap-2 mt-2 mr-3">
                            <button class="btn btn-success rounded mr-2" data-bs-toggle="modal"
                                data-bs-target="#sessionModal" onclick="openAddModal()">
                                <i class="fa fa-plus-circle"></i> Add New Session
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-3">All Sessions</h5>
                            <div class="table-responsive">
                                <table id="session-datatable"
                                    class="table table-bordered table-hover dt-responsive nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Session Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $sessionList = $session->list_session();
                                        foreach ($sessionList as $sess) {
                                            $sessionJson = htmlspecialchars(json_encode([
                                                'session_id' => $sess->session_id,
                                                'session_year' => $sess->session_year
                                            ]), ENT_QUOTES, 'UTF-8');
                                        ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= htmlspecialchars($sess->session_year) ?></td>
                                            <td>
                                                <button class="btn btn-primary" onclick="handleEditModal(this)"
                                                    data-session='<?= $sessionJson ?>'>
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <a href="includes/delete_session.php?session_id=<?= $sess->session_id ?>"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this session?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- card-body -->
                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->

        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content-page -->

<!-- Session Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">Add New Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="sessionForm" method="POST" action="">
                <input type="hidden" name="session_id" id="session_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="session_year" class="form-label">Session Year</label>
                        <input type="text" class="form-control" name="session_year" id="session_year" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="" id="submitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function handleEditModal(button) {
    const session = JSON.parse(button.getAttribute('data-session'));
    openEditModal(session);
}

function openAddModal() {
    document.getElementById("sessionModalLabel").innerText = "Add New Session";
    const form = document.getElementById("sessionForm");
    form.action = ""; // current page
    form.reset();
    document.getElementById("session_id").value = "";
    document.getElementById("submitBtn").name = "add_session";
    document.getElementById("submitBtn").innerText = "Add";
}

function openEditModal(session) {
    let modal = new bootstrap.Modal(document.getElementById('sessionModal'));
    modal.show();
    document.getElementById("sessionModalLabel").innerText = "Edit Session";
    const form = document.getElementById("sessionForm");
    form.action = ""; // current page
    document.getElementById("session_id").value = session.session_id;
    document.getElementById("session_year").value = session.session_year;
    document.getElementById("submitBtn").name = "update_session";
    document.getElementById("submitBtn").innerText = "Update";
}
</script>

<?php include "includes/footer.php"; ?>