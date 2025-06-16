<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">
                    <i class="fas fa-home"></i> Main Navigation
                </li>
                
                <li>
                    <a href="dashboard.php" class="waves-effect">
                        <i class="fas fa-tachometer-alt"></i>
                        <span> Dashboard </span>
                        <span class="menu-badge">
                            <i class="fas fa-circle"></i>
                        </span>
                    </a>
                </li>

                <li class="menu-title">
                    <i class="fas fa-users"></i> People Management
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span> Lecturers </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="add-lecturer.php">
                                <i class="fas fa-plus-circle"></i> Add Lecturer
                            </a>
                        </li>
                        <li>
                            <a href="view-lecturer.php">
                                <i class="fas fa-list"></i> View Lecturers
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="view-student.php" class="waves-effect">
                        <i class="fas fa-user-graduate"></i>
                        <span> Students </span>
                        <span class="menu-badge">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a>
                </li>

                <li class="menu-title">
                    <i class="fas fa-cogs"></i> System Setup
                </li>

                <li>
                    <a href="venue.php" class="waves-effect">
                        <i class="fas fa-building"></i>
                        <span> Venues </span>
                    </a>
                </li>
                
                <li>
                    <a href="department.php" class="waves-effect">
                        <i class="fas fa-university"></i>
                        <span> Departments </span>
                    </a>
                </li>
                
                <li>
                    <a href="time.php" class="waves-effect">
                        <i class="fas fa-clock"></i>
                        <span> Time Slots </span>
                    </a>
                </li>
                
                <li>
                    <a href="level.php" class="waves-effect">
                        <i class="fas fa-layer-group"></i>
                        <span> Academic Levels </span>
                    </a>
                </li>

                <li class="menu-title">
                    <i class="fas fa-book"></i> Academic Management
                </li>
                
                <li>
                    <a href="course.php" class="waves-effect">
                        <i class="fas fa-book-open"></i>
                        <span> Courses </span>
                    </a>
                </li>
                
                <li>
                    <a href="assign-course.php" class="waves-effect">
                        <i class="fas fa-user-check"></i>
                        <span> Assign Courses </span>
                    </a>
                </li>

                <li class="menu-title">
                    <i class="fas fa-calendar"></i> Timetable Management
                </li>
                
                <li>
                    <a href="gen-time-table.php" class="waves-effect">
                        <i class="fas fa-magic"></i>
                        <span> Generate Timetable </span>
                        <span class="menu-badge badge-success">
                            <i class="fas fa-plus"></i>
                        </span>
                    </a>
                </li>
                
                <li>
                    <a href="view-time-table.php" class="waves-effect">
                        <i class="fas fa-calendar-alt"></i>
                        <span> View Timetable </span>
                        <span class="menu-badge badge-info">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a>
                </li>

                <li class="menu-title d-md-none d-sm-block">
                    <i class="fas fa-sign-out-alt"></i> Session
                </li>
                
                <li class="d-md-none d-sm-block">
                    <a href="logout.php" class="waves-effect">
                        <i class="fas fa-sign-out-alt text-danger"></i>
                        <span class="text-danger"> Logout </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>

<!-- Enhanced Sidebar Styles -->
<style>
    .left-side-menu {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-right: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
    }
    
    .menu-title {
        color: var(--primary-gradient);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 1.5rem 0 0.5rem 0;
        padding: 0 1.5rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .menu-title i {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    #side-menu > li > a {
        color: var(--text-primary);
        padding: 0.8rem 1.5rem;
        border-radius: 0 25px 25px 0;
        margin-right: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    #side-menu > li > a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        transition: left 0.3s ease;
        z-index: -1;
    }
    
    #side-menu > li > a:hover::before,
    #side-menu > li.mm-active > a::before {
        left: 0;
    }
    
    #side-menu > li > a:hover,
    #side-menu > li.mm-active > a {
        color: white;
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    #side-menu > li > a i {
        width: 20px;
        text-align: center;
        margin-right: 0.75rem;
        font-size: 1rem;
    }
    
    .menu-badge {
        float: right;
        font-size: 0.7rem;
        margin-top: 0.2rem;
        opacity: 0.7;
    }
    
    .badge-success {
        color: #48bb78;
    }
    
    .badge-info {
        color: #4facfe;
    }
    
    .sub-menu {
        background: rgba(102, 126, 234, 0.05);
        border-radius: 0 15px 15px 0;
        margin-right: 1rem;
        margin-top: 0.5rem;
        padding: 0.5rem 0;
    }
    
    .sub-menu li a {
        color: var(--text-secondary);
        padding: 0.6rem 1rem 0.6rem 3rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .sub-menu li a:hover {
        color: var(--primary-color);
        background: rgba(102, 126, 234, 0.1);
        transform: translateX(5px);
    }
    
    .sub-menu li a i {
        margin-right: 0.5rem;
        font-size: 0.8rem;
    }
    
    /* Mobile specific styles */
    @media (max-width: 768px) {
        .left-side-menu {
            position: fixed;
            z-index: 1000;
            height: 100vh;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .left-side-menu.show {
            transform: translateX(0);
        }
        
        .menu-title {
            font-size: 0.7rem;
            margin: 1rem 0 0.3rem 0;
        }
        
        #side-menu > li > a {
            padding: 0.7rem 1rem;
            margin-right: 0.5rem;
        }
        
        .sub-menu li a {
            padding: 0.5rem 0.8rem 0.5rem 2.5rem;
        }
    }
    
    /* Active state animation */
    .mm-active > a::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 60%;
        background: var(--primary-gradient);
        border-radius: 2px 0 0 2px;
    }
</style>

<!-- Left Sidebar End -->