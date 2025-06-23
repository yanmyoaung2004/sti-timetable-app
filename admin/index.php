<?php
session_start();
include "../class/allclass.php";
$admin=new admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin Login - Time Table Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Background -->
    <div class="login-background"></div>
    
    <!-- Back to Home Button -->
    <div class="back-button">
        <a href="../index.php" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Home</span>
        </a>
    </div>

    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-lg-5 col-md-7 col-sm-9">
                    <div class="login-card">
                        <!-- Header -->
                        <div class="login-header">
                            <div class="icon-wrapper">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h2>Administrator Login</h2>
                            <p>Access the admin dashboard to manage the system</p>
                        </div>

                        <!-- Login Form -->
                        <form action="" method="post" class="login-form">
                            <?php
                            if(isset($_POST['login'])){
                                $username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                                $password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                                if(empty(trim($username)) || empty(trim($password))){
                                    echo "<div class='alert alert-warning alert-modern' role='alert'>
                                            <i class='fas fa-exclamation-triangle me-2'></i>
                                            Field Cannot Be Empty
                                          </div>";
                                }
                                else{
                                    $admin->admin_login($username,$password);
                                }
                            }
                            if(isset($_SESSION['login_error'])){
                                echo "<div class='alert alert-danger alert-modern' role='alert'>
                                        <i class='fas fa-exclamation-circle me-2'></i>
                                        ".$_SESSION['login_error']."
                                      </div>";
                                unset($_SESSION['login_error']);
                            }
                            ?>

                            <div class="form-group">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user me-2"></i>Email Address / Username
                                </label>
                                <input class="form-control form-control-modern" 
                                       type="text" 
                                       id="username" 
                                       name="username" 
                                       placeholder="Enter your username or email"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="password-wrapper">
                                    <input class="form-control form-control-modern" 
                                           type="password" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Enter your password"
                                           required>
                                    <button type="button" class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="remember-forgot">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="remember">
                                        <span class="checkmark"></span>
                                        Remember me
                                    </label>
                                    <a href="#" class="forgot-link">Forgot Password?</a>
                                </div>
                            </div>

                            <button class="btn btn-login" type="submit" name="login">
                                <span>Sign In as Admin</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>

                        <!-- Footer -->
                        <div class="login-footer">
                            <div class="security-notice">
                                <i class="fas fa-shield-alt me-2"></i>
                                <span>Secure Administrator Access</span>
                            </div>
                            <p>Need help? <a href="#" class="support-link">Contact IT Support</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        // Add floating label effect
        document.querySelectorAll('.form-control-modern').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
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
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    min-height: 100vh;
    position: relative;
}

.login-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('../assets/images/background.jpg') center/cover;
    opacity: 0.1;
    z-index: -1;
}

.back-button {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1000;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.2rem;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    text-decoration: none;
    transform: translateX(-5px);
}

.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 0;
}

.login-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    position: relative;
    animation: slideUp 0.6s ease-out;
}

.login-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff6b6b, #ee5a24);
}

.login-header {
    text-align: center;
    padding: 3rem 2rem 2rem;
    background: linear-gradient(135deg, rgba(255, 107, 107, 0.05), rgba(238, 90, 36, 0.05));
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
}

.icon-wrapper i {
    font-size: 2rem;
    color: white;
}

.login-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #2d3436;
    margin-bottom: 0.5rem;
}

.login-header p {
    color: #636e72;
    font-size: 1rem;
    font-weight: 300;
}

.login-form {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #2d3436;
    font-size: 0.9rem;
}

.form-control-modern {
    width: 100%;
    padding: 1rem 1.2rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    background: #f8f9fa;
    transition: all 0.3s ease;
    outline: none;
}

.form-control-modern:focus {
    border-color: #ff6b6b;
    background: white;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.1);
    transform: translateY(-2px);
}

.password-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #636e72;
    cursor: pointer;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #ff6b6b;
}

.remember-forgot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

.custom-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 0.9rem;
    color: #636e72;
}

.custom-checkbox input {
    display: none;
}

.checkmark {
    width: 18px;
    height: 18px;
    border: 2px solid #ddd;
    border-radius: 4px;
    margin-right: 0.5rem;
    position: relative;
    transition: all 0.3s ease;
}

.custom-checkbox input:checked + .checkmark {
    background: #ff6b6b;
    border-color: #ff6b6b;
}

.custom-checkbox input:checked + .checkmark::after {
    content: '';
    position: absolute;
    left: 4px;
    top: 1px;
    width: 4px;
    height: 8px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.forgot-link {
    color: #ff6b6b;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #ee5a24;
}

.btn-login {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1.5rem;
}

.btn-login:hover {
    background: linear-gradient(135deg, #ee5a24, #ff6b6b);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
}

.btn-login i {
    transition: transform 0.3s ease;
}

.btn-login:hover i {
    transform: translateX(5px);
}

.login-footer {
    text-align: center;
    padding: 1.5rem 2rem 2rem;
    background: rgba(248, 249, 250, 0.5);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.security-notice {
    display: inline-flex;
    align-items: center;
    color: #28a745;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 1rem;
    padding: 0.5rem 1rem;
    background: rgba(40, 167, 69, 0.1);
    border-radius: 20px;
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.login-footer p {
    color: #636e72;
    font-size: 0.9rem;
    margin: 0;
}

.support-link {
    color: #ff6b6b;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.support-link:hover {
    color: #ee5a24;
}

.alert-modern {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.2rem;
    margin-bottom: 1.5rem;
    color: white;
    border-left: 4px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: opacity 0.3s ease;
}

.alert-danger {
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
}

.alert-warning {
    background: linear-gradient(135deg, #ffa726, #ff9800);
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .login-card {
        margin: 1rem;
        border-radius: 15px;
    }
    
    .login-header {
        padding: 2rem 1.5rem 1.5rem;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
    }
    
    .icon-wrapper i {
        font-size: 1.5rem;
    }
    
    .login-header h2 {
        font-size: 1.6rem;
    }
    
    .login-form {
        padding: 1.5rem;
    }
    
    .back-button {
        top: 15px;
        left: 15px;
    }
    
    .btn-back {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .remember-forgot {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .login-header h2 {
        font-size: 1.4rem;
    }
    
    .login-header p {
        font-size: 0.9rem;
    }
    
    .security-notice {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
}
</style>
