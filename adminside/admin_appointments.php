<?php
session_start();
require_once 'conn.php'; // Database connection

// Ensure the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Handle appointment confirmation, cancellation, or deletion
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'confirm') {
        $update_query = "UPDATE appointment SET status = 'confirmed' WHERE id = ?";

        // Fetch user ID for the notification
        $user_query = "SELECT user_id FROM appointment WHERE id = ? ";
        $stmt = $conn->prepare($user_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        // Insert notification for the user
        $notification_query = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
        $stmt = $conn->prepare($notification_query);
        $message = "Your appointment #$id has been confirmed.";
        $stmt->bind_param("is", $user_id, $message);
        $stmt->execute();
        $stmt->close();
    } elseif ($action === 'cancel') {
        $update_query = "UPDATE appointment SET status = 'canceled' WHERE id = ?";
    } elseif ($action === 'delete') {
        $delete_query = "DELETE FROM appointment WHERE id = ?";
    }

    if (isset($update_query)) {
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($delete_query)) {
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all appointments
$query = "SELECT * FROM appointment ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        .card {
            border-radius: 15px;
            margin-top: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-bottom: 1px solid;
            color: black;
            font-weight: bold;
            text-align: center;
        }

        .btn-confirm {
            background-color: #28a745;
            color: #fff;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-confirm:hover {
            background-color: #218838;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .table thead th {
            background-color: #007bff;
            color: #fff;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-warning {
            background-color: #ffc107;
        }

        .text-center {
            text-align: center;
        }

        .justify-content-center {
            justify-content: center;
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

    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header text-dark">
                Manage Appointments
            </div>
            <div class="card-body">
                <?php if ($result->num_rows > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SR No</th> <!-- Added Serial Number Column -->
                                <th>Package</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sr_no = 1; // Initialize serial number ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($sr_no++); ?></td> <!-- Display Serial Number -->
                                    <td><?php echo htmlspecialchars($row['package']); ?></td>
                                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <?php if ($row['status'] === 'confirmed'): ?>
                                            <span class="badge badge-success">Confirmed</span>
                                        <?php elseif ($row['status'] === 'canceled'): ?>
                                            <span class="badge badge-danger">Canceled</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($row['status'] === 'pending'): ?>
                                            <div class="d-flex justify-content-center">
                                                <a href="?action=confirm&id=<?php echo $row['id']; ?>" class="btn btn-confirm btn-sm me-2">Confirm</a>
                                                <a href="?action=cancel&id=<?php echo $row['id']; ?>" class="btn btn-cancel btn-sm me-2">Cancel</a>
                                            </div>
                                        <?php else: ?>
                                            <button class="btn btn-danger btn-sm mt-2" disabled>Action</button>
                                        <?php endif; ?>
                                        <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No appointments found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Kimono Photography. All rights reserved.</p>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<?php $conn->close(); ?>
