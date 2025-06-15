<?php
include "includes/header.php";
include "includes/sidebar.php";

// Handle delete request
if (isset($_GET['delete_level_id'])) {
    $delete_id = intval($_GET['delete_level_id']);
    if ($dept->delete_level($delete_id)) {
        echo '<div class="alert alert-success">Level Deleted Successfully</div>';
    } else {
        echo '<div class="alert alert-danger">Failed to Delete Level</div>';
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Add/Modify Level</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form & Table Row -->
            <div class="row">
                <!-- Left Column: Add Level Form -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="">
                                <?php
                                    if (isset($_POST['add_level'])) {
                                        $level = trim($_POST['level']);
                                        if ($dept->add_level($level)) {
                                            echo '<div class="alert alert-success">Level Added</div>';
                                        } else {
                                            echo '<div class="alert alert-danger">Level Cannot Be Added</div>';
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" class="form-control" name="level" placeholder="Level" required>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-info btn-block rounded-0" name="add_level">
                                        Add Level
                                    </button>
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
                                        $list_level = $dept->list_level();
                                        foreach ($list_level as $level_item) {
                                        ?>
                                        <tr>
                                            <td><?php echo ++$count; ?></td>
                                            <td><?php echo htmlspecialchars($level_item->level); ?></td>
                                            <td style="white-space: nowrap;">
                                                <a href="?delete_level_id=<?php echo $level_item->level_id; ?>" 
                                                   class="btn btn-sm btn-outline-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this level?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content-page -->

<?php include "includes/footer.php"; ?>
