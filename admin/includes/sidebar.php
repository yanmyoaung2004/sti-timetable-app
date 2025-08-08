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
                    <i class="fas fa-users"></i> staff and Student Management
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span> Lecturer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="add-lecturer.php">
                                <i class="fas fa-plus-circle"></i> Add Lecturer
                            </a>
                        </li>
                        <li>
                            <a href="view-lecturer.php">
                                <i class="fas fa-list"></i> View Lecturer
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="view-student.php" class="waves-effect">
                        <i class="fas fa-user-graduate"></i>
                        <span> View Student </span>
                        <span class="menu-badge">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a>
                </li>
                
                <li>
                    <a href="view-session.php" class="waves-effect">
                        <i class="fas fa-calendar-check"></i>
                        <span> Session </span>
                    </a>
                </li>
                
                <li class="menu-title">
                    <i class="fas fa-cogs"></i> System Setup
                </li>
                
                <li>
                    <a href="venue.php" class="waves-effect">
                        <i class="fas fa-building"></i>
                        <span> Venue </span>
                    </a>
                </li>
                
                <li>
                    <a href="department.php" class="waves-effect">
                        <i class="fas fa-university"></i>
                        <span> Department </span>
                    </a>
                </li>
                
                <li>
                    <a href="time.php" class="waves-effect">
                        <i class="fas fa-clock"></i>
                        <span> Time </span>
                    </a>
                </li>
                
                <li>
                    <a href="level.php" class="waves-effect">
                        <i class="fas fa-layer-group"></i>
                        <span> Level </span>
                    </a>
                </li>
                
                <li class="menu-title">
                    <i class="fas fa-book"></i> Academic Management
                </li>
                
                <li>
                    <a href="course.php" class="waves-effect">
                        <i class="fas fa-book-open"></i>
                        <span> Course </span>
                    </a>
                </li>
                
                <li>
                    <a href="assign-course.php" class="waves-effect">
                        <i class="fas fa-user-check"></i>
                        <span> Assign Course </span>
                    </a>
                </li>
                
                <li class="menu-title">
                    <i class="fas fa-calendar"></i> Timetable Management
                </li>
                
                <li>
                    <a href="gen-time-table.php" class="waves-effect">
                        <i class="fas fa-magic"></i>
                        <span> Generate Time Table </span>
                        <span class="menu-badge badge-success">
                            <i class="fas fa-plus"></i>
                        </span>
                    </a>
                </li>
                
                <li>
                    <a href="view-time-table.php" class="waves-effect">
                        <i class="fas fa-calendar-alt"></i>
                        <span> View Time Table </span>
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
                        <span class="text-danger"> Log Out </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>

<!-- Sidebar Styles -->
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
        color: var(--text-primary, #333);
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
        background: linear-gradient(135deg, #667eea, #764ba2);
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
    
    .nav-second-level {
        background: rgba(102, 126, 234, 0.05);
        border-radius: 0 15px 15px 0;
        margin-right: 1rem;
        margin-top: 0.5rem;
        padding: 0.5rem 0;
    }
    
    .nav-second-level li a {
        color: var(--text-secondary, #666);
        padding: 0.6rem 1rem 0.6rem 3rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: block;
        text-decoration: none;
    }
    
    .nav-second-level li a:hover {
        color: var(--primary-color, #667eea);
        background: rgba(102, 126, 234, 0.1);
        transform: translateX(5px);
    }
    
    .nav-second-level li a i {
        margin-right: 0.5rem;
        font-size: 0.8rem;
    }
    
    .text-danger {
        color: #dc3545 !important;
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
        
        .nav-second-level li a {
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
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px 0 0 2px;
    }
    
    /* Waves effect */
    .waves-effect {
        position: relative;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        user-select: none;
        transition: all 0.3s ease-out;
    }
    
    .waves-effect:hover {
        text-decoration: none;
    }
    
    /* Menu arrow styling */
    .menu-arrow {
        float: right;
        margin-top: 0.2rem;
        font-size: 0.7rem;
        opacity: 0.7;
    }
    
    .has-arrow .menu-arrow::before {
        content: "\f107";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        transition: transform 0.3s ease;
    }
    
    .has-arrow.mm-active .menu-arrow::before {
        transform: rotate(180deg);
    }
</style>

<!-- Left Sidebar End -->
