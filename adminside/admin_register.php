<?php
// Include database connection
include('conn.php');
session_start(); // Start session

// Redirect to login if user is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_login.php"); // Redirect to a logged-in area
    exit();
}

// Error variable
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validate inputs
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM admin WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username or email already exists.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO admin (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $email);

            if ($stmt->execute()) {
                $success = "Registration successful! You can now <a href='admin_login.php'>login</a>.";
            } else {
                $error = "Error: " . $stmt->error;
            }
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
    <title>kimono</title>
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

        .btn-secondary {
            background: #333;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #444;
        }

        .alert {
            border-radius: 0.5rem;
        }

        .form-control {
            border-radius: 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
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
                        <h4 class="my-3">Register</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success">
                                <?php echo $success; ?>
                            </div>
                        <?php endif; ?>
                        <form action="admin_register.php" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" autofocus>
                                <div id="username-error" class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div id="email-error" class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <div id="password-error" class="text-danger"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <a href="admin_login.php" class="btn btn-secondary btn-block mt-3">Back to Login</a>
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
            var username = document.getElementById("username").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Clear previous error messages and styles
            document.getElementById("username-error").innerText = "";
            document.getElementById("email-error").innerText = "";
            document.getElementById("password-error").innerText = "";
            document.getElementById("username").classList.remove("invalid");
            document.getElementById("email").classList.remove("invalid");
            document.getElementById("password").classList.remove("invalid");

            if (username == "") {
                document.getElementById("username-error").innerText = "Username must be filled out";
                document.getElementById("username").classList.add("invalid");
                isValid = false;
            }

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