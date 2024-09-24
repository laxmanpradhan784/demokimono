<?php
session_start();
include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Determine if the user is an admin
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Get the order ID from the query string
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    echo "Invalid Order ID.";
    exit;
}
$order_id = intval($_GET['order_id']);

// Fetch order summary from cart_order table and user details
$order_query = "
    SELECT o.*, u.fname, u.email
    FROM cart_order o
    JOIN user u ON o.user_id = u.id
    WHERE o.id = ? ";
$order_stmt = $conn->prepare($order_query);
if (!$order_stmt) {
    die("Prepare failed: " . $conn->error);
}
$order_stmt->bind_param('i', $order_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();
$order = $order_result->fetch_assoc();
$order_stmt->close();

if (!$order) {
    echo "Order not found for ID: " . $order_id;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $is_admin ? 'Admin' : 'User'; ?> - Order Details">
    <title>kimono</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/main.css" rel="stylesheet">

    <style>
        /* Existing styles */
        body {
            background-color: transparent;
        }

        .container {
            margin-top: 100px;
        }

        .order-details {
            background-color: transparent;
            border-radius: .5rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: .25rem;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .table-custom {
            background-color: #ffffff;
            /* White background */
            border-color: #dcdcdc;
            /* Grey border color */
        }

        .table-custom th,
        .table-custom td {
            background-color: #f8f9fa;
            /* Light grey background for cells */
            color: #000000;
            /* Black text for readability */
            transition: background-color 0.3s;
            /* Smooth transition for hover effect */
        }

        .table-custom thead th {
            background-color: #343a40;
            /* Dark grey background for table header */
            color: #ffffff;
            /* White text for header */
        }

        .table-custom tbody tr:hover {
            background-color: #e9ecef;
            /* Light grey background on hover */
            cursor: pointer;
            /* Pointer cursor on hover */
        }

        /* Highlighting for admin rows */
        .highlight-admin {
            background-color: #e3f2fd;
            /* Light blue background */
            font-weight: bold;
            /* Bold text */
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

    <main class="container">
        <h2 class="text-center mb-4">Order Details</h2>

        <!-- Order Details Section -->
        <div class="order-details">
            <table class="table table-bordered table-custom">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($is_admin) { ?>
                        <tr class="highlight-admin">
                            <td>User ID</td>
                            <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                        </tr>
                        <tr class="highlight-admin">
                            <td>Username</td>
                            <td><?php echo htmlspecialchars($order['fname']); ?></td>
                        </tr>
                        <tr class="highlight-admin">
                            <td>Email</td>
                            <td><?php echo htmlspecialchars($order['email']); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>Order ID</td>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo htmlspecialchars($order['phone']); ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td><?php echo htmlspecialchars($order['pincode']); ?></td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>₹<?php echo number_format($order['subtotal'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>₹<?php echo number_format($order['shipping'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>₹<?php echo number_format($order['total'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php if ($is_admin) { ?>
                <a href="admin_user_orders.php" class="btn btn-custom mt-3">Back to Orders</a>
            <?php } ?>
        </div>
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