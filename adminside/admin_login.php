<?php
// Include database connection
include('conn.php');
session_start(); // Start session

// Redirect to admin dashboard if user is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_dashboard.php"); // Redirect to admin dashboard
    exit();
}

// Error variable for login feedback
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validate inputs
    if (!empty($email) && !empty($password)) {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, password FROM admin WHERE email = ? ");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the email exists
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $row['password'])) {
                    // Set session variables for logged-in admin
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $row['id'];
                    header("Location: admin_dashboard.php"); // Redirect to admin dashboard
                    exit();
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "No account found with that email.";
            }

            $stmt->close();
        } else {
            $error = "Query error: " . $conn->error;
        }
    } else {
        $error = "All fields are required.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: #fff;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: #0072ff;
            color: #fff;
            border-bottom: none;
            border-radius: 1rem 1rem 0 0;
        }

        .card-body {
            background: #fff;
            color: #333;
            border-radius: 0 0 1rem 1rem;
        }

        .btn-primary {
            background: #0072ff;
            border: none;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .container {
            max-width: 500px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="my-3">Admin Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div id="email-error" class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <div id="password-error" class="text-danger"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <a href="admin_register.php" class="btn btn-secondary btn-block mt-3">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .invalid {
            border-color: red !important;
        }
    </style>

    <script>
        function validateForm() {
            var isValid = true;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Clear previous error messages and styles
            document.getElementById("email-error").innerText = "";
            document.getElementById("password-error").innerText = "";
            document.getElementById("email").classList.remove("invalid");
            document.getElementById("password").classList.remove("invalid");

            if (email == "") {
                document.getElementById("email-error").innerText = "Email must be filled out";
                document.getElementById("email").classList.add("invalid");
                isValid = false;
            } else if (!validateEmail(email)) {
                document.getElementById("email-error").innerText = "Invalid email format";
                document.getElementById("email").classList.add("invalid");
                isValid = false;
            }

            if (password == "") {
                document.getElementById("password-error").innerText = "Password must be filled out";
                document.getElementById("password").classList.add("invalid");
                isValid = false;
            }

            return isValid;
        }

        function validateEmail(email) {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return re.test(email);
        }
    </script>

</body>

</html>