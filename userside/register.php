<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, redirect to home page or another page
    header("Location: login.php"); // Replace with your preferred redirect page
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $fname = trim($_POST['fname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);

    // Validate input
    if (empty($fname) || empty($email) || empty($password) || empty($phone_number) || empty($address)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!preg_match('/^\d{10}$/', $phone_number)) {
        $error = "Phone number must be exactly 10 digits.";
    } else {
        // Check if the email already exists
        $check_email_query = "SELECT email FROM user WHERE email = ?";
        $stmt = $conn->prepare($check_email_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already exists.";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $sql = "INSERT INTO user (fname, email, password, phone_number, address) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $fname, $email, $hashed_password, $phone_number, $address);

            if ($stmt->execute()) {
                // Set a session variable to indicate successful registration
                $_SESSION['registration_success'] = true;

                // Redirect to the same page to display the message
                header("Location: register.php");
                exit;
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kimono - Photography Agency">
    <meta name="author" content="">

    <!-- Favicon and touch Icons -->
    <link href="../assets/img/favicon.png" rel="shortcut icon" type="image/png">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="../assets/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="../assets/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Page Title -->
    <title>Kimono</title>    
    
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

    <!-- My Account -->
    <section>
        <div class="container">
            <div class="wptb-login-form">
                <div class="wptb-form--wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1">
                            <div class="wptb-heading">
                                <div class="wptb-item--inner text-center">
                                    <h1 class="wptb-item--title">Register here</h1>
                                    <p class="wptb-item--description">Contact us for a great photography session</p>
                                </div>
                            </div>

                            <?php if (isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
                            <?php if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) { ?>
                                <div class="alert alert-success" id="success-message">Registration successful! Redirecting to login...</div>
                                <?php unset($_SESSION['registration_success']); ?>
                            <?php } ?>

                            <form id="registration-form" class="wptb-form" method="post">
                                <div class="wptb-form--inner">        
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Full Name">
                                                <div id="fname-error" class="error"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                                                <div id="email-error" class="error"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                                <div id="password-error" class="error"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                                                <div id="phone_number-error" class="error"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
                                                <div id="address-error" class="error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group text-center">
                                                <input class="form-check-input" type="checkbox" value="" id="form2Example3c" required />
                                                <label for="form2Example3c" class="text-capitalize">      
                                                    I agree to all statements in <a href="../condition.php" class="text-primary">Terms of service</a>
                                                </label>
                                                <div id="terms-error" class="error"></div>
                                            </div>
                                           
                                            <div class="wptb-item--button text-center mt-4"> 
                                                <button class="btn" type="submit">
                                                    <div class="btn-wrap">
                                                        <span class="text-first">Submit</span> 
                                                    </div> 
                                                </button>
                                            </div>
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
    
    <!-- <div class="divider-line-hr mr-bottom-40"></div> -->

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->

    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>
    
    <!-- Core JS -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <!-- Framework -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- WOW Scroll Effect -->
    <script src="../plugins/wow/wow.min.js"></script>
    <!-- Swiper Slider -->
    <script src="../plugins/swiper/swiper-bundle.min.js"></script>
    <script src="../plugins/swiper/swiper-gl.min.js"></script>
    <!-- Odometer Counter -->
    <script src="../plugins/odometer/appear.js"></script>
    <script src="../plugins/odometer/odometer.js"></script>
    <!-- Fancybox -->
    <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>
    <!-- Flatpickr -->
    <script src="../plugins/flatpickr/flatpickr.min.js"></script>
    <!-- Nice Select -->
    <script src="../plugins/nice-select/jquery.nice-select.min.js"></script>
    <!-- Cursor Effect -->
    <script src="../plugins/cursor-effect/cursor-effect.js"></script>
    <!-- Theme Custom JS -->
    <script src="../assets/js/theme.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to validate the form
            function validateForm() {
                let isValid = true;

                // Clear previous error messages and styles
                document.querySelectorAll('.error').forEach(el => el.textContent = '');
                document.querySelectorAll('.form-control').forEach(el => el.classList.remove('error'));

                // Validate Name
                const fname = document.getElementById('fname').value.trim();
                if (fname === '') {
                    document.getElementById('fname-error').textContent = 'Username length is too short.';
                    document.getElementById('fname').classList.add('error');
                    isValid = false;
                }

                // Validate Email
                const email = document.getElementById('email').value.trim();
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === '') {
                    document.getElementById('email-error').textContent = 'Email is required.';
                    document.getElementById('email').classList.add('error');
                    isValid = false;
                } else if (!emailPattern.test(email)) {
                    document.getElementById('email-error').textContent = 'Invalid email format.';
                    document.getElementById('email').classList.add('error');
                    isValid = false;
                }

                // Validate Password
                const password = document.getElementById('password').value.trim();
                if (password === '') {
                    document.getElementById('password-error').textContent = 'Password cannot be empty.';
                    document.getElementById('password').classList.add('error');
                    isValid = false;
                }

                // Validate Phone Number
                const phoneNumber = document.getElementById('phone_number').value.trim();
                const phonePattern = /^\d{10}$/; // Exactly 10 digits
                if (phoneNumber === '') {
                    document.getElementById('phone_number-error').textContent = 'Phone number is required.';
                    document.getElementById('phone_number').classList.add('error');
                    isValid = false;
                } else if (!phonePattern.test(phoneNumber)) {
                    document.getElementById('phone_number-error').textContent = 'Phone number must be exactly 10 digits.';
                    document.getElementById('phone_number').classList.add('error');
                    isValid = false;
                }

                // Validate Address
                const address = document.getElementById('address').value.trim();
                if (address === '') {
                    document.getElementById('address-error').textContent = 'Address is required.';
                    document.getElementById('address').classList.add('error');
                    isValid = false;
                }

                // Validate Terms
                const terms = document.getElementById('form2Example3c').checked;
                if (!terms) {
                    document.getElementById('terms-error').textContent = 'You must agree to the terms of service.';
                    isValid = false;
                }

                return isValid;
            }

            // Attach the validation function to the form's submit event
            document.getElementById('registration-form').addEventListener('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });

            // Show success message and redirect after 3 seconds
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'block'; // Show the success message
                setTimeout(function() {
                    successMessage.style.display = 'none'; // Hide the success message
                    window.location.href = 'login.php'; // Redirect to login page
                }, 3000); // Redirect after 3 seconds
            }
        });
    </script>
</body>
</html>
