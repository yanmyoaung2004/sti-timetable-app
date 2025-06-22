<?php
include "includes/header.php";
include "includes/sidebar.php";

// Initialize variables
$success_message = '';
$error_message = '';
$lecturer_count = 0;
$course_count = 0;
$student_count = 0;
$department_count = 0;
$room_count = 0;
$schedule_count = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    try {
        if (!empty($_POST['session']) && !empty($_POST['semester'])) {
            $_SESSION['session'] = filter_var($_POST['session'], FILTER_SANITIZE_NUMBER_INT);
            $_SESSION['semester'] = filter_var($_POST['semester'], FILTER_SANITIZE_NUMBER_INT);
            $success_message = 'Session and Semester successfully set!';
        } else {
            $error_message = 'Please select both session and semester.';
        }
    } catch (Exception $e) {
        $error_message = 'An error occurred while setting session and semester.';
        error_log("Dashboard error: " . $e->getMessage());
    }
}

// Fetch dashboard statistics with error handling using existing methods
try {
    // Count lecturers using existing list method
    $lecturer_list = $lecturer->list_lecturer();
    $lecturer_count = is_array($lecturer_list) ? count($lecturer_list) : 0;
    
    // Count courses using existing list method (if available)
    if (method_exists($course, 'list_course')) {
        $course_list = $course->list_course();
        $course_count = is_array($course_list) ? count($course_list) : 0;
    }
    
    // Count students using existing list method (if available)
    if (method_exists($student, 'list_student')) {
        $student_list = $student->list_student();
        $student_count = is_array($student_list) ? count($student_list) : 0;
    }
    
    // Count departments using existing list method
    if (method_exists($dept, 'list_dept')) {
        $dept_list = $dept->list_dept();
        $department_count = is_array($dept_list) ? count($dept_list) : 0;
    }
    
    // Count rooms/venues using existing list method (if available)
    if (method_exists($room, 'list_room')) {
        $room_list = $room->list_room();
        $room_count = is_array($room_list) ? count($room_list) : 0;
    }
    
    // Get schedule count for current session/semester
    if (isset($_SESSION['session']) && isset($_SESSION['semester'])) {
        $schedule_list = $time->list_schedule($_SESSION['session'], $_SESSION['semester']);
        $schedule_count = is_array($schedule_list) ? count($schedule_list) : 0;
    }
    
} catch (Exception $e) {
    error_log("Dashboard stats error: " . $e->getMessage());
    // Keep default values of 0 if there are errors
}

// Get current session info for display
$current_session_info = '';
$current_session_name = '';
$current_semester_name = '';

if (isset($_SESSION['session']) && isset($_SESSION['semester'])) {
    try {
        // Get session and semester info (if methods exist)
        if (method_exists($session, 'get_session_by_id')) {
            $session_info = $session->get_session_by_id($_SESSION['session']);
            if ($session_info) {
                $current_session_name = $session_info->session_year;
            }
        }
        
        if (method_exists($session, 'get_semester_by_id')) {
            $semester_info = $session->get_semester_by_id($_SESSION['semester']);
            if ($semester_info) {
                $current_semester_name = $semester_info->semester_title;
            }
        }
        
        if ($current_session_name && $current_semester_name) {
            $current_session_info = "Active: " . $current_session_name . " - " . $current_semester_name . " Semester";
        }
    } catch (Exception $e) {
        error_log("Session info error: " . $e->getMessage());
    }
}

// Get recent activities (only if we have data)
$recent_lecturers = [];
try {
    $all_lecturers = $lecturer->list_lecturer();
    if (is_array($all_lecturers) && count($all_lecturers) > 0) {
        // Get last 5 lecturers (assuming they're ordered by date)
        $recent_lecturers = array_slice($all_lecturers, -5);
        $recent_lecturers = array_reverse($recent_lecturers); // Show newest first
    }
} catch (Exception $e) {
    error_log("Recent lecturers error: " . $e->getMessage());
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fa fa-tachometer-alt mr-2"></i>Admin Dashboard
                        </h4>
                        <?php if ($current_session_info): ?>
                            <p class="text-muted mb-0">
                                <i class="fa fa-calendar mr-1"></i><?php echo htmlspecialchars($current_session_info); ?>
                            </p>
                        <?php endif; ?>
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="view-lecturer.php" class="dropdown-item">View All</a>
                                <a href="add-lecturer.php" class="dropdown-item">Add New</a>
                            </div>
                        </div>
                        <h4 class="mt-0 font-16 text-uppercase text-muted">Total Lecturers</h4>
                        <h2 class="text-primary my-3">
                            <i class="fa fa-user-tie text-primary mr-2" style="font-size: 28px;"></i>
                            <span data-plugin="counterup"><?php echo number_format($lecturer_count); ?></span>
                        </h2>
                        <p class="text-muted mb-0">
                            <span class="text-success"><i class="fa fa-arrow-up mr-1"></i>Active Faculty</span>
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="course.php" class="dropdown-item">View All</a>
                                <a href="add-course.php" class="dropdown-item">Add New</a>
                            </div>
                        </div>
                        <h4 class="mt-0 font-16 text-uppercase text-muted">Total Courses</h4>
                        <h2 class="text-success my-3">
                            <i class="fa fa-book text-success mr-2" style="font-size: 28px;"></i>
                            <span data-plugin="counterup"><?php echo number_format($course_count); ?></span>
                        </h2>
                        <p class="text-muted mb-0">
                            <span class="text-info"><i class="fa fa-graduation-cap mr-1"></i>Available</span>
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="view-student.php" class="dropdown-item">View All</a>
                                <a href="add-student.php" class="dropdown-item">Add New</a>
                            </div>
                        </div>
                        <h4 class="mt-0 font-16 text-uppercase text-muted">Total Students</h4>
                        <h2 class="text-info my-3">
                            <i class="fa fa-users text-info mr-2" style="font-size: 28px;"></i>
                            <span data-plugin="counterup"><?php echo number_format($student_count); ?></span>
                        </h2>
                        <p class="text-muted mb-0">
                            <span class="text-primary"><i class="fa fa-user-graduate mr-1"></i>Enrolled</span>
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="schedule.php" class="dropdown-item">View Schedule</a>
                                <a href="add-schedule.php" class="dropdown-item">Add New</a>
                            </div>
                        </div>
                        <h4 class="mt-0 font-16 text-uppercase text-muted">Scheduled Classes</h4>
                        <h2 class="text-warning my-3">
                            <i class="fa fa-calendar-alt text-warning mr-2" style="font-size: 28px;"></i>
                            <span data-plugin="counterup"><?php echo number_format($schedule_count); ?></span>
                        </h2>
                        <p class="text-muted mb-0">
                            <span class="text-success"><i class="fa fa-clock mr-1"></i>This Semester</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- end statistics row -->

            <!-- Main Content Row -->
            <div class="row">
                <!-- Session Settings -->
                <div class="col-xl-8">
                    <div class="card-box">
                        <h4 class="header-title mb-3">
                            <i class="fa fa-cog mr-2"></i>Session & Semester Settings
                        </h4>
                        
                        <form method="post" id="sessionForm" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="session" class="form-label">Active Session <span class="text-danger">*</span></label>
                                        <select class="form-control" name="session" id="session" required>
                                            <option value="" disabled selected>-- Select Active Session --</option>
                                            <?php
                                            try {
                                                if (isset($session) && method_exists($session, 'list_session')) {
                                                    $sess = $session->list_session();
                                                    foreach ($sess as $s) {
                                                        $selected = (isset($_SESSION['session']) && $_SESSION['session'] == $s->session_id) ? 'selected' : '';
                                                        echo '<option value="' . htmlspecialchars($s->session_id) . '" ' . $selected . '>' 
                                                             . htmlspecialchars($s->session_year) . '</option>';
                                                    }
                                                }
                                            } catch (Exception $e) {
                                                echo '<option disabled>Error loading sessions</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Please select a session.</div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="semester" class="form-label">Active Semester <span class="text-danger">*</span></label>
                                        <select class="form-control" name="semester" id="semester" required>
                                            <option value="" disabled selected>-- Select Active Semester --</option>
                                            <?php
                                            try {
                                                if (isset($session) && method_exists($session, 'list_semester')) {
                                                    $sem = $session->list_semester();
                                                    foreach ($sem as $s) {
                                                        $selected = (isset($_SESSION['semester']) && $_SESSION['semester'] == $s->semester_id) ? 'selected' : '';
                                                        echo '<option value="' . htmlspecialchars($s->semester_id) . '" ' . $selected . '>' 
                                                             . htmlspecialchars($s->semester_title) . '</option>';
                                                    }
                                                }
                                            } catch (Exception $e) {
                                                echo '<option disabled>Error loading semesters</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Please select a semester.</div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="submit" name="submit" class="btn btn-primary btn-block">
                                            <i class="fa fa-save mr-1"></i>Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Quick Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3"><i class="fa fa-bolt mr-2"></i>Quick Actions</h5>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <a href="add-lecturer.php" class="btn btn-outline-primary mr-2 mb-2">
                                        <i class="fa fa-user-plus mr-1"></i>Add Lecturer
                                    </a>
                                    <a href="add-course.php" class="btn btn-outline-success mr-2 mb-2">
                                        <i class="fa fa-book-plus mr-1"></i>Add Course
                                    </a>
                                    <a href="add-schedule.php" class="btn btn-outline-info mr-2 mb-2">
                                        <i class="fa fa-calendar-plus mr-1"></i>Schedule Class
                                    </a>
                                    <a href="view-schedule.php" class="btn btn-outline-warning mr-2 mb-2">
                                        <i class="fa fa-calendar-check mr-1"></i>View Timetable
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="header-title mb-3">
                            <i class="fa fa-clock mr-2"></i>Recent Activities
                        </h4>
                        
                        <!-- Recent Lecturers -->
                        <div class="mb-3">
                            <h6 class="text-muted">Recently Added Lecturers</h6>
                            <?php if (!empty($recent_lecturers)): ?>
                                <?php foreach ($recent_lecturers as $lecturer_item): ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-sm bg-soft-primary rounded mr-2">
                                            <i class="fa fa-user text-primary"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="mb-0 font-13">
                                                <strong><?php echo htmlspecialchars($lecturer_item->lecturer_firstname . ' ' . $lecturer_item->lecturer_lastname); ?></strong>
                                            </p>
                                            <p class="mb-0 text-muted font-11">
                                                <?php echo date('M d, Y', strtotime($lecturer_item->lecturer_date_added)); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-center mt-3">
                                    <a href="view-lecturer.php" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-eye mr-1"></i>View All Lecturers
                                    </a>
                                </div>
                            <?php else: ?>
                                <p class="text-muted font-13">No lecturers found</p>
                                <div class="text-center">
                                    <a href="add-lecturer.php" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus mr-1"></i>Add First Lecturer
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- System Status -->
                        <div class="mb-3">
                            <h6 class="text-muted">System Status</h6>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="font-13">Database</span>
                                <span class="badge badge-success">Online</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="font-13">Timetable System</span>
                                <span class="badge badge-success">Active</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="font-13">Last Updated</span>
                                <span class="font-11 text-muted"><?php echo date('M d, Y H:i'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end main content row -->

        </div> <!-- container -->
    </div> <!-- content -->

    <!-- JavaScript functionality -->
    <script>
        // Form validation
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

        // Simple counter animation
        $(document).ready(function() {
            $('[data-plugin="counterup"]').each(function() {
                var $this = $(this);
                var countTo = parseInt($this.text());
                
                if (countTo > 0) {
                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 1500,
                        easing: 'linear',
                        step: function() {
                            $this.text(Math.floor(this.countNum).toLocaleString());
                        },
                        complete: function() {
                            $this.text(countTo.toLocaleString());
                        }
                    });
                }
            });
        });
    </script>

    <style>
        .avatar-sm {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .bg-soft-primary {
            background-color: rgba(0, 123, 255, 0.1);
        }
        
        .flex-1 {
            flex: 1;
        }
    </style>

<?php include "includes/footer.php"; ?>
