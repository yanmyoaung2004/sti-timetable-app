<?php
session_start();
include '../class/allclass.php';
$dept=new dept();
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
    <title>Student Registration - Time to Class</title>
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
    <div class="register-background"></div>
    
    <!-- Back to Login Button -->
    <div class="back-button">
        <a href="index.php" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Login</span>
        </a>
    </div>

    <div class="register-container">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-lg-8 col-md-10">
                    <div class="register-card">
                        <!-- Header -->
                        <div class="register-header">
                            <div class="icon-wrapper">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h2>Student Registration</h2>
                            <p>Join our academic community and access your timetables</p>
                        </div>

                        <!-- Registration Form -->
                        <form action="" method="post" class="register-form" id="registrationForm">
                            <?php
                            if (isset($_POST['submit'])) {
                                $fname    = $_POST['fname'];
                                $lname    = $_POST['lname'];
                                $matric   = $_POST['matric'];
                                $email    = $_POST['email'];
                                $phone    = $_POST['phone'];
                                $password = $_POST['password']; // plain password here, hashing happens in student_reg()
                                $dept     = $_POST['dept'];

                                // Call student_reg() once
                                $result = $student->student_reg($fname, $lname, $matric, $email, $phone, $password, $dept);

                                if ($result === true) {
                                    // Success
                                    echo "<div class='alert alert-success alert-modern' role='alert'>
                                            <i class='fas fa-check-circle me-2'></i>
                                            Account Has Been Created Successfully! Redirecting to login...
                                        </div>
                                        <script type='text/javascript'>
                                            setTimeout(function(){ window.location.href='index.php'; }, 3000);
                                        </script>";
                                } elseif ($result === 3) {
                                    // Already exists
                                    echo "<div class='alert alert-danger alert-modern' role='alert'>
                                            <i class='fas fa-exclamation-circle me-2'></i>
                                            Account Already Exists! Please try with different details.
                                        </div>";
                                } else {
                                    // Something went wrong
                                    echo "<div class='alert alert-danger alert-modern' role='alert'>
                                            <i class='fas fa-exclamation-triangle me-2'></i>
                                            Something Went Wrong! Please try again.
                                        </div>";
                                }
                            }
                            ?>

                            <!-- Progress Indicator -->
                            <div class="progress-indicator">
                                <div class="step active" data-step="1">
                                    <i class="fas fa-user"></i>
                                    <span>Personal Info</span>
                                </div>
                                <div class="step" data-step="2">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Academic Info</span>
                                </div>
                                <div class="step" data-step="3">
                                    <i class="fas fa-check"></i>
                                    <span>Complete</span>
                                </div>
                            </div>

                            <!-- Step 1: Personal Information -->
                            <div class="form-step active" id="step1">
                                <h4 class="step-title">
                                    <i class="fas fa-user me-2"></i>Personal Information
                                </h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname" class="form-label">
                                                <i class="fas fa-user me-2"></i>First Name
                                            </label>
                                            <input class="form-control form-control-modern" 
                                                   type="text" 
                                                   id="fname" 
                                                   name="fname" 
                                                   placeholder="Enter your first name"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lname" class="form-label">
                                                <i class="fas fa-user me-2"></i>Last Name
                                            </label>
                                            <input class="form-control form-control-modern" 
                                                   type="text" 
                                                   id="lname" 
                                                   name="lname" 
                                                   placeholder="Enter your last name"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope me-2"></i>Email Address
                                            </label>
                                            <input class="form-control form-control-modern" 
                                                   type="email" 
                                                   id="email" 
                                                   name="email" 
                                                   placeholder="Enter your email address"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">
                                                <i class="fas fa-phone me-2"></i>Phone Number
                                            </label>
                                            <input class="form-control form-control-modern" 
                                                   type="tel" 
                                                   id="phone" 
                                                   name="phone" 
                                                   placeholder="Enter your phone number"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="btn btn-next" onclick="nextStep(1)">
                                        <span>Next</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Academic Information -->
                            <div class="form-step" id="step2">
                                <h4 class="step-title">
                                    <i class="fas fa-graduation-cap me-2"></i>Academic Information
                                </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="matric" class="form-label">
                                                <i class="fas fa-id-card me-2"></i>Matric Number
                                            </label>
                                            <input class="form-control form-control-modern" 
                                                   type="text" 
                                                   id="matric" 
                                                   name="matric" 
                                                   placeholder="Enter your matric number"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="form-label">
                                                <i class="fas fa-lock me-2"></i>Password
                                            </label>
                                            <div class="password-wrapper">
                                                <input class="form-control form-control-modern" 
                                                       type="password" 
                                                       id="password" 
                                                       name="password" 
                                                       placeholder="Create a strong password"
                                                       required>
                                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                                    <i class="fas fa-eye" id="password-icon"></i>
                                                </button>
                                            </div>
                                            <div class="password-strength">
                                                <div class="strength-bar">
                                                    <div class="strength-fill" id="strengthFill"></div>
                                                </div>
                                                <span class="strength-text" id="strengthText">Password strength</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="dept" class="form-label">
                                        <i class="fas fa-building me-2"></i>Department
                                    </label>
                                    <select class="form-control form-control-modern" name="dept" id="dept" required>
                                        <option value="" disabled selected>Select your department</option>
                                        <?php
                                        $dept_list=$dept->list_dept();
                                        foreach ($dept_list as $dept_item) { ?>
                                            <option value="<?php echo $dept_item->dept_id?>"><?php echo $dept_item->dept_title?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="btn btn-prev" onclick="prevStep(2)">
                                        <i class="fas fa-arrow-left"></i>
                                        <span>Previous</span>
                                    </button>
                                    <button type="button" class="btn btn-next" onclick="nextStep(2)">
                                        <span>Review</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Review and Submit -->
                            <div class="form-step" id="step3">
                                <h4 class="step-title">
                                    <i class="fas fa-check me-2"></i>Review Your Information
                                </h4>

                                <div class="review-section">
                                    <div class="review-card">
                                        <h5><i class="fas fa-user me-2"></i>Personal Details</h5>
                                        <div class="review-item">
                                            <span class="label">Name:</span>
                                            <span class="value" id="reviewName">-</span>
                                        </div>
                                        <div class="review-item">
                                            <span class="label">Email:</span>
                                            <span class="value" id="reviewEmail">-</span>
                                        </div>
                                        <div class="review-item">
                                            <span class="label">Phone:</span>
                                            <span class="value" id="reviewPhone">-</span>
                                        </div>
                                    </div>

                                    <div class="review-card">
                                        <h5><i class="fas fa-graduation-cap me-2"></i>Academic Details</h5>
                                        <div class="review-item">
                                            <span class="label">Matric Number:</span>
                                            <span class="value" id="reviewMatric">-</span>
                                        </div>
                                        <div class="review-item">
                                            <span class="label">Department:</span>
                                            <span class="value" id="reviewDept">-</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="terms-agreement">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" id="termsCheck" required>
                                        <span class="checkmark"></span>
                                        I agree to the <a href="#" class="terms-link">Terms and Conditions</a> and <a href="#" class="terms-link">Privacy Policy</a>
                                    </label>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="btn btn-prev" onclick="prevStep(3)">
                                        <i class="fas fa-arrow-left"></i>
                                        <span>Previous</span>
                                    </button>
                                    <button class="btn btn-submit" type="submit" name="submit">
                                        <span>Create Account</span>
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Footer -->
                        <div class="register-footer">
                            <p>Already have an account? <a href="index.php" class="login-link">Sign In Here</a></p>
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
        let currentStep = 1;
        const totalSteps = 3;

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

        function nextStep(step) {
            if (validateStep(step)) {
                currentStep++;
                updateStepDisplay();
                if (currentStep === 3) {
                    updateReview();
                }
            }
        }

        function prevStep(step) {
            currentStep--;
            updateStepDisplay();
        }

        function updateStepDisplay() {
            // Update form steps
            document.querySelectorAll('.form-step').forEach(step => {
                step.classList.remove('active');
            });
            document.getElementById(`step${currentStep}`).classList.add('active');

            // Update progress indicator
            document.querySelectorAll('.step').forEach((step, index) => {
                if (index < currentStep) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });
        }

        function validateStep(step) {
            const currentStepElement = document.getElementById(`step${step}`);
            const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('error');
                    isValid = false;
                } else {
                    input.classList.remove('error');
                }
            });

            if (!isValid) {
                showAlert('Please fill in all required fields.', 'warning');
            }

            return isValid;
        }

        function updateReview() {
            document.getElementById('reviewName').textContent = 
                `${document.getElementById('fname').value} ${document.getElementById('lname').value}`;
            document.getElementById('reviewEmail').textContent = document.getElementById('email').value;
            document.getElementById('reviewPhone').textContent = document.getElementById('phone').value;
            document.getElementById('reviewMatric').textContent = document.getElementById('matric').value;
            
            const deptSelect = document.getElementById('dept');
            document.getElementById('reviewDept').textContent = 
                deptSelect.options[deptSelect.selectedIndex].text;
        }

        function showAlert(message, type) {
            // Create alert element
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-modern`;
            alertDiv.innerHTML = `<i class="fas fa-exclamation-triangle me-2"></i>${message}`;
            
            // Insert at top of form
            const form = document.querySelector('.register-form');
            form.insertBefore(alertDiv, form.firstChild);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let text = 'Weak';
            let color = '#ff6b6b';
            
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            switch(strength) {
                case 0:
                case 1:
                    text = 'Very Weak';
                    color = '#ff6b6b';
                    break;
                case 2:
                    text = 'Weak';
                    color = '#ffa726';
                    break;
                case 3:
                    text = 'Fair';
                    color = '#ffeb3b';
                    break;
                case 4:
                    text = 'Good';
                    color = '#66bb6a';
                    break;
                case 5:
                    text = 'Strong';
                    color = '#4caf50';
                    break;
            }
            
            strengthFill.style.width = `${(strength / 5) * 100}%`;
            strengthFill.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

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
    background: linear-gradient(135deg, #00d2d3 0%, #54a0ff 100%);
    min-height: 100vh;
    position: relative;
}

.register-background {
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

.register-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 0;
}

.register-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    position: relative;
    animation: slideUp 0.6s ease-out;
}

.register-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #00d2d3, #54a0ff);
}

.register-header {
    text-align: center;
    padding: 2.5rem 2rem 1.5rem;
    background: linear-gradient(135deg, rgba(0, 210, 211, 0.05), rgba(84, 160, 255, 0.05));
}

.icon-wrapper {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #00d2d3, #54a0ff);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    box-shadow: 0 10px 30px rgba(0, 210, 211, 0.3);
}

.icon-wrapper i {
    font-size: 1.8rem;
    color: white;
}

.register-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d3436;
    margin-bottom: 0.5rem;
}

.register-header p {
    color: #636e72;
    font-size: 1rem;
    font-weight: 300;
}

.progress-indicator {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
    gap: 1rem;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    border-radius: 12px;
    background: rgba(0, 210, 211, 0.1);
    color: #636e72;
    transition: all 0.3s ease;
    position: relative;
    min-width: 120px;
}

.step.active {
    background: linear-gradient(135deg, #00d2d3, #54a0ff);
    color: white;
    transform: scale(1.05);
}

.step i {
    font-size: 1.2rem;
}

.step span {
    font-size: 0.8rem;
    font-weight: 500;
    text-align: center;
}

.register-form {
    padding: 0 2rem 2rem;
}

.form-step {
    display: none;
}

.form-step.active {
    display: block;
    animation: fadeInSlide 0.3s ease-out;
}

.step-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2d3436;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
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
    border-color: #00d2d3;
    background: white;
    box-shadow: 0 0 0 0.2rem rgba(0, 210, 211, 0.1);
    transform: translateY(-2px);
}

.form-control-modern.error {
    border-color: #ff6b6b;
    background: rgba(255, 107, 107, 0.1);
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
    color: #00d2d3;
}

.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    height: 4px;
    background: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.3rem;
}

.strength-fill {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-text {
    font-size: 0.8rem;
    font-weight: 500;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e9ecef;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 2rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-next, .btn-submit {
    background: linear-gradient(135deg, #00d2d3, #54a0ff);
    color: white;
    margin-left: auto;
}

.btn-next:hover, .btn-submit:hover {
    background: linear-gradient(135deg, #54a0ff, #00d2d3);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 210, 211, 0.3);
}

.btn-prev {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
    border: 2px solid #6c757d;
}

.btn-prev:hover {
    background: #6c757d;
    color: white;
}

.review-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.review-card {
    background: rgba(0, 210, 211, 0.05);
    border: 1px solid rgba(0, 210, 211, 0.2);
    border-radius: 12px;
    padding: 1.5rem;
}

.review-card h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2d3436;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(0, 210, 211, 0.2);
}

.review-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.8rem;
}

.review-item .label {
    font-weight: 500;
    color: #636e72;
}

.review-item .value {
    font-weight: 600;
    color: #2d3436;
}

.terms-agreement {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: rgba(0, 210, 211, 0.05);
    border-radius: 12px;
    border: 1px solid rgba(0, 210, 211, 0.2);
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
    margin-right: 0.8rem;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.custom-checkbox input:checked + .checkmark {
    background: #00d2d3;
    border-color: #00d2d3;
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

.terms-link {
    color: #00d2d3;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.terms-link:hover {
    color: #54a0ff;
}

.register-footer {
    text-align: center;
    padding: 1.5rem 2rem 2rem;
    background: rgba(248, 249, 250, 0.5);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.register-footer p {
    color: #636e72;
    font-size: 0.9rem;
    margin: 0;
}

.login-link {
    color: #00d2d3;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.login-link:hover {
    color: #54a0ff;
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

.alert-success {
    background: linear-gradient(135deg, #4caf50, #66bb6a);
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

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@media (max-width: 768px) {
    .register-card {
        margin: 1rem;
        border-radius: 15px;
    }
    
    .register-header {
        padding: 2rem 1.5rem 1.5rem;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
    }
    
    .icon-wrapper i {
        font-size: 1.5rem;
    }
    
    .register-header h2 {
        font-size: 1.5rem;
    }
    
    .register-form {
        padding: 0 1.5rem 1.5rem;
    }
    
    .progress-indicator {
        padding: 1.5rem 1rem;
        gap: 0.5rem;
    }
    
    .step {
        min-width: 80px;
        padding: 0.8rem 0.5rem;
    }
    
    .step span {
        font-size: 0.7rem;
    }
    
    .review-section {
        grid-template-columns: 1fr;
        gap: 1rem;
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
    .step-title {
        font-size: 1.1rem;
    }
    
    .register-header h2 {
        font-size: 1.3rem;
    }
    
    .register-header p {
        font-size: 0.9rem;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .btn-next, .btn-submit {
        margin-left: 0;
    }
    
    .progress-indicator {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .step {
        flex-direction: row;
        min-width: auto;
        width: 100%;
        max-width: 200px;
    }
}
