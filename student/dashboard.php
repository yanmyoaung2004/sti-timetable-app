<?php
session_start();
include '../class/allclass.php';

// Redirect to login if student is not logged in
if (!isset($_SESSION['student_id']) || empty($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

$timetable = new timetable();
$student   = new student();

$student_id = $_SESSION['student_id'];

// Fetch student info
$student_info = $student->get_student_by_id($student_id);

if (!$student_info) {
    session_destroy();
    header("Location: index.php");
    exit();
}

$student_level_id = $student_info->level_id ?? 1;
$student_dept_id  = $student_info->student_dept_id ?? null;

// Fetch timetable
$timetable_data = [];
if ($student_level_id && $student_dept_id) {
    $timetable_data = $timetable->get_timetable_for_student($student_level_id, $student_dept_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Student Dashboard - Time Table Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Custom CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />

    <style>
        /* Sky blue theme overrides */
        .bg-primary, .btn-primary {
            background-color: #00BFFF !important;
            border-color: #00BFFF !important;
        }
        .text-primary {
            color: #00BFFF !important;
        }
        .navbar-custom {
            background-color: #00BFFF !important;
        }
        .left-side-menu {
            background-color: #E6F7FF; /* light blue sidebar */
        }
        .card-header {
            background-color: #00BFFF;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include 'includes/header.php'; ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'includes/sidebar.php'; ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <div class="container-fluid mt-4">

                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="mb-0">📅 Your Timetable</h4>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($timetable_data)): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Day</th>
                                                <th>Time</th>
                                                <th>Course</th>
                                                <th>Lecturer</th>
                                                <th>Room</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($timetable_data as $entry): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($entry['day'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($entry['time'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($entry['course_name'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($entry['lecturer_name'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($entry['room_name'] ?? '') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">No timetable found for your level and department.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div> <!-- container -->
            </div> <!-- content -->

            <?php include 'includes/footer.php'; ?>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/js/app.min.js"></script>

</body>
</html>
