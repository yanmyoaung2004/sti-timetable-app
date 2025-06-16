<?php
include "includes/header.php";
include "includes/sidebar.php";
?>

<!-- Start Page Content here -->

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Add/Modify Department</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add/Modify Department</h4>
                    </div>
                </div>
            </div>     
            <!-- End Page Title -->

            <div class="row">
                <div class="col-md-12">
                    <!-- List Card -->
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <i class="fa-solid fa-list"></i> Existing Departments
                        </div>
                        <div class="card-body">
                            <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><i class="fa-solid fa-hashtag"></i> S/N</th>
                                        <th><i class="fa-solid fa-building"></i> Department</th>
                                        <th><i class="fa-solid fa-gear"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $list_dept = $dept->list_dept();
                                    foreach ($list_dept as $list_dept) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$count ?></td>
                                            <td class="text-center"><?php echo $list_dept->dept_title ?></td>
                                            <td class="text-center">
                                                <a href="includes/delete_dept.php?dept_id=<?php echo $list_dept->dept_id ?>" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <!-- Add Button -->
                            <div class="text-end mt-3">
                                <button class="btn btn-soft-blue" data-bs-toggle="modal" data-bs-target="#addDeptModal">
                                    <i class="fa-solid fa-plus"></i> Add Department
                                </button>
                            </div>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->

</div> <!-- content-page -->

<!-- Department Modal -->
<div class="modal fade" id="addDeptModal" tabindex="-1" aria-labelledby="addDeptLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin-top: 8vh;">

    <div class="modal-content border-0 shadow-lg rounded-3" style="background: #f9fbff;">
      <div class="modal-header bg-primary text-white rounded-top">
        <h5 class="modal-title" id="addDeptLabel">
          <i class="fa-solid fa-building-columns me-2"></i> Add New Department
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body px-4 py-3">
        <form method="post" action="">
          <div class="mb-3">
            <label for="department" class="form-label">
              <i class="fa-solid fa-pen-to-square me-1"></i> Department Title
            </label>
            <input type="text" class="form-control border-primary rounded-2" name="department" id="department" placeholder="e.g. Computer Science" required>
          </div>

          <div class="text-end">
            <button type="submit" name="add_time" class="btn btn-primary">
              <i class="fa-solid fa-plus-circle me-1"></i> Add Department
            </button>
            <?php
if (isset($_POST['add_time'])) {
    $dept_title = $_POST['department'];
    if ($dept->add_dept($dept_title)) {
        echo '<div class="alert alert-success">Department Added</div>';
    } else {
        echo '<div class="alert alert-danger">Department Cannot Be Added</div>';
    }
}
?>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include "includes/footer.php"; ?>

<style>
    .modal-content {
  transition: transform 0.3s ease-in-out;
}
.modal-header {
  border-bottom: none;
}
.modal-body {
  background: #ffffff;
}

.btn-primary {
  background-color: #3b7ddd;
  border: none;
}
.btn-primary:hover {
  background-color: #2c6ecb;
}

.btn-soft-blue {
    background-color: #3b7ddd;
    color: white;
    border: none;
    border-radius: 20px;
  }

  .btn-soft-blue:hover {
    background-color: #2c6ecb;
    color: wheat;
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
