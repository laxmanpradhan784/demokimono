<?php
// Start the session
session_name('user_session');
session_start();
// Check if the user is already logged in, if yes then redirect them to the profile page
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php"); // Redirect to profile page if already logged in
    exit;
}

// Include the database connection file
require_once 'conn.php';

// Initialize error variable
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF token check
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid CSRF token.";
    } else {
        // Retrieve and sanitize form data
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Validate input
        if (empty($email) || empty($password)) {
            $error = "Please fill in all required fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            // Prepare the SQL statement to prevent SQL injection
            $sql = "SELECT id, fname, password FROM user WHERE email = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($user_id, $user_fname, $hashed_password);
                    $stmt->fetch();

                    // Verify the password
                    if (password_verify($password, $hashed_password)) {
                        // Store user data in session variables
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $email;
                        $_SESSION['user_fname'] = $user_fname;

                        // Set a session variable to indicate successful login
                        $_SESSION['login_success'] = true;

                        // Redirect to the same page to display the message
                        header("Location: login.php");
                        exit;
                    } else {
                        $error = "Invalid email or password.";
                    }
                } else {
                    $error = "Invalid email or password.";
                }

                // Close the statement
                $stmt->close();
            } else {
                $error = "Failed to prepare SQL statement.";
            }
        }
    }

    // Close the database connection
    $conn->close();
}

// Generate a new CSRF token
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <!-- Styles Include -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        /* Custom styles for success message */
        #success-message {
            display: none;
            color: green;
            font-size: 1.2em;
            text-align: center;
            margin-top: 20px;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .form-control.error {
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php include 'search.php'; ?>

    <!-- Login Section -->
    <section>
        <div class="container">
            <div class="wptb-login-form">
                <div class="wptb-form--wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1">
                            <div class="wptb-heading">
                                <div class="wptb-item--inner text-center">
                                    <h1 class="wptb-item--title">Login Here</h1>
                                    <p class="wptb-item--description">Log in to your account to access exclusive content</p>
                                </div>
                            </div>

                            <?php if (!empty($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
                            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success']) { ?>
                                <div class="alert alert-success" id="success-message">Login successful! Redirecting to your profile...</div>
                                <?php unset($_SESSION['login_success']); ?>
                            <?php } ?>

                            <form class="wptb-form" id="loginForm" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="wptb-form--inner">        
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="email Address" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                                <div id="email-error" class="error"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                                <div id="password-error" class="error"></div>
                                            </div>
                                        </div>
                    
                                        <div class="col-md-12 col-lg-12">
                                            <div class="wptb-item--button text-center mt-4"> 
                                                <button class="btn" type="submit">
                                                    <div class="btn-wrap">
                                                        <span class="text-first">Login</span> 
                                                    </div> 
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12 mt-3 text-center">
                                            <a href="forgot_password.php" class="btn btn-secondary">Forgot Password</a>
                                            <a href="register.php" class="btn btn-secondary">Back to Register</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>					
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Core JS -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <!-- Framework -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Additional Plugins -->
    <script src="../plugins/wow/wow.min.js"></script>
    <script src="../plugins/swiper/swiper-bundle.min.js"></script>
    <script src="../plugins/odometer/appear.js"></script>
    <script src="../plugins/odometer/odometer.js"></script>
    <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="../plugins/flatpickr/flatpickr.min.js"></script>
    <script src="../plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="../plugins/cursor-effect/cursor-effect.js"></script>
    <!-- Theme Custom JS -->
    <script src="../assets/js/theme.js"></script>

    <!-- Custom JS for validation and success message -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("loginForm");

            form.addEventListener("submit", function(event) {
                const email = document.getElementById("email");
                const password = document.getElementById("password");

                let isValid = true;

                // Clear previous error messages and styles
                document.querySelectorAll('.error').forEach(el => el.textContent = "");
                document.querySelectorAll('.form-control').forEach(el => el.classList.remove('error'));

                // Validate Email
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email.value.trim())) {
                    document.getElementById("email-error").textContent = "Invalid email format.";
                    email.classList.add('error');
                    isValid = false;
                }

                // Validate Password
                if (password.value.trim() === "") {
                    document.getElementById("password-error").textContent = "password can not be empty.";
                    password.classList.add('error');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });

            // Show success message and redirect after 3 seconds
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'block'; // Show the success message
                setTimeout(function() {
                    window.location.href = 'profile.php'; // Redirect to profile page after 3 seconds
                }, 3000);
            }
        });
    </script>
</body>
</html>
