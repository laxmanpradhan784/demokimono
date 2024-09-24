<?php
// Start the session
session_name('user_session');
session_start();


// Include the database connection file
require_once 'conn.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Get the order ID from the query parameter (if available)
$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;

// Prepare the query to fetch orders
if ($orderId) {
    // Fetch a specific order
    $ordersQuery = "SELECT id, full_name, phone, address, pincode, subtotal, shipping, total, order_date
                    FROM cart_order
                    WHERE user_id = ? AND id = ?";
    $stmt = $conn->prepare($ordersQuery);
    $stmt->bind_param('ii', $userId, $orderId);
} else {
    // Fetch all orders
    $ordersQuery = "SELECT id, full_name, phone, address, pincode, subtotal, shipping, total, order_date
                    FROM cart_order
                    WHERE user_id = ?
                    ORDER BY order_date DESC";
    $stmt = $conn->prepare($ordersQuery);
    $stmt->bind_param('i', $userId);
}

$stmt->execute();
$ordersResult = $stmt->get_result();

// Check if there are any orders
if ($ordersResult->num_rows === 0) {
    die("No orders found for your account");
}

// Output CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=orders.csv');

// Open output stream for CSV
$output = fopen('php://output', 'w');

// Output CSV column headers
fputcsv($output, ['Order ID', 'Full Name', 'Phone', 'Address', 'Pincode', 'Subtotal', 'Shipping', 'Total', 'Order Date']);

// Output order data
while ($order = $ordersResult->fetch_assoc()) {
    fputcsv($output, [
        $order['id'],
        $order['full_name'],
        $order['phone'],
        $order['address'],
        $order['pincode'],
        number_format($order['subtotal'], 2),
        number_format($order['shipping'], 2),
        number_format($order['total'], 2),
        $order['order_date']
    ]);
}

// Close output stream
fclose($output);

// Close the statement and connection
$stmt->close();
$conn->close();
exit;
?>
