<?php
// Start the session
session_start();

// Include the database connection file
require_once 'conn.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to the admin login page if not logged in as an admin
    header("Location: admin_login.php");
    exit;
}

// Handle deletion request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $user_id = $_POST['user_id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $success = "User deleted successfully.";
    } else {
        $error = "Error deleting user: " . $conn->error;
    }
    $stmt->close();
}

// Fetch user data
$sql = "SELECT id, fname, email, phone_number, address FROM user ORDER BY id DESC";
$result = $conn->query($sql);

if (!$result) {
    $error = "Error executing query: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kimono - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            margin-bottom: 300px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .mb-4 {
            margin-top: 100px;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: center;

        }

        .table thead th {
            background-color: #343a40;
            color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">Manage Users</h1>

        <?php if (isset($error)) {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">' . $error . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } ?>
        <?php if (isset($success)) {
            echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">' . $success . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sr no</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php
                                $srNo = 1; // Initialize serial number counter
                                while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $srNo++; ?></td> <!-- Display serial number -->
                                        <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                        <td class="text-center">
                                            <form method="POST" action="admin_dashboard.php" style="display:inline;">
                                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Kimono Photography. All rights reserved.</p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
