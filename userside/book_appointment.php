<?php
// Start the session
session_name('user_session');
session_start();

include('conn.php');
include 'check_user.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Initialize variables
$package = $date = $name = $email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package = trim($_POST['package']);
    $date = trim($_POST['date']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($package) || empty($date) || empty($name) || empty($email)) {
        $_SESSION['flash']['error'] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash']['error'] = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointment (user_id, package, date, name, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $package, $date, $name, $email);

        if ($stmt->execute()) {
            $_SESSION['flash']['success'] = "Appointment successful!";
            $package = $date = $name = $email = '';
        } else {
            $_SESSION['flash']['error'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
    header("Location: book_appointment.php"); // Redirect to avoid form resubmission
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kimono - Book an Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Body Background */
        body {
            background: transparent;
            color: #333;
            /* Dark text for better readability */


        }

        .wrapper {
            margin-top: 250px;
        }

        /* Card Styling */
        .card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.95);
            /* Slightly less transparent */

            margin-bottom: 150px;

        }

        /* Card Header Styling */
        .card-header {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: #fff;
            /* White text for contrast */
            border-bottom: 2px solid #0056b3;
            border-radius: 20px 20px 0 0;
        }

        /* Card Body Styling */
        .card-body {
            padding: 2rem;
        }

        /* Form Elements */
        .form-select,
        .form-control {
            border-radius: 10px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            border: 1px solid #ced4da;
            margin-bottom: 10px;
            color: #495057;
            /* Dark text color for form elements */
        }

        /* Form Labels */
        .form-label {
            font-weight: bold;
            color: #333;
            /* Dark color for labels */
        }

        /* Button Styling */
        .btn-primary {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            background: linear-gradient(to right, #007bff, #0056b3);
            border: none;
            color: #fff;
            /* White text for button */
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #0056b3, #004080);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Alert Messages */
        .alert {
            margin-bottom: 1rem;
            color: #333;
            /* Dark text color for alerts */
        }
    </style>
</head>

<body>
    <?php include 'anavbar.php'; ?>
    <!-- Main Wrapper-->
    <main class="wrapper">
        <div class="container d-flex justify-content-center align-items-center vh-100 mb-5">
            <div class="card shadow-lg border-0" style="width: 100%; max-width: 500px;">
                <div class="card-header text-center">
                    <h4>Book an Appointment</h4>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($_SESSION['flash'])): ?>
                        <?php if (isset($_SESSION['flash']['error'])): ?>
                            <div class="alert alert-danger" id="message"><?php echo $_SESSION['flash']['error']; ?></div>
                            <?php unset($_SESSION['flash']['error']); ?>
                        <?php elseif (isset($_SESSION['flash']['success'])): ?>
                            <div class="alert alert-success" id="message"><?php echo $_SESSION['flash']['success']; ?></div>
                            <?php unset($_SESSION['flash']['success']); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <form action="book_appointment.php" method="post" id="appointmentForm" novalidate>
                        <div class="form-group mb-3">
                            <label for="package" class="form-label">Choose a Package:</label>
                            <select name="package" id="package" class="form-select" required>
                                <option value="">Select a package</option>
                                <option value="silver_indoor" <?php echo $package === 'silver_indoor' ? 'selected' : ''; ?>>Indoor Package Silver</option>
                                <option value="gold_indoor" <?php echo $package === 'gold_indoor' ? 'selected' : ''; ?>>Indoor Package Gold</option>
                                <option value="platinum_indoor" <?php echo $package === 'platinum_indoor' ? 'selected' : ''; ?>>Indoor Package Platinum</option>
                                <option value="diamond_indoor" <?php echo $package === 'diamond_indoor' ? 'selected' : ''; ?>>Indoor Package Diamond</option>
                                <option value="silver_vip" <?php echo $package === 'silver_vip' ? 'selected' : ''; ?>>VIP Package Silver</option>
                                <option value="gold_vip" <?php echo $package === 'gold_vip' ? 'selected' : ''; ?>>VIP Package Gold</option>
                                <option value="platinum_vip" <?php echo $package === 'platinum_vip' ? 'selected' : ''; ?>>VIP Package Platinum</option>
                                <option value="diamond_vip" <?php echo $package === 'diamond_vip' ? 'selected' : ''; ?>>VIP Package Diamond</option>
                                <option value="silver_corporate" <?php echo $package === 'silver_corporate' ? 'selected' : ''; ?>>Corporate Package Silver</option>
                                <option value="gold_corporate" <?php echo $package === 'gold_corporate' ? 'selected' : ''; ?>>Corporate Package Gold</option>
                                <option value="platinum_corporate" <?php echo $package === 'platinum_corporate' ? 'selected' : ''; ?>>Corporate Package Platinum</option>
                                <option value="diamond_corporate" <?php echo $package === 'diamond_corporate' ? 'selected' : ''; ?>>Corporate Package Diamond</option>
                                <option value="silver_family" <?php echo $package === 'silver_family' ? 'selected' : ''; ?>>Family Package Silver</option>
                                <option value="gold_family" <?php echo $package === 'gold_family' ? 'selected' : ''; ?>>Family Package Gold</option>
                                <option value="platinum_family" <?php echo $package === 'platinum_family' ? 'selected' : ''; ?>>Family Package Platinum</option>
                                <option value="diamond_family" <?php echo $package === 'diamond_family' ? 'selected' : ''; ?>>Family Package Diamond</option>

                                <!-- Add other options here -->
                            </select>
                            <div class="invalid-feedback">
                                Please select a package.
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="date" class="form-label">Preferred Date:</label>
                            <input type="date" id="date" name="date" class="form-control" value="<?php echo htmlspecialchars($date); ?>" required>
                            <div class="invalid-feedback">
                                Please select a valid date.
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Your Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
                            <div class="invalid-feedback">
                                Please enter your name.
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Your Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 ">Book Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.min.js"></script>

    <!-- JavaScript Validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bootstrap form validation
            var form = document.getElementById('appointmentForm');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>
</body>
</html>