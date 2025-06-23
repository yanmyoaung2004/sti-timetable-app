<?php
include "includes/header.php";
include "includes/sidebar.php";

// ---------------- Handle Update ----------------
if (isset($_POST['update_student'])) {
    $id = $_POST['student_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($student->update_student($id, $firstname, $lastname, $username, $email, $phone)) {
        $message = '<div class="alert alert-success">Student updated successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger">Update failed.</div>';
    }
}

// ---------------- Edit Mode ----------------
$editing = false;
$edit_data = null;
if (isset($_GET['edit'])) {
    $edit_data = $student->get_student_by_id($_GET['edit']);
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
                            <h4 class="page-title"><?= $editing ? 'Edit Student' : 'View Students' ?></h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><?= $editing ? 'Edit Student' : 'View Students' ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <?php if ($editing && $edit_data): ?>
            <div class="row">
                <div class="col-lg-6 col-md-8 mb-3 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Update Student Info</h5>
                            <?= isset($message) ? $message : '' ?>
                            <form method="POST">
                                <input type="hidden" name="student_id" value="<?= $edit_data->student_id ?>">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="firstname" value="<?= htmlspecialchars($edit_data->student_firstname) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lastname" value="<?= htmlspecialchars($edit_data->student_lastname) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($edit_data->student_matricno) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($edit_data->student_email) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($edit_data->student_phone) ?>" required>
                                </div>
                                <div class="form-group mt-3 d-flex justify-content-between">
                                    <button type="submit" name="update_student" class="btn btn-warning">Update</button>
                                    <a href="viewstudent.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif (isset($message)): ?>
            <div class="row">
                <div class="col-12">
                    <?= $message ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Students Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="mb-3">All Students</h5>
                            <div class="table-responsive">
                                <table id="basic-datatable" class="table table-bordered table-hover dt-responsive nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S/N</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $stu = $student->list_student();
                                        foreach ($stu as $row): ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= htmlspecialchars($row->student_firstname) ?></td>
                                            <td><?= htmlspecialchars($row->student_lastname) ?></td>
                                            <td><?= htmlspecialchars($row->student_matricno) ?></td>
                                            <td><?= htmlspecialchars($row->student_email) ?></td>
                                            <td><?= htmlspecialchars($row->student_phone) ?></td>
                                            <td>
                                                <a href="?edit=<?= $row->student_id ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="includes/delete_student.php?student_id=<?= $row->student_id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
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

<?php include "includes/footer.php"; ?>
