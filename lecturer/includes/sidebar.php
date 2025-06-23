<!-- ==========Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!---  Sidemenu -->
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
                    <i class="fas fa-calendar"></i> Timetable Management
                </li>
                
                <li>
                    <a href="view-time-table.php" class="waves-effect">
                        <i class="fas fa-calendar-alt"></i>
                        <span> Time Table </span>
                        <span class="menu-badge badge-info">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a>
                </li>

                <li class="menu-title">
                    <i class="fas fa-book"></i> Academic Management
                </li>
                
                <li>
                    <a href="course-assigned.php" class="waves-effect">
                        <i class="fas fa-user-check"></i>
                        <span> Courses Assigned </span>
                        <span class="menu-badge badge-success">
                            <i class="fas fa-check"></i>
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

<!--  Sidebar Styles -->
<style>
    :root {
        --primary-color: #4f46e5;
        --primary-dark: #3730a3;
        --primary-gradient: linear-gradient(135deg, #667eea, #764ba2);
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --border-color: #e2e8f0;
        --success-color: #10b981;
        --info-color: #4facfe;
        --danger-color: #ef4444;
    }

    .left-side-menu {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-right: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
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
        position: relative;
    }
    
    .menu-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 1.5rem;
        width: 30px;
        height: 2px;
        background: var(--primary-gradient);
        border-radius: 1px;
    }
    
    .menu-title:first-child {
        margin-top: 1rem;
    }
    
    .menu-title i {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 0.9rem;
    }
    
    #side-menu > li > a {
        color: var(--text-primary);
        padding: 0.8rem 1.5rem;
        border-radius: 0 25px 25px 0;
        margin-right: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        text-decoration: none;
        font-weight: 500;
    }
    
    #side-menu > li > a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: -1;
    }
    
    #side-menu > li > a::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--primary-gradient);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        border-radius: 0 2px 2px 0;
    }
    
    #side-menu > li > a:hover::before,
    #side-menu > li.mm-active > a::before {
        left: 0;
    }
    
    #side-menu > li > a:hover::after,
    #side-menu > li.mm-active > a::after {
        transform: scaleY(1);
    }
    
    #side-menu > li > a:hover,
    #side-menu > li.mm-active > a {
        color: white;
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        text-decoration: none;
    }
    
    #side-menu > li > a:hover .menu-badge,
    #side-menu > li.mm-active > a .menu-badge {
        color: rgba(255, 255, 255, 0.9);
    }
    
    #side-menu > li > a i {
        width: 20px;
        text-align: center;
        margin-right: 0.75rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    #side-menu > li > a:hover i {
        transform: scale(1.1);
    }
    
    .menu-badge {
        margin-left: auto;
        font-size: 0.7rem;
        opacity: 0.7;
        transition: all 0.3s ease;
    }
    
    .badge-success {
        color: var(--success-color);
    }
    
    .badge-info {
        color: var(--info-color);
    }
    
    .text-danger {
        color: var(--danger-color) !important;
    }
    
    /* Special styling for logout on mobile */
    .d-md-none.d-sm-block a {
        border-top: 1px solid var(--border-color);
        margin-top: 1rem;
        padding-top: 1rem;
    }
    
    .d-md-none.d-sm-block a:hover {
        background: rgba(239, 68, 68, 0.1) !important;
        color: var(--danger-color) !important;
    }
    
    .d-md-none.d-sm-block a:hover::before {
        background: linear-gradient(135deg, #f56565, #e53e3e) !important;
    }
    
    /* Hover animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    #side-menu > li {
        animation: slideIn 0.3s ease forwards;
        opacity: 0;
    }
    
    #side-menu > li:nth-child(1) { animation-delay: 0.1s; }
    #side-menu > li:nth-child(2) { animation-delay: 0.2s; }
    #side-menu > li:nth-child(3) { animation-delay: 0.3s; }
    #side-menu > li:nth-child(4) { animation-delay: 0.4s; }
    #side-menu > li:nth-child(5) { animation-delay: 0.5s; }
    #side-menu > li:nth-child(6) { animation-delay: 0.6s; }
    #side-menu > li:nth-child(7) { animation-delay: 0.7s; }
    
    /* Mobile specific styles */
    @media (max-width: 768px) {
        .left-side-menu {
            position: fixed;
            z-index: 1000;
            height: 100vh;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            width: 280px;
        }
        
        .left-side-menu.show {
            transform: translateX(0);
        }
        
        .menu-title {
            font-size: 0.7rem;
            margin: 1rem 0 0.3rem 0;
            padding: 0 1rem;
        }
        
        .menu-title::after {
            left: 1rem;
            width: 25px;
        }
        
        #side-menu > li > a {
            padding: 0.7rem 1rem;
            margin-right: 0.5rem;
            border-radius: 0 20px 20px 0;
        }
        
        #side-menu > li > a i {
            margin-right: 0.5rem;
        }
    }
    
    /* Responsive improvements */
    @media (max-width: 480px) {
        .menu-title {
            font-size: 0.65rem;
        }
        
        #side-menu > li > a {
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
        }
        
        #side-menu > li > a i {
            font-size: 0.9rem;
        }
    }
    
    /* Focus states for accessibility */
    #side-menu > li > a:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }
    
    /* Loading state */
    .sidebar-loading {
        opacity: 0.5;
        pointer-events: none;
    }
    
    /* Active page indicator */
    .mm-active > a {
        background: rgba(102, 126, 234, 0.1);
        color: var(--primary-color) !important;
        font-weight: 600;
    }
    
    .mm-active > a::after {
        transform: scaleY(1) !important;
    }
</style>

<!-- Left Sidebar End -->
