<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="dashboard.php" class="waves-effect">
                        <i class="fas fa-tachometer-alt"></i>
                        <span> Dashboard </span>
                        <span class="menu-badge">
                            <i class="fas fa-circle"></i>
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
                <li class="d-md-none d-sm-block">
                    <a href="view-time-table.php" class="waves-effect">
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
    
    .badge-info {
        color: #4facfe;
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
        
        #side-menu > li > a {
            padding: 0.7rem 1rem;
            margin-right: 0.5rem;
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
</style>

<!-- Left Sidebar End -->
