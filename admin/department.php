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
                            <!-- List Table -->
                            <div id="listhere"></div>

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

<!-- Add Department Modal -->
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
            <button type="button" id="submit" name="add-dept" class="btn btn-soft-blue">
              <i class="fa-solid fa-plus-circle me-1"></i> Add Department
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="editDeptModal" tabindex="-1" aria-labelledby="editDeptLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin-top: 8vh;">
    <div class="modal-content border-0 shadow-lg rounded-3" style="background: #f9fbff;">
      <div class="modal-header bg-primary text-white rounded-top">
        <h5 class="modal-title" id="editDeptLabel">
          <i class="fa-solid fa-edit me-2"></i> Edit Department
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 py-3">
        <form method="post" action="">
          <input type="hidden" id="edit_dept_id" name="dept_id">
          <div class="mb-3">
            <label for="edit_department" class="form-label">
              <i class="fa-solid fa-pen-to-square me-1"></i> Department Title
            </label>
            <input type="text" class="form-control border-primary rounded-2" name="department" id="edit_department" placeholder="e.g. Computer Science" required>
          </div>
          <div class="text-end">
            <button type="button" id="update" name="update-dept" class="btn btn-soft-blue">
              <i class="fa-solid fa-save me-1"></i> Update Department
            </button>
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
        background: #f9fbff;
        border-radius: 1rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
        background-color: #3b7ddd;
        color: white;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        border-bottom: none;
    }
    .modal-header .btn-close {
        filter: invert(1);
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
    .btn-primary {
        background-color: #3b7ddd;
        border: none;
    }
    .btn-primary:hover {
        background-color: #2c6ecb;
    }
    .form-control:focus {
        border-color: #3b7ddd;
        box-shadow: 0 0 0 0.2rem rgba(59, 125, 221, 0.25);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<script src="https://cdn.jquery.com/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AJAX Script -->
<script type="text/javascript">
$(function(){
    function ListTable(){
        $.ajax({
            url: 'includes/list_dept.php',
            type: 'GET',
            success:function(data){
                var count = 1;
                var obj = $.parseJSON(data);      
                var result = "<table id='basic-datatable' class='table table-striped table-bordered dt-responsive nowrap text-center'>"
                    + "<thead class='thead-dark'><tr>"
                    + "<th><i class='fa-solid fa-hashtag'></i> S/N</th>"
                    + "<th><i class='fa-solid fa-building'></i> Department</th>"
                    + "<th><i class='fa-solid fa-gear'></i> Action</th>"
                    + "</tr></thead><tbody>";

                $.each(obj, function() {
                    result += "<tr><td>" + count++ + "</td><td>" + this['dept_title'] + "</td><td>"
                        + "<button class='btn btn-primary btn-sm edit-dept' data-id='" + this['dept_id'] + "' data-title='" + this['dept_title'] + "' data-bs-toggle='modal' data-bs-target='#editDeptModal'><i class='fa fa-edit'></i> Edit</button> "
                        + "<button class='btn btn-danger btn-sm delete-dept' data-id='" + this['dept_id'] + "'><i class='fa fa-trash'></i> Delete</button></td></tr>";
                });
                result += "</tbody></table>";
                $("#listhere").html(result);
            }
        });
    }

    $('#submit').click(function(){
        var dept_title = $('#department').val();
        if(dept_title.trim() !== ""){
            $.ajax({
                url: 'includes/add_dept.php',
                type: 'POST',
                data: { department: dept_title },
                success:function(data){
                    if(data == 1){
                        $('#department').val('');
                        $('#addDeptModal').modal('hide');
                        ListTable();
                        window.showToast('Department added successfully', 'success');
                    } else {
                        window.showToast('Failed to add department', 'error');
                    }
                }
            });
        } else {
            window.showToast('Please fill in the department title', 'error');
        }
    });

    $(document).on('click', '.edit-dept', function(){
        var dept_id = $(this).data('id');
        var dept_title = $(this).data('title');
        
        $('#edit_dept_id').val(dept_id);
        $('#edit_department').val(dept_title);
    });

    $('#update').click(function(){
        var dept_id = $('#edit_dept_id').val();
        var dept_title = $('#edit_department').val();
        
        if(dept_title.trim() !== ""){
            $.ajax({
                url: 'includes/update_dept.php',
                type: 'POST',
                data: { dept_id: dept_id, department: dept_title },
                success:function(data){
                    if(data == 1){
                        $('#editDeptModal').modal('hide');
                        ListTable();
                        window.showToast('Department updated successfully', 'success');
                    } else {
                        window.showToast('Failed to update department', 'error');
                    }
                }
            });
        } else {
            window.showToast('Please fill in the department title', 'error');
        }
    });

    $(document).on('click', '.delete-dept', function(){
        var dept_id = $(this).data('id');
        if(confirm('Are you sure you want to delete this department?')){
            $.ajax({
                url: 'includes/delete_dept.php',
                type: 'GET',
                data: { dept_id: dept_id },
                success:function(data){
                    var response = $.parseJSON(data);
                    if(response.success){
                        ListTable();
                        window.showToast('Department deleted successfully', 'success');
                    } else {
                        window.showToast('Failed to delete department', 'error');
                    }
                }
            });
        }
    });

    ListTable();
    window.setInterval(ListTable, 5000);
});
</script>