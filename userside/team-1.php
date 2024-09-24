<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, redirect to home page or another page
    header("Location: home.php"); // Replace with your preferred redirect page
    exit();
}

// Fetch team members from the database
$query = "SELECT * FROM team_members WHERE status = 'active'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Our Team Page">
    <meta name="author" content="Your Name">

    <!-- Favicon and touch Icons -->
    <link href="assets/img/favicon.png" rel="shortcut icon" type="image/png">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="assets/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="assets/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Page Title -->
    <title>Our Team</title>

    <!-- Styles Include -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <style>
        .team-member img {
            height: 450px; /* Set a fixed height */
            object-fit: cover; /* Ensures the image covers the area */
            width: 100%; /* Make sure image width is responsive */
        }
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }
        .card-body {
            text-align: center;
            color: black;
        }
        .card-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        .card-text {
            font-size: 1rem;
            color: #555;
        }
        .totop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .totop a {
            display: inline-block;
            padding: 10px;
            background: #333;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            font-size: 1.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background 0.3s;
        }
        .totop a:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php include 'search.php'; ?>

    <!-- Our Team -->
    <section class="container mt-5">
        <h1 class="text-center mb-4">Our Team</h1>
        <?php if ($result->num_rows > 0): ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card team-member">
                            <?php if (!empty($row['image'])): ?>
                                <img src="../adminside/uploads/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Team Member Image">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No team members found.</p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Back to Top Button -->
    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>

    <!-- Core JS -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
    <!-- Additional JS Libraries -->
    <!-- Include any additional JS libraries here -->

    <!-- Theme Custom JS -->
    <script src="assets/js/theme.js"></script>
</body>
</html>
