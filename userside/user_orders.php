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

// Fetch the user ID from the session
$userId = $_SESSION['user_id'];

// Prepare the query to fetch orders
$ordersQuery = "SELECT id, full_name, phone, address, pincode, subtotal, shipping, total, order_date
                FROM cart_order
                WHERE user_id = ?
                ORDER BY order_date DESC";
$stmt = $conn->prepare($ordersQuery);
$stmt->bind_param('i', $userId);
$stmt->execute();
$ordersResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="User - Order Details">
    <title>My Orders - kimono</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .order-table th, .order-table td {
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

        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .user-select-scroll {
            max-height: 200px;
            overflow-y: auto;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <?php include 'anavbar.php'; ?>

    <main class="container my-5">
        <h2 class="text-center mb-4">My Orders</h2>

        <!-- Orders Table -->
        <?php if ($ordersResult->num_rows > 0) { ?>
            <div class="order-table">
                <table class="table table-bordered table-hover bg-secondary">
                    <thead class="bg-white">
                        <tr>
                            <th>Order no</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Subtotal</th>
                            <th>Shipping</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $orderno = 1;
                        while ($order = $ordersResult->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $orderno++ ; ?></td>
                                <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['phone']); ?></td>
                                <td><?php echo htmlspecialchars($order['address']); ?></td>
                                <td><?php echo htmlspecialchars($order['pincode']); ?></td>
                                <td>$<?php echo number_format($order['subtotal'], 2); ?></td>
                                <td>$<?php echo number_format($order['shipping'], 2); ?></td>
                                <td>$<?php echo number_format($order['total'], 2); ?></td>
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td>
                                    <a href="user_download_orders.php?order_id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-success btn-sm">Download Order</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="text-center">You have no orders.</p>
        <?php } ?>
        
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>
