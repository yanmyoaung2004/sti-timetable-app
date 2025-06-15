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
                    <div class="page-title-box d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h4 class="page-title">Add/Modify Time</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Add/Modify Time</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form & Table Row -->
            <div class="row">
                <!-- Left Column: Add Time Form -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="">
                                <?php
                                    if (isset($_POST['add_time'])) {
                                        $str = $_POST['start_time'];
                                        $end = $_POST['end_time'];
                                        $hr = $_POST['hour'];
                                        if ($time->add_time($str, $end, $hr)) {
                                            echo '<div class="alert alert-success">Time Added</div>';
                                        } else {
                                            echo '<div class="alert alert-danger">Time Cannot Be Added</div>';
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <small class="text-danger">Use 24hr format. e.g., 01:00pm = 13:00</small>
                                    <label class="mt-2">Start Time</label>
                                    <input type="text" class="form-control" name="start_time" placeholder="e.g., 09:00">
                                </div>

                                <div class="form-group">
                                    <small class="text-danger">Use 24hr format. e.g., 01:00pm = 13:00</small>
                                    <label class="mt-2">End Time</label>
                                    <input type="text" class="form-control" name="end_time" placeholder="e.g., 11:00">
                                </div>

                                <div class="form-group">
                                    <label class="mt-2">Lecture Hour</label>
                                    <input type="number" class="form-control" name="hour" placeholder="e.g., 2">
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-info btn-block rounded-0" name="add_time">
                                        Add Time
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Time Table -->
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatable" class="table table-bordered table-hover dt-responsive nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Lecture Hours</th>
                                            <th style="white-space: nowrap;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $list_time = $time->list_time();
                                        foreach ($list_time as $list_time) {
                                        ?>
                                        <tr>
                                            <td><?php echo ++$count ?></td>
                                            <td><?php echo $list_time->start_time ?></td>
                                            <td><?php echo $list_time->end_time ?></td>
                                            <td><?php echo $list_time->hours ?></td>
                                            <td style="white-space: nowrap;">
                                                <a href="includes/delete_time.php?time_val=<?php echo $list_time->time_id ?>" 
                                                   class="btn btn-sm btn-outline-danger">
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
