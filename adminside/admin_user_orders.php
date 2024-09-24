<?php
// Start the session
session_start();

// Include the database connection file
require_once 'conn.php';

// Check if the user is an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Initialize variables
$selectedUserId = '';
$ordersQuery = "SELECT id, full_name, phone, address, pincode, subtotal, shipping, total, order_date
                FROM cart_order
                WHERE user_id = ?
                ORDER BY order_date DESC";

// Fetch all users for the dropdown
$usersQuery = "SELECT id, fname FROM user";
$usersResult = $conn->query($usersQuery);

if (!$usersResult) {
    die("Database query failed: " . $conn->error);
}

// Check if a user is selected
if (isset($_POST['userId'])) {
    $selectedUserId = $_POST['userId'];
    $stmt = $conn->prepare($ordersQuery);
    $stmt->bind_param('i', $selectedUserId);
    $stmt->execute();
    $ordersResult = $stmt->get_result();
} else {
    $ordersResult = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin - User Orders">
    <title>Order Management - kimono</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 120vh;
            margin: 0;
        }

        .container {
            flex: 1;
        }

        .container h2 {
            margin-top: 100px;
            color: white;
        }

        .order-table {
            margin-top: 80px;
            background-color: transparent;
        }

        .order-table table {
            width: 100%;
        }

        .order-table th,
        .order-table td {
            text-align: center;
        }

        .order-table td {
            vertical-align: middle;
        }

        .order-table .btn {
            margin: 0;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .user-select-scroll {
            max-height: 200px;
            overflow-y: auto;
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

    <main class="container my-5">
        <h2 class="text-center mb-4">Manage Orders</h2>

        <!-- User Selection Form -->
        <form action="admin_user_orders.php" method="post" class="mb-4">
            <div class="form-group">
                <label for="userId">Select User:</label>
                <select name="userId" id="userId" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Select User --</option>
                    <?php while ($user = $usersResult->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($user['id']); ?>" <?php echo ($selectedUserId == $user['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($user['fname']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </form>

        <!-- Orders Table -->
        <?php if ($ordersResult) { ?>
            <div class="order-table">
                <table class="table table-bordered table-hover bg-secondary">
                    <thead class="bg-white">
                        <tr>
                            <th>Order</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Subtotal</th>
                            <th>Shipping</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = $ordersResult->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['id']); ?></td>
                                <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['phone']); ?></td>
                                <td><?php echo htmlspecialchars($order['address']); ?></td>
                                <td><?php echo htmlspecialchars($order['pincode']); ?></td>
                                <td>₹<?php echo number_format($order['subtotal'], 2); ?></td>
                                <td>₹<?php echo number_format($order['shipping'], 2); ?></td>
                                <td>₹<?php echo number_format($order['total'], 2); ?></td>
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td>
                                    <a href="admin_order_details.php?order_id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-primary btn-sm">View Details</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

    </main>


    <div class="footer">
        <p>&copy; 2024 Kimono Photography. All rights reserved.</p>
    </div>

    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close the statement and connection
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>