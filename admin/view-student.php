<?php
include "includes/header.php";
include "includes/sidebar.php";
$isEdit = true;
$dept = new dept();

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Lecturer</a></li>
                                <li class="breadcrumb-item active">View Student</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Student</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="d-flex justify-content-end align-items-center gap-2 mt-2 mr-3">
                            <button class="btn btn-success rounded mr-2" data-bs-toggle="modal" data-bs-target="#studentModal" onclick="openAddModal()">
                                <i class="fa fa-plus-circle"></i> Add New Student
                            </button>
                            <button class="btn btn-success rounded" onclick="exportTableToCSV('students.csv')">
                                <i class="fa fa-download"></i> Export to CSV
                            </button>
                        </div>

                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap">

                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Email Address</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $stuList = $student->list_student(); // renamed variable to avoid confusion
                                    foreach ($stuList as $stu) {
                                        // Prepare JSON for this student and escape it for HTML attribute
                                        $studentJson = htmlspecialchars(json_encode([
                                            'student_id' => $stu->student_id,
                                            'firstname' => $stu->student_firstname,
                                            'lastname' => $stu->student_lastname,
                                            'matricno' => $stu->student_matricno,
                                            'email' => $stu->student_email,
                                            'phone' => $stu->student_phone,
                                            'dept' => $stu->student_dept_id,
                                        ]), ENT_QUOTES, 'UTF-8');
                                    ?>
                                        <tr>
                                            <td><?php echo ++$count; ?></td>
                                            <td><?php echo $stu->student_firstname; ?></td>
                                            <td><?php echo $stu->student_lastname; ?></td>
                                            <td><?php echo $stu->student_matricno; ?></td>
                                            <td><?php echo $stu->student_email; ?></td>
                                            <td><?php echo $stu->student_phone; ?></td>
                                            <td>
                                                <a href="includes/delete_student.php?student_id=<?php echo $stu->student_id ?>" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                                <button class="btn btn-primary" onclick="handleEditModal(this)" data-student='<?php echo $studentJson; ?>'>
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Student Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="studentForm" action="includes/add_student.php" method="POST">
                    <input type="hidden" name="student_id" id="student_id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Matric Number</label>
                                <input type="text" class="form-control" name="matricno" id="matricno" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="dept">Departmnet</label>
                                    <select class="form-control" name="dept" id="dept">
                                        <option selected disabled>--Select Department--</option>
                                        <?php
                                        $dept_list = $dept->list_dept();
                                        foreach ($dept_list as $d) {
                                            $selected = ($d->dept_id == $student_dept_id) ? "selected" : "";
                                        ?>
                                            <option value="<?php echo $d->dept_id ?>" <?php echo $selected; ?>>
                                                <?php echo $d->dept_title ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById('basic-datatable');
            const dataTable = new DataTable(table);
            table.addEventListener('init.dt', function() {
                table.style.display = '';
            });
        });
    </script> -->

    <script>
        function handleEditModal(button) {
            const student = JSON.parse(button.getAttribute('data-student'));
            openEditModal(student);
        }

        function openAddModal() {
            document.getElementById("studentModalLabel").innerText = "Add New Student";
            document.getElementById("studentForm").action = "/add_student.php";
            document.getElementById("studentForm").reset();
            document.getElementById("student_id").value = "";
        }

        function openEditModal(student) {
            let modal = new bootstrap.Modal(document.getElementById('studentModal'));
            modal.show();
            document.getElementById("studentModalLabel").innerText = "Edit Student";
            document.getElementById("studentForm").action = "includes/update_student.php";
            document.getElementById("student_id").value = student.student_id;
            document.getElementById("firstname").value = student.firstname;
            document.getElementById("lastname").value = student.lastname;
            document.getElementById("matricno").value = student.matricno;
            document.getElementById("email").value = student.email;
            document.getElementById("phone").value = student.phone;
            document.getElementById("password").value = "";
            document.getElementById("dept").value = student.dept;

        }
    </script>


    <script>
        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("#basic-datatable tr");
            for (var i = 0; i < rows.length; i++) {
                var row = [],
                    cols = rows[i].querySelectorAll("td, th");

                for (var j = 0; j < cols.length - 1; j++) {
                    let text = cols[j].innerText.replace(/,/g, "").trim();
                    row.push('"' + text + '"');
                }
                csv.push(row.join(","));
            }
            var csvFile = new Blob([csv.join("\n")], {
                type: "text/csv"
            });
            var downloadLink = document.createElement("a");
            downloadLink.download = filename;
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>


    <?php
    include "includes/footer.php";
    ?>