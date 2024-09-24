<?php

// Start the session
session_name('user_session');
session_start();

// Include the database connection file
require_once 'conn.php';
include 'check_user.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}



// Retrieve user data from the session
$user_id = $_SESSION['user_id'];
$user_fname = $_SESSION['user_fname'];
$user_email = $_SESSION['user_email'];

// Check if the user still exists in the database and retrieve their details
$check_user_sql = "SELECT fname, email, address, phone_number FROM user WHERE id = ?";
$check_user_stmt = $conn->prepare($check_user_sql);
$check_user_stmt->bind_param("i", $user_id);
$check_user_stmt->execute();
$check_user_stmt->bind_result($user_fname, $user_email, $user_address, $user_phone_number);
$check_user_stmt->fetch();
$check_user_stmt->close();

// If no user data is found, destroy the session and redirect
if (!$user_fname) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Initialize error and success messages
$error = $success = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $new_fname = trim($_POST['fname']);
    $new_email = trim($_POST['email']);
    $new_address = trim($_POST['address']);
    $new_phone_number = trim($_POST['phone_number']);

    // Validate input
    if (empty($new_fname) || empty($new_email)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Prepare the SQL statement to update user data
        $update_sql = "UPDATE user SET fname = ?, email = ?, address = ?, phone_number = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $new_fname, $new_email, $new_address, $new_phone_number, $user_id);

        if ($update_stmt->execute()) {
            // Update session variables
            $_SESSION['user_fname'] = $new_fname;
            $_SESSION['user_email'] = $new_email;

            $success = "Profile updated successfully.";
        } else {
            $error = "Failed to update profile.";
        }

        // Close the update statement
        $update_stmt->close();
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
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
        .alert {
            transition: opacity 0.5s ease-out;
        }
        .alert.fade-out {
            opacity: 0;
        }
    </style>
</head>

<body>
    <?php include 'anavbar.php'; ?>
    <?php include 'search.php'; ?>
    
    <!-- Profile Section -->
    <section>
        <div class="container">
            <div class="wptb-profile">
                <div class="wptb-form--wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1">
                            <div class="wptb-heading">
                                <div class="wptb-item--inner text-center">
                                    <h1 class="wptb-item--title">Profile Details</h1>
                                    <p class="wptb-item--description">View and manage your profile information</p>
                                </div>
                            </div>

                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                            <?php endif; ?>
                            <?php if ($success): ?>
                                <div class="alert alert-success" id="success-message"><?php echo htmlspecialchars($success); ?></div>
                            <?php endif; ?>

                            <!-- Profile Update Form -->
                            <form class="wptb-form" method="post">
                                <div class="wptb-form--inner">        
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="fname">Name</label>
                                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Full Name" value="<?php echo htmlspecialchars($user_fname); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="User E-mail Address" value="<?php echo htmlspecialchars($user_email); ?>" required>
                                            </div>
                                        </div>

                                        <!-- Address and Phone Number Fields -->
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="<?php echo htmlspecialchars($user_address); ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" value="<?php echo htmlspecialchars($user_phone_number); ?>">
                                            </div>
                                        </div>
    
                                        <div class="col-md-12 col-lg-12">
                                            <div class="wptb-item--button text-center mt-4"> 
                                                <button class="btn" type="submit">
                                                    <div class="btn-wrap">
                                                        <span class="text-first">Update</span> 
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
        document.addEventListener("DOMContentLoaded", function() {
            // Hide success message after 2 seconds
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.classList.add('fade-out');
                }, 2000);
            }
        });
    </script>
</body>
</html>
