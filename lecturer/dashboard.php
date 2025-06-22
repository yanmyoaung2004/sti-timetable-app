<?php
include "includes/header.php";
include "includes/sidebar.php";
$lecturer->check_lecturer();
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
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <?php
            // Set timezone
            date_default_timezone_set("Africa/Lagos");
            
            // Get current day and time
            $current_day = date('l');
            $current_hour = (int)date('H');
            $current_minute = (int)date('i');
            $current_time_minutes = ($current_hour * 60) + $current_minute;
            
            // Initialize default values
            $next_lecture_time = "No upcoming lecture";
            $next_lecture_course = "No lecture scheduled";
            $next_lecture_venue = "No venue assigned";
            $lecture_status = "free";
            
            try {
                // Get day ID with error handling
                $day_query = $time->get_day_id($current_day);
                
                if ($day_query) {
                    $day_id = $day_query;
                    
                    // Get all time slots for today
                    $time_slots_query = "SELECT * FROM `time` ORDER BY start_time ASC";
                    $stmt = $time->p($time_slots_query);
                    $stmt->execute();
                    $time_slots = $stmt->fetchAll(PDO::FETCH_OBJ);
                    
                    $found_lecture = false;
                    
                    foreach ($time_slots as $slot) {
                        // Parse time slot
                        $start_parts = explode(':', $slot->start_time);
                        $start_minutes = ((int)$start_parts[0] * 60) + (int)$start_parts[1];
                        
                        $end_parts = explode(':', $slot->end_time);
                        $end_minutes = ((int)$end_parts[0] * 60) + (int)$end_parts[1];
                        
                        // Check if this is current or next time slot
                        if ($current_time_minutes <= $end_minutes) {
                            // Check if lecturer has a class
                            $schedule_check = $time->schedule_checker($slot->time_id, $day_id, $_SESSION['lecturer_id']);
                            
                            if ($schedule_check && isset($schedule_check->course_title)) {
                                
                                $next_lecture_time = $slot->start_time . " - " . $slot->end_time;
                                $next_lecture_course = $schedule_check->course_title . " (" . $schedule_check->course_unit . ")";
                                $next_lecture_venue = isset($schedule_check->room_title) ? $schedule_check->room_title : "Venue TBA";
                                
                                // Determine if it's current or upcoming
                                if ($current_time_minutes >= $start_minutes && $current_time_minutes < $end_minutes) {
                                    $lecture_status = "ongoing";
                                } else {
                                    $lecture_status = "upcoming";
                                }
                                
                                $found_lecture = true;
                                break;
                            } else if ($current_time_minutes < $start_minutes) {
                                // No more lectures today after this time slot
                                break;
                            }
                        }
                    }
                    
                    // If no lecture found today, check tomorrow
                    if (!$found_lecture) {
                        $tomorrow = date('l', strtotime('+1 day'));
                        $tomorrow_day_id = $time->get_day_id($tomorrow);
                        
                        if ($tomorrow_day_id) {
                            // Get first time slot of tomorrow
                            if (!empty($time_slots)) {
                                $first_slot = $time_slots[0];
                                $tomorrow_schedule = $time->schedule_checker($first_slot->time_id, $tomorrow_day_id, $_SESSION['lecturer_id']);
                                
                                if ($tomorrow_schedule && isset($tomorrow_schedule->course_title)) {
                                    $next_lecture_time = "Tomorrow " . $first_slot->start_time . " - " . $first_slot->end_time;
                                    $next_lecture_course = $tomorrow_schedule->course_title . " (" . $tomorrow_schedule->course_unit . ")";
                                    $next_lecture_venue = isset($tomorrow_schedule->room_title) ? $tomorrow_schedule->room_title : "Venue TBA";
                                    $lecture_status = "tomorrow";
                                }
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                // Handle any database errors gracefully
                $next_lecture_time = "Error loading schedule";
                $next_lecture_course = "Please check system";
                $next_lecture_venue = "Contact admin";
            }
            
            // Set appropriate colors and icons based on status
            $time_color = "text-primary";
            $course_color = "text-info";
            $venue_color = "text-success";
            $time_icon = "fa fa-clock";
            
            switch ($lecture_status) {
                case "ongoing":
                    $time_color = "text-danger";
                    $time_icon = "fa fa-play-circle";
                    break;
                case "upcoming":
                    $time_color = "text-warning";
                    $time_icon = "fa fa-clock";
                    break;
                case "tomorrow":
                    $time_color = "text-info";
                    $time_icon = "fa fa-calendar";
                    break;
                default:
                    $time_color = "text-muted";
                    $time_icon = "fa fa-clock";
            }
            ?>

            <div class="row">
                <!-- Next Lecture Time -->
                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="mt-0 font-16">
                            <?php 
                            echo ($lecture_status == "ongoing") ? "Current Lecture" : "Next Lecture Time";
                            ?>
                        </h4>
                        <h3 class="<?php echo $time_color; ?> my-4 text-center">
                            <i class="<?php echo $time_icon; ?>"></i><br>
                            <span class="font-16"><?php echo $next_lecture_time; ?></span>
                        </h3>
                        <?php if ($lecture_status == "ongoing"): ?>
                            <div class="text-center">
                                <span class="badge badge-danger">LIVE NOW</span>
                            </div>
                        <?php elseif ($lecture_status == "upcoming"): ?>
                            <div class="text-center">
                                <span class="badge badge-warning">UPCOMING</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Course Information -->
                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="mt-0 font-16">Course</h4>
                        <h3 class="<?php echo $course_color; ?> my-4 text-center">
                            <i class="fa fa-book"></i><br>
                            <span class="font-14"><?php echo $next_lecture_course; ?></span>
                        </h3>
                    </div>
                </div>

                <!-- Venue Information -->
                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="mt-0 font-16">Venue</h4>
                        <h3 class="<?php echo $venue_color; ?> my-4 text-center">
                            <i class="fa fa-map-marker"></i><br>
                            <span class="font-16"><?php echo $next_lecture_venue; ?></span>
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule Overview -->
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Today's Schedule Overview</h4>
                        
                        <?php
                        try {
                            if (isset($day_id) && $day_id) {
                                echo '<div class="table-responsive">';
                                echo '<table class="table table-bordered table-striped">';
                                echo '<thead><tr><th>Time</th><th>Course</th><th>Venue</th><th>Status</th></tr></thead>';
                                echo '<tbody>';
                                
                                $has_schedule = false;
                                
                                foreach ($time_slots as $slot) {
                                    $schedule = $time->schedule_checker($slot->time_id, $day_id, $_SESSION['lecturer_id']);
                                    
                                    if ($schedule && isset($schedule->course_title)) {
                                        $has_schedule = true;
                                        
                                        // Determine status
                                        $start_parts = explode(':', $slot->start_time);
                                        $start_minutes = ((int)$start_parts[0] * 60) + (int)$start_parts[1];
                                        $end_parts = explode(':', $slot->end_time);
                                        $end_minutes = ((int)$end_parts[0] * 60) + (int)$end_parts[1];
                                        
                                        $status = "Upcoming";
                                        $status_class = "badge-info";
                                        
                                        if ($current_time_minutes >= $start_minutes && $current_time_minutes < $end_minutes) {
                                            $status = "Ongoing";
                                            $status_class = "badge-danger";
                                        } elseif ($current_time_minutes >= $end_minutes) {
                                            $status = "Completed";
                                            $status_class = "badge-success";
                                        }
                                        
                                        echo '<tr>';
                                        echo '<td><strong>' . $slot->start_time . ' - ' . $slot->end_time . '</strong></td>';
                                        echo '<td>' . $schedule->course_title . ' (' . $schedule->course_unit . ')</td>';
                                        echo '<td>' . (isset($schedule->room_title) ? $schedule->room_title : 'TBA') . '</td>';
                                        echo '<td><span class="badge ' . $status_class . '">' . $status . '</span></td>';
                                        echo '</tr>';
                                    }
                                }
                                
                                if (!$has_schedule) {
                                    echo '<tr><td colspan="4" class="text-center text-muted">No lectures scheduled for today</td></tr>';
                                }
                                
                                echo '</tbody></table>';
                                echo '</div>';
                            } else {
                                echo '<p class="text-muted">Unable to load today\'s schedule.</p>';
                            }
                        } catch (Exception $e) {
                            echo '<p class="text-danger">Error loading schedule. Please contact administrator.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->

    </div> <!-- content -->

<?php
include "includes/footer.php";
?>
