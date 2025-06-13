<?php

include "includes/header.php";
include "includes/sidebar.php";

// Initialize variables
$success_message = '';
$error_message = '';
$lecturer_count = 0;
$course_count = 0;
$student_count = 0;

// Handle form submission
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

// Fetch dashboard statistics (add error handling)
try {
    // Add your actual database queries here
    // $lecturer_count = $database->count_lecturers();
    // $course_count = $database->count_courses();
    // $student_count = $database->count_students();

    // Placeholder values - replace with actual database calls
    $lecturer_count = 31570;
    $course_count = 1247;
    $student_count = 45823;
} catch (Exception $e) {
    error_log("Dashboard stats error: " . $e->getMessage());
}

// Get current session info for display
$current_session_info = '';
if (isset($_SESSION['session']) && isset($_SESSION['semester'])) {
    $current_session_info = "Current Active Session: " . $_SESSION['session'] . " - Semester: " . $_SESSION['semester'];
}
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                        <?php if ($current_session_info): ?>
                            <p class="text-muted mb-0"><?php echo htmlspecialchars($current_session_info); ?></p>
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
                <div class="col-xl-4 col-md-6">
                    <div class="card-box text-center">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="view-lecturer.php" class="dropdown-item">View All Lecturers</a>
                                <a href="add-lecturer.php" class="dropdown-item">Add New Lecturer</a>
                            </div>
                        </div>
                        <h4 class="mt-0 font-16 text-uppercase">Total Lecturers</h4>
                        <h2 class="text-primary my-4">
                            <i class="fa fa-user-tie text-primary" style="font-size: 24px;"></i>
                            <span class="ml-2" data-plugin="counterup"><?php echo number_format($lecturer_count); ?></span>
                        </h2>
                        <p class="text-muted mb-0">Active faculty members</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card-box text-center">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="course.php" class="dropdown-item">View All Courses</a>
                            </div>
                        </div>
                        <h4 class="mt-0 font-16 text-uppercase">Total Courses</h4>
                        <h2 class="text-success my-4">
                            <i class="fa fa-book text-success" style="font-size: 24px;"></i>
                            <span class="ml-2" data-plugin="counterup"><?php echo number_format($course_count); ?></span>
                        </h2>
                        <p class="text-muted mb-0">Available courses</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card-box text-center">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="view-student.php" class="dropdown-item">View All Students</a>

                            </div>
                        </div>
                        <h4 class="mt-0 font-16 text-uppercase">Total Students</h4>
                        <h2 class="text-info my-4">
                            <i class="fa fa-users text-info" style="font-size: 24px;"></i>
                            <span class="ml-2" data-plugin="counterup"><?php echo number_format($student_count); ?></span>
                        </h2>
                        <p class="text-muted mb-0">Enrolled students</p>
                    </div>
                </div>
            </div>
            <!-- end statistics row -->

            <!-- Session and Semester Settings -->
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 mx-auto">
                    <div class="card-box">
                        <h4 class="header-title mb-3">
                            <i class="fa fa-cog mr-2"></i>Session & Semester Settings
                        </h4>

                        <form method="post" id="sessionForm" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="session" class="form-label">Active Session <span class="text-danger">*</span></label>
                                        <select class="form-control" name="session" id="session" required>
                                            <option value="" disabled selected>-- Select Active Session --</option>
                                            <?php
                                            try {
                                                if (isset($session)) {
                                                    $sess = $session->list_session();
                                                    foreach ($sess as $s) {
                                                        $selected = (isset($_SESSION['session']) && $_SESSION['session'] == $s->session_id) ? 'selected' : '';
                                                        echo '<option value="' . htmlspecialchars($s->session_id) . '" ' . $selected . '>'
                                                            . htmlspecialchars($s->session_year) . '</option>';
                                                    }
                                                }
                                            } catch (Exception $e) {
                                                echo '<option disabled>Error loading sessions</option>';
                                                error_log("Session loading error: " . $e->getMessage());
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a session.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="semester" class="form-label">Active Semester <span class="text-danger">*</span></label>
                                        <select class="form-control" name="semester" id="semester" required>
                                            <option value="" disabled selected>-- Select Active Semester --</option>
                                            <?php
                                            try {
                                                if (isset($session)) {
                                                    $sem = $session->list_semester();
                                                    foreach ($sem as $s) {
                                                        $selected = (isset($_SESSION['semester']) && $_SESSION['semester'] == $s->semester_id) ? 'selected' : '';
                                                        echo '<option value="' . htmlspecialchars($s->semester_id) . '" ' . $selected . '>'
                                                            . htmlspecialchars($s->semester_title) . '</option>';
                                                    }
                                                }
                                            } catch (Exception $e) {
                                                echo '<option disabled>Error loading semesters</option>';
                                                error_log("Semester loading error: " . $e->getMessage());
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a semester.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                    <i class="fa fa-save mr-2"></i>Save Session Settings
                                </button>
                                <button type="button" class="btn btn-secondary btn-lg ml-2" onclick="resetForm()">
                                    <i class="fa fa-undo mr-2"></i>Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end session settings row -->

        </div> <!-- container -->
    </div> <!-- content -->

    <!-- JavaScript for form validation and interactions -->
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

        // Reset form function
        function resetForm() {
            document.getElementById('sessionForm').reset();
            document.getElementById('sessionForm').classList.remove('was-validated');
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>

    <?php
    include "includes/footer.php";
    ?>