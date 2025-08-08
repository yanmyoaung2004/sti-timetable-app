<?php
session_start();
include '../class/allclass.php';
$admin=new admin();
$dept=new dept();
$lecturer=new lecturer();
$room=new room();
$time=new time();
$course=new course();
$session=new session();
$student=new student();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Time Table Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Advanced Time Table Management System with modern UI/UX" name="description" />
    <meta content="TTMS Team" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <!-- App favicon -->
    <link href="../assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    
    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Required CSS for forms -->
    <link href="../assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
    
    <!-- Datatable -->
    <link href="../assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Modern Header Start -->
        <header class="navbar-custom">
            <!-- Left Section -->
            <div class="navbar-left">
                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggle" id="mobileMenuToggle" onclick="toggleSidebar()">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>

                <!-- Logo Section -->
                <div class="navbar-brand">
                    <a href="dashboard.php" class="brand-link">
                        <div class="brand-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="brand-content">
                            <h4 class="brand-title">STI-TTMS</h4>
                            <span class="brand-subtitle">Time Table Management</span>
                        </div>
                    </a>
                </div>

                <!-- Quick Actions (Desktop) -->
                <div class="quick-actions d-none d-lg-flex">
                    <button class="quick-btn" data-toggle="tooltip" title="Generate Timetable">
                        <i class="fas fa-magic"></i>
                    </button>
                </div>
            </div>

            <!-- Center Section - Search -->
            <div class="navbar-center d-none d-md-flex">
                <div class="global-search">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search anything..." id="globalSearch">
                        <div class="search-suggestions" id="searchSuggestions">
                            <div class="suggestion-category">
                                <h6>Quick Access</h6>
                                <a href="view-time-table.php" class="suggestion-item">
                                    <i class="fas fa-calendar"></i>View Timetable
                                </a>
                                <a href="course-assigned.php" class="suggestion-item">
                                    <i class="fas fa-book"></i>Courses Assigned
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="navbar-right">
                <!-- Status Indicators -->
                <div class="status-indicators d-none d-lg-flex">
                    <div class="status-item" data-toggle="tooltip" title="System Status">
                        <div class="status-dot status-online"></div>
                        <span class="status-text">Online</span>
                    </div>
                    <div class="status-item" data-toggle="tooltip" title="Last Update">
                        <i class="fas fa-sync-alt"></i>
                        <span class="status-text" id="lastUpdate">Just now</span>
                    </div>
                </div>

                <!-- Theme Toggle -->
                <button class="theme-toggle" id="themeToggle" data-toggle="tooltip" title="Toggle Dark Mode">
                    <i class="fas fa-moon"></i>
                </button>

                <!-- Fullscreen Toggle -->
                <button class="fullscreen-toggle d-none d-md-block" id="fullscreenToggle" data-toggle="tooltip" title="Fullscreen">
                    <i class="fas fa-expand"></i>
                </button>

                <!-- User Profile Dropdown -->
                <div class="user-dropdown">
                    <button class="user-profile-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-avatar">
                            <div class="status-indicator online"></div>
                        </div>
                        <div class="user-info d-none d-sm-block">
                            <span class="user-name">Admin</span>
                            <span class="user-role">Administrator</span>
                        </div>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right user-dropdown-menu">
                        <div class="dropdown-divider"></div>

                        <!-- Menu Items -->
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            <span>Welcome!</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-question-circle"></i>
                            <span>Help & Support</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- Quick Stats -->
                        <div class="dropdown-stats">
                            <div class="stat-item">
                                <span class="stat-value">12</span>
                                <span class="stat-label">Active Sessions</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">3</span>
                                <span class="stat-label">Pending Tasks</span>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <a href="logout.php" class="dropdown-item logout-item">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <style>
            :root {
                --header-height: 70px;
                --header-bg: rgba(255, 255, 255, 0.98);
                --header-border: rgba(0, 0, 0, 0.06);
                --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                --text-primary: #2d3748;
                --text-secondary: #718096;
                --text-muted: #a0aec0;
                --accent-color: #667eea;
                --success-color: #48bb78;
                --warning-color: #ed8936;
                --danger-color: #f56565;
                --info-color: #4facfe;
                --shadow-light: 0 2px 20px rgba(0, 0, 0, 0.08);
                --shadow-medium: 0 4px 30px rgba(0, 0, 0, 0.12);
                --border-radius: 12px;
                --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .navbar-custom {
                background: var(--header-bg);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid var(--header-border);
                box-shadow: var(--shadow-light);
                height: var(--header-height);
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1001;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 1.5rem;
                transition: var(--transition);
            }

            /* Left Section */
            .navbar-left {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                flex: 1;
            }

            /* Mobile Menu Toggle */
            .navbar-toggle {
                display: none;
                flex-direction: column;
                background: transparent;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 8px;
                justify-content: center;
                align-items: center;
                gap: 4px;
                transition: var(--transition);
                cursor: pointer;
            }

            .navbar-toggle:hover {
                background: rgba(102, 126, 234, 0.1);
            }

            .hamburger-line {
                width: 20px;
                height: 2px;
                background: var(--text-primary);
                border-radius: 2px;
                transition: var(--transition);
            }

            .navbar-toggle:hover .hamburger-line {
                background: var(--accent-color);
            }

            /* Brand Section */
            .navbar-brand {
                margin-left: 0;
            }

            .brand-link {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                text-decoration: none;
                padding: 0.5rem;
                border-radius: var(--border-radius);
                transition: var(--transition);
                position: relative;
                overflow: hidden;
            }

            .brand-link::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: var(--primary-gradient);
                transition: left 0.4s ease;
                z-index: -1;
                border-radius: var(--border-radius);
            }

            .brand-link:hover::before {
                left: 0;
            }

            .brand-link:hover .brand-title,
            .brand-link:hover .brand-subtitle {
                color: white;
            }

            .brand-icon {
                width: 45px;
                height: 45px;
                background: var(--primary-gradient);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.3rem;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            }

            .brand-content {
                line-height: 1.2;
            }

            .brand-title {
                font-size: 1.4rem;
                font-weight: 700;
                margin: 0;
                color: var(--text-primary);
                letter-spacing: -0.5px;
                transition: var(--transition);
            }

            .brand-subtitle {
                font-size: 0.75rem;
                color: var(--text-muted);
                font-weight: 400;
                transition: var(--transition);
            }

            /* Quick Actions */
            .quick-actions {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-left: 2rem;
            }

            .quick-btn {
                width: 42px;
                height: 42px;
                background: rgba(102, 126, 234, 0.08);
                border: none;
                border-radius: 10px;
                color: var(--accent-color);
                font-size: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: var(--transition);
                position: relative;
                cursor: pointer;
            }

            .quick-btn:hover {
                background: var(--accent-color);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            }

            /* Center Section - Search */
            .navbar-center {
                flex: 2;
                max-width: 500px;
                margin: 0 2rem;
            }

            .global-search {
                position: relative;
                width: 100%;
            }

            .search-container {
                position: relative;
            }

            .search-input {
                width: 100%;
                height: 45px;
                background: rgba(102, 126, 234, 0.05);
                border: 1px solid rgba(102, 126, 234, 0.1);
                border-radius: 25px;
                padding: 0 1rem 0 3rem;
                font-size: 0.9rem;
                color: var(--text-primary);
                transition: var(--transition);
            }

            .search-input:focus {
                outline: none;
                background: rgba(102, 126, 234, 0.08);
                border-color: var(--accent-color);
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .search-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            .search-suggestions {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-medium);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: var(--transition);
                margin-top: 0.5rem;
                padding: 1rem;
            }

            .search-input:focus + .search-suggestions,
            .search-suggestions:hover {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .suggestion-category h6 {
                color: var(--text-muted);
                font-size: 0.75rem;
                text-transform: uppercase;
                font-weight: 600;
                margin-bottom: 0.5rem;
                letter-spacing: 0.5px;
            }

            .suggestion-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.5rem 0.75rem;
                border-radius: 8px;
                color: var(--text-secondary);
                text-decoration: none;
                font-size: 0.85rem;
                transition: var(--transition);
            }

            .suggestion-item:hover {
                background: rgba(102, 126, 234, 0.08);
                color: var(--accent-color);
                text-decoration: none;
            }

            /* Right Section */
            .navbar-right {
                display: flex;
                align-items: center;
                gap: 1rem;
                flex: 1;
                justify-content: flex-end;
            }

            /* Status Indicators */
            .status-indicators {
                display: flex;
                align-items: center;
                gap: 1.5rem;
            }

            .status-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.8rem;
                color: var(--text-muted);
            }

            .status-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                animation: pulse-dot 2s infinite;
            }

            .status-online { 
                background: var(--success-color); 
            }

            .status-text {
                font-weight: 500;
            }

            /* Theme Toggle */
            .theme-toggle,
            .fullscreen-toggle {
                width: 40px;
                height: 40px;
                background: rgba(102, 126, 234, 0.08);
                border: none;
                border-radius: 10px;
                color: var(--text-secondary);
                font-size: 0.9rem;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: var(--transition);
                cursor: pointer;
            }

            .theme-toggle:hover,
            .fullscreen-toggle:hover {
                background: var(--accent-color);
                color: white;
                transform: scale(1.05);
            }

            /* User Dropdown */
            .user-dropdown {
                position: relative;
            }

            .user-profile-btn {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                background: transparent;
                border: none;
                padding: 0.5rem;
                border-radius: var(--border-radius);
                transition: var(--transition);
                cursor: pointer;
            }

            .user-profile-btn:hover {
                background: rgba(102, 126, 234, 0.05);
            }

            .user-avatar {
                position: relative;
                width: 42px;
                height: 42px;
                background: var(--primary-gradient);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.2rem;
            }

            .status-indicator {
                position: absolute;
                bottom: 2px;
                right: 2px;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                border: 2px solid white;
            }

            .status-indicator.online {
                background: var(--success-color);
            }

            .user-info {
                text-align: left;
                line-height: 1.3;
            }

            .user-name {
                display: block;
                font-weight: 600;
                font-size: 0.9rem;
                color: var(--text-primary);
            }

            .user-role {
                font-size: 0.75rem;
                color: var(--text-muted);
            }

            .dropdown-arrow {
                font-size: 0.7rem;
                color: var(--text-muted);
                transition: var(--transition);
            }

            .user-profile-btn[aria-expanded="true"] .dropdown-arrow {
                transform: rotate(180deg);
            }

            /* Dropdown Menu */
            .user-dropdown-menu {
                min-width: 280px;
                padding: 0;
                border: none;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-medium);
                margin-top: 0.5rem;
            }

            .dropdown-item {
                padding: 0.75rem 1.5rem;
                font-size: 0.85rem;
                color: var(--text-secondary);
                display: flex;
                align-items: center;
                gap: 0.75rem;
                transition: var(--transition);
                text-decoration: none;
            }

            .dropdown-item:hover {
                background: rgba(102, 126, 234, 0.05);
                color: var(--accent-color);
                text-decoration: none;
            }

            .dropdown-item i {
                width: 16px;
                text-align: center;
            }

            .dropdown-stats {
                padding: 1rem 1.5rem;
                background: rgba(102, 126, 234, 0.02);
                display: flex;
                gap: 2rem;
            }

            .stat-item {
                text-align: center;
                flex: 1;
            }

            .stat-value {
                display: block;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--accent-color);
            }

            .stat-label {
                font-size: 0.7rem;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .logout-item {
                color: var(--danger-color) !important;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
            }

            .logout-item:hover {
                background: rgba(245, 101, 101, 0.05) !important;
            }

            /* Animations */
            @keyframes pulse-dot {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }

            /* Responsive Design */
            @media (max-width: 1024px) {
                .quick-actions,
                .status-indicators {
                    display: none !important;
                }

                .navbar-center {
                    margin: 0 1rem;
                    max-width: 300px;
                }
            }

            @media (max-width: 768px) {
                .navbar-custom {
                    padding: 0 1rem;
                }

                .navbar-toggle {
                    display: flex;
                }

                .navbar-center {
                    display: none !important;
                }

                .user-info {
                    display: none !important;
                }

                .brand-subtitle {
                    display: none;
                }

                .brand-title {
                    font-size: 1.2rem;
                }

                .user-dropdown-menu {
                    min-width: 250px;
                    right: 0 !important;
                    left: auto !important;
                }
            }

            /* Dark Mode Styles */
            body.dark-mode {
                --header-bg: rgba(26, 32, 44, 0.98);
                --header-border: rgba(255, 255, 255, 0.08);
                --text-primary: #e2e8f0;
                --text-secondary: #a0aec0;
                --text-muted: #718096;
                background-color: #1a202c;
                color: #e2e8f0;
            }

            body.dark-mode .navbar-custom {
                background: var(--header-bg);
                border-bottom: 1px solid var(--header-border);
            }

            body.dark-mode .search-input {
                background: rgba(255, 255, 255, 0.05);
                border-color: rgba(255, 255, 255, 0.1);
                color: #e2e8f0;
            }

            body.dark-mode .search-input:focus {
                background: rgba(255, 255, 255, 0.08);
                border-color: var(--accent-color);
            }

            body.dark-mode .search-input::placeholder {
                color: #718096;
            }

            body.dark-mode .search-suggestions {
                background: #2d3748;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            body.dark-mode .suggestion-item:hover {
                background: rgba(102, 126, 234, 0.2);
            }

            body.dark-mode .dropdown-menu {
                background: #2d3748;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            body.dark-mode .dropdown-stats {
                background: rgba(102, 126, 234, 0.1);
            }

            body.dark-mode .hamburger-line {
                background: #e2e8f0;
            }

            body.dark-mode .navbar-toggle:hover .hamburger-line {
                background: var(--accent-color);
            }

            /* Adjust body padding for fixed header */
            body {
                padding-top: var(--header-height);
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            /* Sidebar adjustment for header */
            .left-side-menu {
                top: var(--header-height);
                height: calc(100vh - var(--header-height));
            }
        </style>

        <!-- Header JavaScript -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Theme toggle functionality
                const themeToggle = document.getElementById('themeToggle');
                if (themeToggle) {
                    const themeIcon = themeToggle.querySelector('i');
                    
                    let isDark = localStorage.getItem('darkMode') === 'true';
                    updateTheme();

                    themeToggle.addEventListener('click', function() {
                        isDark = !isDark;
                        localStorage.setItem('darkMode', isDark);
                        updateTheme();
                    });

                    function updateTheme() {
                        if (isDark) {
                            document.body.classList.add('dark-mode');
                            if (themeIcon) {
                                themeIcon.className = 'fas fa-sun';
                            }
                        } else {
                            document.body.classList.remove('dark-mode');
                            if (themeIcon) {
                                themeIcon.className = 'fas fa-moon';
                            }
                        }
                    }
                }

                // Fullscreen toggle
                const fullscreenToggle = document.getElementById('fullscreenToggle');
                if (fullscreenToggle) {
                    const fullscreenIcon = fullscreenToggle.querySelector('i');

                    fullscreenToggle.addEventListener('click', function() {
                        try {
                            if (!document.fullscreenElement) {
                                document.documentElement.requestFullscreen().catch(err => {
                                    console.log('Error attempting to enable fullscreen:', err);
                                });
                                if (fullscreenIcon) {
                                    fullscreenIcon.className = 'fas fa-compress';
                                }
                            } else {
                                document.exitFullscreen().catch(err => {
                                    console.log('Error attempting to exit fullscreen:', err);
                                });
                                if (fullscreenIcon) {
                                    fullscreenIcon.className = 'fas fa-expand';
                                }
                            }
                        } catch (error) {
                            console.log('Fullscreen not supported:', error);
                        }
                    });
                }

                // Update last update time
                function updateLastUpdateTime() {
                    const now = new Date();
                    const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    const lastUpdateElement = document.getElementById('lastUpdate');
                    if (lastUpdateElement) {
                        lastUpdateElement.textContent = timeString;
                    }
                }

                // Update time every minute
                updateLastUpdateTime();
                setInterval(updateLastUpdateTime, 60000);

                // Global search functionality
                const globalSearch = document.getElementById('globalSearch');
                const searchSuggestions = document.getElementById('searchSuggestions');

                if (globalSearch) {
                    globalSearch.addEventListener('focus', function() {
                        searchSuggestions.style.opacity = '1';
                        searchSuggestions.style.visibility = 'visible';
                        searchSuggestions.style.transform = 'translateY(0)';
                    });

                    globalSearch.addEventListener('blur', function(e) {
                        // Delay hiding to allow clicking on suggestions
                        setTimeout(function() {
                            if (!searchSuggestions.matches(':hover')) {
                                searchSuggestions.style.opacity = '0';
                                searchSuggestions.style.visibility = 'hidden';
                                searchSuggestions.style.transform = 'translateY(-10px)';
                            }
                        }, 200);
                    });

                    // Search functionality
                    globalSearch.addEventListener('input', function() {
                        const query = this.value.toLowerCase();
                        const suggestions = searchSuggestions.querySelectorAll('.suggestion-item');
                        
                        suggestions.forEach(function(suggestion) {
                            const text = suggestion.textContent.toLowerCase();
                            if (text.includes(query) || query === '') {
                                suggestion.style.display = 'flex';
                            } else {
                                suggestion.style.display = 'none';
                            }
                        });
                    });

                    // Handle Enter key for search
                    globalSearch.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            const query = this.value.trim();
                            if (query) {
                                // Redirect to search results page or perform search
                                window.location.href = 'search.php?q=' + encodeURIComponent(query);
                            }
                        }
                    });
                }

                // Initialize tooltips
                if (typeof $ !== 'undefined' && $.fn.tooltip) {
                    $('[data-toggle="tooltip"]').tooltip({
                        placement: 'bottom',
                        trigger: 'hover',
                        container: 'body'
                    });
                }

                // Quick action buttons functionality
                const quickBtns = document.querySelectorAll('.quick-btn');
                quickBtns.forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        // Add click animation
                        this.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);

                        // Handle specific actions
                        const icon = this.querySelector('i');
                        if (icon.classList.contains('fa-magic')) {
                            window.location.href = 'view-time-table.php';
                        }
                    });
                });

                // Sidebar toggle function (called from mobile menu)
                window.toggleSidebar = function() {
                    const sidebar = document.querySelector('.left-side-menu');
                    const overlay = document.querySelector('.sidebar-overlay');
                    
                    if (sidebar) {
                        sidebar.classList.toggle('show');
                        
                        // Create overlay if it doesn't exist
                        if (!overlay && sidebar.classList.contains('show')) {
                            const sidebarOverlay = document.createElement('div');
                            sidebarOverlay.className = 'sidebar-overlay';
                            sidebarOverlay.addEventListener('click', function() {
                                sidebar.classList.remove('show');
                                this.remove();
                            });
                            document.body.appendChild(sidebarOverlay);
                        } else if (overlay && !sidebar.classList.contains('show')) {
                            overlay.remove();
                        }
                    }
                };

                // Header scroll behavior
                let lastScrollTop = 0;
                window.addEventListener('scroll', function() {
                    const header = document.querySelector('.navbar-custom');
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    
                    if (scrollTop > lastScrollTop && scrollTop > 100) {
                        // Scrolling down
                        header.style.transform = 'translateY(-100%)';
                    } else {
                        // Scrolling up
                        header.style.transform = 'translateY(0)';
                    }
                    
                    lastScrollTop = scrollTop;
                });

                // Real-time updates simulation
                function simulateRealTimeUpdates() {
                    const statusText = document.getElementById('lastUpdate');
                    if (statusText) {
                        const now = new Date();
                        const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                        statusText.textContent = timeString;
                    }
                }

                // Update every 30 seconds
                setInterval(simulateRealTimeUpdates, 30000);
            });
        </script>

        <!-- Sidebar Toggle for Mobile -->
        <style>
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                backdrop-filter: blur(4px);
                opacity: 0;
                animation: fadeIn 0.3s ease forwards;
            }

            @keyframes fadeIn {
                to { opacity: 1; }
            }

            /* Mobile sidebar styles */
            @media (max-width: 768px) {
                .left-side-menu {
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                    position: fixed;
                    z-index: 1000;
                }

                .left-side-menu.show {
                    transform: translateX(0);
                }
            }
        </style>
        <!-- end Topbar -->
