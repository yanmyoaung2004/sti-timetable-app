<?php
include "includes/header.php";
include "includes/sidebar.php";
?>

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
                                <li class="breadcrumb-item active">Add/Modify Venue</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add/Modify Venue</h4>
                    </div>
                </div>
            </div>     
            <!-- End Page Title -->

            <div class="row">
                <div class="col-md-12">
                    <!-- Table Card -->
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <i class="fa-solid fa-location-dot"></i> Existing Venues
                        </div>
                        <div class="card-body">
                            <!-- List Table -->
                            <div id="listhere"></div>

                            <!-- Add Button -->
                            <div class="text-end mt-3">
                                <button class="btn btn-soft-blue" data-bs-toggle="modal" data-bs-target="#addVenueModal">
                                    <i class="fa-solid fa-plus"></i> Add Venue
                                </button>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div><!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->

    <?php include "includes/footer.php"; ?>
</div> <!-- content-page -->

<!-- Add Modal -->
<div class="modal fade" id="addVenueModal" tabindex="-1" aria-labelledby="addVenueLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin-top: 8vh;">
    <div class="modal-content border-0 shadow-lg rounded-3" style="background: #f9fbff;">
      <div class="modal-header bg-primary text-white rounded-top">
        <h5 class="modal-title" id="addVenueLabel">
          <i class="fa-solid fa-door-open me-2"></i> Add New Venue
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body px-4 py-3">
        <form method="post" action="">
          <div class="mb-3">
            <label for="room_title" class="form-label">
              <i class="fa-solid fa-door-closed me-1"></i> Venue Title
            </label>
            <input type="text" class="form-control border-primary rounded-2" name="room_title" id="room_title" placeholder="e.g. Lecture Hall A" required>
          </div>

          <div class="mb-3">
            <label for="room_capacity" class="form-label">
              <i class="fa-solid fa-users me-1"></i> Capacity
            </label>
            <input type="number" class="form-control border-primary rounded-2" name="room_capacity" id="room_capacity" placeholder="e.g. 120" required>
          </div>

          <div class="text-end">
            <button type="button" id="submit" name="add-venue" class="btn btn-soft-blue">
              <i class="fa-solid fa-plus-circle me-1"></i> Add Venue
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editVenueModal" tabindex="-1" aria-labelledby="editVenueLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin-top: 8vh;">
    <div class="modal-content border-0 shadow-lg rounded-3" style="background: #f9fbff;">
      <div class="modal-header bg-primary text-white rounded-top">
        <h5 class="modal-title" id="editVenueLabel">
          <i class="fa-solid fa-edit me-2"></i> Edit Venue
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body px-4 py-3">
        <form method="post" action="">
          <input type="hidden" id="edit_room_id" name="room_id">
          <div class="mb-3">
            <label for="edit_room_title" class="form-label">
              <i class="fa-solid fa-door-closed me-1"></i> Venue Title
            </label>
            <input type="text" class="form-control border-primary rounded-2" name="room_title" id="edit_room_title" placeholder="e.g. Lecture Hall A" required>
          </div>

          <div class="mb-3">
            <label for="edit_room_capacity" class="form-label">
              <i class="fa-solid fa-users me-1"></i> Capacity
            </label>
            <input type="number" class="form-control border-primary rounded-2" name="room_capacity" id="edit_room_capacity" placeholder="e.g. 120" required>
          </div>

          <div class="text-end">
            <button type="button" id="update" name="update-venue" class="btn btn-soft-blue">
              <i class="fa-solid fa-save me-1"></i> Update Venue
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  .modal-content {
    background: #f9fbff;
    border-radius: 1rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
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

  .form-control:focus {
    border-color: #3b7ddd;
    box-shadow: 0 0 0 0.2rem rgba(59, 125, 221, 0.25);
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AJAX Script -->
<script type="text/javascript">
$(function(){
    function ListTable(){
        $.ajax({
            url: 'includes/list_venue.php',
            type: 'GET',
            success:function(data){
                var count = 1;
                var obj = $.parseJSON(data);      
                var result = "<table id='basic-datatable' class='table table-striped dt-responsive nowrap text-center'>"
    + "<thead><tr>"
    + "<th><i class='fa-solid fa-hashtag'></i></th>"
    + "<th><i class='fa-solid fa-location-dot'></i> Venue</th>"
    + "<th><i class='fa-solid fa-users'></i> Capacity</th>"
    + "<th><i class='fa-solid fa-gear'></i> Action</th>"
    + "</tr></thead><tbody>";

                $.each(obj, function() {
                    result += "<tr class='text-center'><td>" + count++ + "</td><td>" + this['room_title'] + "</td><td>" + this['capacity'] + "</td><td>"
                        + "<button class='btn btn-primary btn-sm edit-venue' data-id='" + this['room_id'] + "' data-title='" + this['room_title'] + "' data-capacity='" + this['capacity'] + "' data-bs-toggle='modal' data-bs-target='#editVenueModal'><i class='fa fa-edit'></i> Edit</button> "
                        + "<a class='btn btn-danger btn-sm' href='includes/delete-room.php?room_id=" + this['room_id'] + "'><i class='fa fa-trash'></i> Delete</a></td></tr>";
                });
                result += "</tbody></table>";
                $("#listhere").html(result);
            }
        });
    }

    $('#submit').click(function(){
        var room_title = $('#room_title').val();
        var room_capacity = $('#room_capacity').val();
        if(room_title.trim() !== "" && room_capacity.trim() !== ""){
            $.ajax({
                url: 'includes/add_venue.php',
                type: 'POST',
                data: { room_title: room_title, room_capacity: room_capacity },
                success:function(data){
                    if(data == 1){
                        $('.on').show();
                        $('.off').hide();
                        $('#room_title').val('');
                        $('#room_capacity').val('');
                        $('#addVenueModal').modal('hide');
                        ListTable();
                        window.showToast('Venue added successfully', 'success');
                    } else {
                        $('.off').show().text("Failed to add venue");
                        $('.on').hide();
                    }
                }
            });
        } else {
            $('.off').show().text("Please fill in all fields");
        }
    });

    $(document).on('click', '.edit-venue', function(){
        var room_id = $(this).data('id');
        var room_title = $(this).data('title');
        var room_capacity = $(this).data('capacity');
        
        $('#edit_room_id').val(room_id);
        $('#edit_room_title').val(room_title);
        $('#edit_room_capacity').val(room_capacity);
    });

    $('#update').click(function(){
        var room_id = $('#edit_room_id').val();
        var room_title = $('#edit_room_title').val();
        var room_capacity = $('#edit_room_capacity').val();
        
        if(room_title.trim() !== "" && room_capacity.trim() !== ""){
            $.ajax({
                url: 'includes/update_venue.php',
                type: 'POST',
                data: { room_id: room_id, room_title: room_title, room_capacity: room_capacity },
                success:function(data){
                    if(data == 1){
                        $('.on').show();
                        $('.off').hide();
                        $('#editVenueModal').modal('hide');
                        ListTable();
                        window.showToast('Venue updated successfully', 'success');
                    } else {
                        $('.off').show().text("Failed to update venue");
                        $('.on').hide();
                    }
                }
            });
        } else {
            $('.off').show().text("Please fill in all fields");
        }
    });

    ListTable();
    window.setInterval(ListTable, 5000);
});
</script>