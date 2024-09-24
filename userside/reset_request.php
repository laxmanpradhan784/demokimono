<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $email = trim($_POST['email']);

    

    // Validate input
    if (empty($email)) {
        $error = "Please enter your email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Prepare the SQL statement to find the user
        $sql = "SELECT id FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id);
            $stmt->fetch();

            // Generate a unique token
            $token = bin2hex(random_bytes(16));

            // Store the token in the database
            $store_token_query = "INSERT INTO password (user_id, token, created_at) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($store_token_query);
            $stmt->bind_param("is", $user_id, $token);
            $stmt->execute();

            // For development: Display the token (In production, send via email)
            $success = " A password reset Token:- " . $token;
        } else {
            $error = "No user found with that email address.";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Password Reset Request">
    <meta name="author" content="">

    <!-- Favicon and touch Icons -->
    <link href="../assets/img/favicon.png" rel="shortcut icon" type="image/png">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    
    <!-- Page Title -->
    <title>Kimono</title>    
    
    <!-- Styles Include -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php include 'search.php'; ?>
    

       <!-- Password Reset Request -->
<section>
    <div class="container">
        <div class="wptb-login-form">
            <div class="wptb-form--wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner text-center">
                                <h1 class="wptb-item--title">Request Password Reset</h1>
                                <p class="wptb-item--description">Enter your email address to receive a password reset link.</p>
                            </div>
                        </div>

                        <?php if (isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
                        <?php if (isset($success)) { echo '<div class="alert alert-success">'.$success.'</div>'; } ?>

                        <form class="wptb-form" method="post" onsubmit="return validateForm()">
                            <div class="wptb-form--inner">        
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Your email address">
                                            <div id="email-error" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12">
                                        <div class="wptb-item--button text-center mt-4"> 
                                            <button class="btn btn-primary" type="submit">Request Reset Link</button>
                                            <button class="btn btn-secondary" type="button" onclick="window.location.href='forgot_password.php'">Back to Forgot Password</button>
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

<style>
    .invalid {
        border-color: red !important;
    }
</style>

<script>
function validateForm() {
    var isValid = true;
    var email = document.getElementById("email").value;

    // Clear previous error messages and styles
    document.getElementById("email-error").innerText = "";
    document.getElementById("email").classList.remove("invalid");

    if (email == "") {
        document.getElementById("email-error").innerText = "Email must be filled out";
        document.getElementById("email").classList.add("invalid");
        isValid = false;
    } else if (!validateEmail(email)) {
        document.getElementById("email-error").innerText = "Invalid email format";
        document.getElementById("email").classList.add("invalid");
        isValid = false;
    }

    return isValid;
}

function validateEmail(email) {
    var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(email);
}
</script>

    </main>
    
    <div class="divider-line-hr mr-bottom-40"></div>

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
    <!-- Other Plugins -->
    <script src="../plugins/wow/wow.min.js"></script>
    <script src="../plugins/swiper/swiper-bundle.min.js"></script>
    <script src="../plugins/odometer/odometer.js"></script>
    <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="../plugins/flatpickr/flatpickr.min.js"></script>
    <script src="../plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="../plugins/cursor-effect/cursor-effect.js"></script>
    <!-- Theme Custom JS -->
    <script src="../assets/js/theme.js"></script>
</body>
</html>
