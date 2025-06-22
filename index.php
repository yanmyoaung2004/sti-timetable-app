<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Xeria - Time Table Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Background overlay -->
    <div class="bg-overlay"></div>
    
    <div class="container-fluid main-container">
        <!-- Header -->
        <div class="row header-section">
            <div class="col-12 text-center">
                <div class="logo-container">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <h1 class="main-title">Time Table Management System</h1>
                    <p class="subtitle">Streamline your academic scheduling with ease</p>
                </div>
            </div>
        </div>

        <!-- Login Cards -->
        <div class="row login-cards justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-8 mb-4">
                <div class="login-card admin-card">
                    <div class="card-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3>Administrator</h3>
                    <p>Manage system settings, users, and schedules</p>
                    <a href="admin/index.php" class="btn-login">
                        <span>Login as Admin</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-8 mb-4">
                <div class="login-card lecturer-card">
                    <div class="card-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Lecturer</h3>
                    <p>View and manage your teaching schedules</p>
                    <a href="lecturer/index.php" class="btn-login">
                        <span>Login as Lecturer</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-8 mb-4">
                <div class="login-card student-card">
                    <div class="card-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3>Student</h3>
                    <p>Access your class schedules and timetables</p>
                    <a href="student/index.php" class="btn-login">
                        <span>Login as Student</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        <?php if(isset($_SESSION['check_error'])): ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo $_SESSION['check_error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Features Section -->
        <div class="row features-section mt-5">
            <div class="col-12 text-center mb-4">
                <h2 class="section-title">Key Features</h2>
            </div>
            <div class="col-md-4 text-center mb-3">
                <div class="feature-item">
                    <i class="fas fa-clock fa-2x mb-3"></i>
                    <h5>Real-time Updates</h5>
                    <p>Get instant notifications about schedule changes</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-3">
                <div class="feature-item">
                    <i class="fas fa-mobile-alt fa-2x mb-3"></i>
                    <h5>Mobile Responsive</h5>
                    <p>Access your timetable from any device, anywhere</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-3">
                <div class="feature-item">
                    <i class="fas fa-users fa-2x mb-3"></i>
                    <h5>Multi-user Support</h5>
                    <p>Separate dashboards for admins, lecturers, and students</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container text-center">
            <p>&copy; 2024 Time Table Management System. Developed with <i class="fas fa-heart text-danger"></i> by <a href="#" class="footer-link">Developer</a></p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: #1a1a1a;
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}

.bg-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        135deg,
        rgba(102, 126, 234, 0.9) 0%,
        rgba(118, 75, 162, 0.9) 100%
    ),
    url('assets/images/background.jpg') center/cover;
    z-index: -1;
}

.main-container {
    min-height: 100vh;
    padding: 2rem 0;
    position: relative;
    z-index: 1;
}

.header-section {
    margin-bottom: 3rem;
}

.logo-container {
    color: white;
    animation: fadeInDown 1s ease-out;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
}

.main-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.7);
}

.subtitle {
    font-size: 1.2rem;
    opacity: 0.95;
    font-weight: 300;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
}

.login-cards {
    margin-bottom: 4rem;
}

.login-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 2.5rem 1.5rem;
    text-align: center;
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    height: 320px;
    position: relative;
    overflow: hidden;
    border: none;
}

.login-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.login-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 35px 70px rgba(0,0,0,0.3);
    background: rgba(255, 255, 255, 0.98);
}

.admin-card:hover::before {
    background: linear-gradient(90deg, #ff6b6b, #ee5a24);
}

.lecturer-card:hover::before {
    background: linear-gradient(90deg, #4834d4, #686de0);
}

.student-card:hover::before {
    background: linear-gradient(90deg, #00d2d3, #54a0ff);
}

.card-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    color: #667eea;
    transition: all 0.3s ease;
}

.admin-card:hover .card-icon {
    color: #ff6b6b;
    transform: scale(1.1);
}

.lecturer-card:hover .card-icon {
    color: #4834d4;
    transform: scale(1.1);
}

.student-card:hover .card-icon {
    color: #00d2d3;
    transform: scale(1.1);
}

.login-card h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #2d3436;
}

.login-card p {
    color: #636e72;
    margin-bottom: 2rem;
    font-size: 0.95rem;
    line-height: 1.5;
}

.btn-login {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 2rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-login:hover {
    background: linear-gradient(135deg, #764ba2, #667eea);
    color: white;
    transform: scale(1.05);
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.btn-login i {
    transition: transform 0.3s ease;
}

.btn-login:hover i {
    transform: translateX(5px);
}

.features-section {
    color: white;
    margin-top: 4rem;
}

.section-title {
    font-size: 2.2rem;
    font-weight: 600;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.feature-item {
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.feature-item:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.feature-item i {
    color: #ffd700;
    margin-bottom: 1rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.feature-item h5 {
    font-weight: 600;
    margin-bottom: 0.8rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.feature-item p {
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.main-footer {
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 1.5rem 0;
    margin-top: 3rem;
    backdrop-filter: blur(10px);
}

.footer-link {
    color: #667eea;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-link:hover {
    color: #764ba2;
}

.alert {
    border: none;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

/* Floating animation for cards */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.login-card:nth-child(1) {
    animation: float 6s ease-in-out infinite;
}

.login-card:nth-child(2) {
    animation: float 6s ease-in-out infinite 2s;
}

.login-card:nth-child(3) {
    animation: float 6s ease-in-out infinite 4s;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Particle effect */
.bg-overlay::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.2), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(255,255,255,0.3), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.2), transparent),
        radial-gradient(2px 2px at 160px 30px, rgba(255,255,255,0.1), transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: sparkle 20s linear infinite;
}

@keyframes sparkle {
    from { transform: translateX(0); }
    to { transform: translateX(200px); }
}

@media (max-width: 768px) {
    .main-title {
        font-size: 2rem;
    }
    
    .subtitle {
        font-size: 1rem;
    }
    
    .login-card {
        margin-bottom: 2rem;
        height: auto;
        min-height: 280px;
        animation: none; /* Disable floating on mobile */
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .main-container {
        padding: 1rem 0;
    }
}

@media (max-width: 576px) {
    .main-title {
        font-size: 1.5rem;
    }
    
    .login-card {
        padding: 2rem 1rem;
    }
    
    .btn-login {
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .card-icon {
        font-size: 2.5rem;
    }
}
</style>
