<?php 
include "includes/header.php"; 
include "includes/sidebar.php"; 

$edit_mode = false;
$edit_time = null;

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_time = $time->get_time_by_id($edit_id);
    if ($edit_time) {
        $edit_mode = true;
    }
}

// Handle Add/Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $hour = $_POST['hour'];

    if (isset($_POST['add_time'])) {
        if ($time->add_time($start, $end, $hour)) {
            $message = '<div class="alert alert-success">Time Added Successfully</div>';
        } else {
            $message = '<div class="alert alert-danger">Failed to Add Time</div>';
        }
    }

    if (isset($_POST['update_time']) && isset($_POST['time_id'])) {
        if ($time->update_time($_POST['time_id'], $start, $end, $hour)) {
            $message = '<div class="alert alert-success">Time Updated Successfully</div>';
            $edit_mode = false;
        } else {
            $message = '<div class="alert alert-danger">Failed to Update Time</div>';
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
                            <h4 class="page-title">Add/Modify Time</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add/Modify Time</li>
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
                            <?php if (isset($message)) echo $message; ?>
                            <form method="post" action="">
                                <input type="hidden" name="time_id" value="<?= $edit_mode ? $edit_time->time_id : '' ?>">
                                <div class="form-group">
                                    <small class="text-danger">Use 24hr format. e.g., 13:00</small>
                                    <label class="mt-2">Start Time</label>
                                    <input type="text" class="form-control" name="start_time" placeholder="e.g., 09:00" value="<?= $edit_mode ? $edit_time->start_time : '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <small class="text-danger">Use 24hr format. e.g., 13:00</small>
                                    <label class="mt-2">End Time</label>
                                    <input type="text" class="form-control" name="end_time" placeholder="e.g., 11:00" value="<?= $edit_mode ? $edit_time->end_time : '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <label class="mt-2">Lecture Hour</label>
                                    <input type="number" class="form-control" name="hour" placeholder="e.g., 2" value="<?= $edit_mode ? $edit_time->hours : '' ?>" required>
                                </div>

                                <div class="form-group mt-3">
                                    <?php if ($edit_mode): ?>
                                        <button type="submit" class="btn btn-warning btn-block rounded-0" name="update_time">Update Time</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-info btn-block rounded-0" name="add_time">Add Time</button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Table -->
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatable" class="table table-bordered table-hover dt-responsive nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Lecture Hours</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $count = 0;
                                        $list = $time->list_time(); 
                                        foreach ($list as $t): ?>
                                            <tr>
                                                <td><?= ++$count ?></td>
                                                <td><?= htmlspecialchars($t->start_time) ?></td>
                                                <td><?= htmlspecialchars($t->end_time) ?></td>
                                                <td><?= htmlspecialchars($t->hours) ?></td>
                                                <td>
                                                    <a href="?edit=<?= $t->time_id ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <a href="includes/delete_time.php?time_val=<?= $t->time_id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
