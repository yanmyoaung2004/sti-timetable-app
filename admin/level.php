<?php
include "includes/header.php";
include "includes/sidebar.php";

// ---------------- Handle DELETE ----------------
if (isset($_GET['delete_level_id'])) {
    $delete_id = intval($_GET['delete_level_id']);
    if ($dept->delete_level($delete_id)) {
        $message = '<div class="alert alert-success">Level Deleted Successfully</div>';
    } else {
        $message = '<div class="alert alert-danger">Failed to Delete Level</div>';
    }
}

// ---------------- Handle EDIT mode ----------------
$edit_mode = false;
$edit_level = null;

if (isset($_GET['edit_level_id'])) {
    $edit_id = intval($_GET['edit_level_id']);
    $edit_level = $dept->get_level_by_id($edit_id); // You must define this method in dept.class.php
    if ($edit_level) {
        $edit_mode = true;
    }
}

// ---------------- Handle ADD or UPDATE ----------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $level = trim($_POST['level']);

    if (isset($_POST['add_level'])) {
        if ($dept->add_level($level)) {
            $message = '<div class="alert alert-success">Level Added</div>';
        } else {
            $message = '<div class="alert alert-danger">Level Cannot Be Added</div>';
        }
    }

    if (isset($_POST['update_level']) && isset($_POST['level_id'])) {
        $level_id = intval($_POST['level_id']);
        if ($dept->update_level($level_id, $level)) {
            $message = '<div class="alert alert-success">Level Updated</div>';
            $edit_mode = false;
        } else {
            $message = '<div class="alert alert-danger">Level Update Failed</div>';
        }
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
                            <h4 class="page-title">Add/Modify Level</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add/Modify Level</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form & Table Row -->
            <div class="row">
                <!-- Left Column: Form -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <?= isset($message) ? $message : '' ?>
                            <form method="post" action="">
                                <input type="hidden" name="level_id" value="<?= $edit_mode ? $edit_level->level_id : '' ?>">
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" class="form-control" name="level" placeholder="Enter Level" value="<?= $edit_mode ? htmlspecialchars($edit_level->level) : '' ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <?php if ($edit_mode): ?>
                                        <button type="submit" name="update_level" class="btn btn-warning btn-block rounded-0">Update Level</button>
                                    <?php else: ?>
                                        <button type="submit" name="add_level" class="btn btn-info btn-block rounded-0">Add Level</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Levels Table -->
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatable" class="table table-bordered table-hover dt-responsive nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Level</th>
                                            <th style="white-space: nowrap;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $levels = $dept->list_level();
                                        foreach ($levels as $lvl):
                                        ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= htmlspecialchars($lvl->level) ?></td>
                                            <td>
                                                <a href="?edit_level_id=<?= $lvl->level_id ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="?delete_level_id=<?= $lvl->level_id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this level?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content-page -->

<?php include "includes/footer.php"; ?>
 
