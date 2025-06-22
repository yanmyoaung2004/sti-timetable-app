<?php
include "includes/header.php";
include "includes/sidebar.php";

// Initialize variables
$success_message = '';
$error_message = '';
$edit_mode = false;
$lecturer_data = null;

// Check if we're editing
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_mode = true;
    $lecturer_id = filter_var($_GET['edit'], FILTER_SANITIZE_NUMBER_INT);
    
    try {
        // Get lecturer data from the list (since get_lecturer_by_id doesn't exist)
        $all_lecturers = $lecturer->list_lecturer();
        if (is_array($all_lecturers)) {
            foreach ($all_lecturers as $lect) {
                if ($lect->lecturer_id == $lecturer_id) {
                    $lecturer_data = $lect;
                    break;
                }
            }
        }
        
        if (!$lecturer_data) {
            $error_message = 'Lecturer not found.';
            $edit_mode = false;
        }
    } catch (Exception $e) {
        $error_message = 'Error loading lecturer data.';
        $edit_mode = false;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    try {
        // Validate and sanitize inputs
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $designation = filter_var($_POST['designation'], FILTER_SANITIZE_STRING);
        $department = filter_var($_POST['department'], FILTER_SANITIZE_NUMBER_INT);
        
        // Basic validation
        if (empty($fname) || empty($lname) || empty($username) || empty($email) || empty($phone) || empty($designation) || empty($department)) {
            throw new Exception('All fields are required.');
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format.');
        }
        
        if ($edit_mode && isset($_POST['lecturer_id'])) {
            // Update existing lecturer 
            $lecturer_id = filter_var($_POST['lecturer_id'], FILTER_SANITIZE_NUMBER_INT);
            
            if (method_exists($lecturer, 'update_lecturer')) {
                if ($lecturer->update_lecturer($lecturer_id, $fname, $lname, $username, $email, $phone, $department, $designation)) {
                    $success_message = 'Lecturer updated successfully!';
                    // Refresh lecturer data
                    $all_lecturers = $lecturer->list_lecturer();
                    if (is_array($all_lecturers)) {
                        foreach ($all_lecturers as $lect) {
                            if ($lect->lecturer_id == $lecturer_id) {
                                $lecturer_data = $lect;
                                break;
                            }
                        }
                    }
                } else {
                    throw new Exception('Failed to update lecturer.');
                }
            } else {
                throw new Exception('Update functionality not available. Please contact administrator.');
            }
        } else {
            // Add new lecturer 
            if ($lecturer->add_lecturer($fname, $lname, $username, $email, $phone, $department, $designation)) {
                $success_message = 'Lecturer added successfully!';
                
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'add-lecturer.php';
                    }, 2000);
                </script>";
            } else {
                throw new Exception('Failed to add lecturer. Username or email might already exist.');
            }
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

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
                                <li class="breadcrumb-item"><a href="view-lecturer.php">Lecturer</a></li>
                                <li class="breadcrumb-item active"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Lecturer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="<?php echo $edit_mode ? 'fa fa-edit' : 'fa fa-plus'; ?> mr-2"></i>
                            <?php echo $edit_mode ? 'Edit' : 'Add'; ?> Lecturer
                        </h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <!-- Display messages -->
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
                            <h5 class="card-title mb-0">
                                <?php echo $edit_mode ? 'Edit Lecturer Information' : 'Add New Lecturer'; ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    
                                    <form method="post" class="needs-validation" novalidate>
                                        <?php if ($edit_mode): ?>
                                            <input type="hidden" name="lecturer_id" value="<?php echo $lecturer_data->lecturer_id; ?>">
                                        <?php endif; ?>
                                        
                                        <div class="row">
                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label for="fname">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="fname" name="fname" 
                                                           placeholder="Enter first name" required
                                                           value="<?php echo $edit_mode ? htmlspecialchars($lecturer_data->lecturer_firstname) : ''; ?>">
                                                    <div class="invalid-feedback">Please provide a first name.</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label for="lname">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="lname" name="lname" 
                                                           placeholder="Enter last name" required
                                                           value="<?php echo $edit_mode ? htmlspecialchars($lecturer_data->lecturer_lastname) : ''; ?>">
                                                    <div class="invalid-feedback">Please provide a last name.</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label for="username">Username <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="username" name="username" 
                                                           placeholder="Enter username" required
                                                           value="<?php echo $edit_mode ? htmlspecialchars($lecturer_data->lecturer_username) : ''; ?>">
                                                    <div class="invalid-feedback">Please provide a username.</div>
                                                    <small class="form-text text-muted">This will be used for login.</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email" 
                                                           placeholder="Enter email address" required
                                                           value="<?php echo $edit_mode ? htmlspecialchars($lecturer_data->lecturer_email) : ''; ?>">
                                                    <div class="invalid-feedback">Please provide a valid email.</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                                           placeholder="+234 xxx xxx xxxx" required
                                                           value="<?php echo $edit_mode ? htmlspecialchars($lecturer_data->lecturer_phone) : ''; ?>">
                                                    <div class="invalid-feedback">Please provide a phone number.</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label for="department">Department <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="department" name="department" required>
                                                        <option value="" disabled <?php echo !$edit_mode ? 'selected' : ''; ?>>-- Select Department --</option>
                                                        <?php
                                                        try {
                                                            $dept_list = $dept->list_dept();
                                                            if (is_array($dept_list)) {
                                                                foreach ($dept_list as $department_item) {
                                                                    $selected = ($edit_mode && $lecturer_data->lecturer_dept == $department_item->dept_id) ? 'selected' : '';
                                                                    echo '<option value="' . $department_item->dept_id . '" ' . $selected . '>' 
                                                                         . htmlspecialchars($department_item->dept_title) . '</option>';
                                                                }
                                                            }
                                                        } catch (Exception $e) {
                                                            echo '<option disabled>Error loading departments</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a department.</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">  
                                                <div class="form-group">
                                                    <label for="designation">Designation <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="designation" name="designation" required>
                                                        <option value="" disabled <?php echo !$edit_mode ? 'selected' : ''; ?>>-- Select Designation --</option>
                                                        <?php
                                                        $designations = [
                                                            'Lecturer I' => 'Lecturer I',
                                                            'Lecturer II' => 'Lecturer II',
                                                            'Senior Lecturer I' => 'Senior Lecturer I',
                                                            'Senior Lecturer II' => 'Senior Lecturer II'
                                                        ];
                                                        
                                                        foreach ($designations as $key => $value) {
                                                            $selected = ($edit_mode && $lecturer_data->lecturer_level == $value) ? 'selected' : '';
                                                            echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a designation.</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account Status</label>
                                                    <div class="mt-2">
                                                        <?php if ($edit_mode): ?>
                                                            <span class="badge badge-success badge-lg">
                                                                <i class="fa fa-check-circle mr-1"></i>Active Account
                                                            </span>
                                                            <p class="text-muted small mt-1">
                                                                Created: <?php echo date('M d, Y', strtotime($lecturer_data->lecturer_date_added)); ?>
                                                            </p>
                                                        <?php else: ?>
                                                            <span class="badge badge-info badge-lg">
                                                                <i class="fa fa-plus-circle mr-1"></i>New Account
                                                            </span>
                                                            <p class="text-muted small mt-1">
                                                                Default password: 12345
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">  
                                                <div class="form-group text-center">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-lg mr-2">
                                                        <i class="fa fa-save mr-2"></i>
                                                        <?php echo $edit_mode ? 'Update Lecturer' : 'Add Lecturer'; ?>
                                                    </button>
                                                    
                                                    <?php if ($edit_mode): ?>
                                                        <a href="add-lecturer.php" class="btn btn-info btn-lg mr-2">
                                                            <i class="fa fa-plus mr-2"></i>Add New
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                    <a href="view-lecturer.php" class="btn btn-secondary btn-lg">
                                                        <i class="fa fa-list mr-2"></i>View All
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <!-- JavaScript for form validation -->
    <script>
        // Bootstrap form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0 && !value.startsWith('234')) {
                if (value.startsWith('0')) {
                    value = '234' + value.substring(1);
                } else if (value.length <= 10) {
                    value = '234' + value;
                }
            }
            e.target.value = value;
        });
    </script>

<?php include "includes/footer.php"; ?>
