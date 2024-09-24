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
    $token = trim($_POST['token']);
    $new_password = trim($_POST['new_password']);

    // Validate input
    if (empty($token) || empty($new_password)) {
        $error = "Please enter all required fields.";
    } else {
        // Validate the token
        $validate_token_query = "SELECT user_id FROM password WHERE token = ? AND created_at > (NOW() - INTERVAL 1 HOUR)";
        $stmt = $conn->prepare($validate_token_query);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user_id = $result->fetch_assoc()['user_id'];

            // Update the password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password_query = "UPDATE user SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($update_password_query);
            $stmt->bind_param("si", $hashed_password, $user_id);
            $stmt->execute();

            // Remove the token
            $delete_token_query = "DELETE FROM password WHERE token = ?";
            $stmt = $conn->prepare($delete_token_query);
            $stmt->bind_param("s", $token);
            $stmt->execute();

            // Redirect to login page
            header("Location: login.php");
            exit;
        } else {
            $error = "Invalid or expired token.";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
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
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php include 'search.php'; ?>


    <!-- Reset Password -->
    <section>
        <div class="container">
            <div class="wptb-login-form">
                <div class="wptb-form--wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1">
                            <div class="wptb-heading">
                                <div class="wptb-item--inner text-center">
                                    <h1 class="wptb-item--title">Reset Your Password</h1>
                                    <p class="wptb-item--description">Enter the token to reset your password</p>
                                </div>
                            </div>

                            <form class="wptb-form" method="post" onsubmit="return validateForm()">
                                <div class="wptb-form--inner">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="text" name="token" id="token" class="form-control" placeholder="Token">
                                                <div id="token-error" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                                                <div id="password-error" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12">
                                            <div class="wptb-item--button text-center mt-4">
                                                <button class="btn" type="submit">
                                                    <div class="btn-wrap">
                                                        <span class="text-first">Reset Password</span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-12 mt-3 text-center">
                                            <a href="login.php" class="btn btn-secondary">Back to Login</a>
                                            <a href="reset_request.php" class="btn btn-secondary">Create Token</a>
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
            var token = document.getElementById("token").value;
            var newPassword = document.getElementById("new_password").value;

            // Clear previous error messages and styles
            document.getElementById("token-error").innerText = "";
            document.getElementById("password-error").innerText = "";
            document.getElementById("token").classList.remove("invalid");
            document.getElementById("new_password").classList.remove("invalid");

            if (token == "") {
                document.getElementById("token-error").innerText = "Token must be filled out";
                document.getElementById("token").classList.add("invalid");
                isValid = false;
            }

            if (newPassword == "") {
                document.getElementById("password-error").innerText = "New Password must be filled out";
                document.getElementById("new_password").classList.add("invalid");
                isValid = false;
            } else if (newPassword.length < 6) {
                document.getElementById("password-error").innerText = "New Password must be at least 6 characters long";
                document.getElementById("new_password").classList.add("invalid");
                isValid = false;
            }

            return isValid;
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
</body>

</html>