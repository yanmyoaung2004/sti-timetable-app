<?php
include "includes/header.php";
include "includes/sidebar.php";


if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $lecturer_id = filter_var($_GET['delete'], FILTER_SANITIZE_NUMBER_INT);
    
    try {
        if ($lecturer->delete_lecturer($lecturer_id)) {
            $_SESSION['success_msg'] = 'Lecturer deleted successfully!';
        } else {
            $_SESSION['error_msg'] = 'Failed to delete lecturer.';
        }
    } catch (Exception $e) {
        $_SESSION['error_msg'] = 'Error: ' . $e->getMessage();
    }
    
    // Redirect to avoid resubmission
    header('Location: view-lecturer.php');
    exit();
}

// Display messages
$success_message = isset($_SESSION['success_msg']) ? $_SESSION['success_msg'] : '';
$error_message = isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : '';

// Clear messages
unset($_SESSION['success_msg']);
unset($_SESSION['error_msg']);
?>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Lecturer</a></li>
                                <li class="breadcrumb-item active">View Lecturer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Lecturers</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- Display success/error messages -->
            <?php if ($success_message): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle mr-2"></i>
                            <?php echo htmlspecialchars($success_message); ?>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-triangle mr-2"></i>
                            <?php echo htmlspecialchars($error_message); ?>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-sm-8">
                                    <h5 class="card-title mb-0">All Lecturers</h5>
                                </div>
                                <div class="col-sm-4 text-sm-right">
                                    <a href="add-lecturer.php" class="btn btn-primary">
                                        <i class="fa fa-plus mr-1"></i>Add New Lecturer
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Email Address</th>
                                            <th>Phone</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Date Added</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        try {
                                            $count = 0;
                                            $lect_list = $lecturer->list_lecturer();
                                            
                                            if (!empty($lect_list)) {
                                                foreach ($lect_list as $lect) {
                                                    $count++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-soft-primary rounded-circle mr-2">
                                                                    <i class="fa fa-user text-primary"></i>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0"><?php echo htmlspecialchars($lect->lecturer_firstname . ' ' . $lect->lecturer_lastname); ?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-soft-info"><?php echo htmlspecialchars($lect->lecturer_username); ?></span>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($lect->lecturer_email); ?></td>
                                                        <td><?php echo htmlspecialchars($lect->lecturer_phone); ?></td>
                                                        <td><?php echo htmlspecialchars($lect->dept_title ?? 'N/A'); ?></td>
                                                        <td>
                                                            <span class="badge badge-soft-success"><?php echo htmlspecialchars($lect->lecturer_level); ?></span>
                                                        </td>
                                                        <td><?php echo date('M d, Y', strtotime($lect->lecturer_date_added)); ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="add-lecturer.php?edit=<?php echo $lect->lecturer_id; ?>" 
                                                                   class="btn btn-sm btn-primary" title="Edit Lecturer">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="assign-course.php?lecturer_id=<?php echo $lect->lecturer_id; ?>" 
                                                                   class="btn btn-sm btn-info" title="Assign Course">
                                                                    <i class="fa fa-book"></i>
                                                                </a>
                                                                <a href="view-lecturer.php?delete=<?php echo $lect->lecturer_id; ?>" 
                                                                   class="btn btn-sm btn-danger" title="Delete Lecturer"
                                                                   onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($lect->lecturer_firstname . ' ' . $lect->lecturer_lastname); ?>?')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo '<tr><td colspan="9" class="text-center text-muted">No lecturers found</td></tr>';
                                            }
                                        } catch (Exception $e) {
                                            echo '<tr><td colspan="9" class="text-center text-danger">Error loading data: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            
            $('#basic-datatable').DataTable({
                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                "order": [[1, "asc"]],
                "columnDefs": [
                    { "orderable": false, "targets": [8] } // Disable sorting on Actions column
                ],
                "language": {
                    "search": "Search lecturers:",
                    "lengthMenu": "Show _MENU_ lecturers",
                    "info": "Showing _START_ to _END_ of _TOTAL_ lecturers",
                    "emptyTable": "No lecturers found",
                    "zeroRecords": "No matching lecturers found"
                },
                "responsive": true,
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip'
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Enhanced delete confirmation
            $('a[href*="delete"]').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var lecturerName = $(this).closest('tr').find('h6').text();
                
                if (confirm('Are you sure you want to delete ' + lecturerName + '?\n\nThis action cannot be undone and may affect:\n- Course assignments\n- Schedule allocations\n\nProceed with deletion?')) {
                    window.location.href = url;
                }
            });
        });

        // Quick stats display
        function updateStats() {
            var table = $('#basic-datatable').DataTable();
            var totalLecturers = table.rows().count();
            
            // You can add more statistics here
            console.log('Total lecturers: ' + totalLecturers);
        }

        // Call updateStats when page loads
        $(document).ready(function() {
            setTimeout(updateStats, 1000);
        });
    </script>

    <!-- Custom CSS -->
    <style>
        .avatar-sm {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .badge-soft-info {
            color: #6c757d;
            background-color: rgba(108, 117, 125, 0.1);
        }
        
        .badge-soft-success {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }
        
        .badge-soft-primary {
            color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
        }
        
        .btn-group .dropdown-toggle::after {
            display: none;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
    </style>

<?php include "includes/footer.php"; ?>
