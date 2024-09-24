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

// Retrieve and validate form data
$fname = isset($_POST['fname']) ? mysqli_real_escape_string($conn, $_POST['fname']) : '';
$phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
$address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : '';
$pincode = isset($_POST['pincode']) ? mysqli_real_escape_string($conn, $_POST['pincode']) : '';

// Validate form data
if (empty($fname) || empty($address) || empty($pincode)) {
    header("Location: shop-checkout.php?error=missing_fields");
    exit;
}

// Fetch cart items
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$cart_product_ids = array_keys($cart_items);

// Insert order into database
$order_query = "INSERT INTO cart_order (user_id, full_name, phone, address, pincode, subtotal, shipping, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $order_query);

// Calculate subtotal and total
$subtotal = 0;
foreach ($cart_product_ids as $product_id) {
    $query = "SELECT price FROM product WHERE id = ?";
    $product_stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($product_stmt, "i", $product_id);
    mysqli_stmt_execute($product_stmt);
    mysqli_stmt_bind_result($product_stmt, $price);
    mysqli_stmt_fetch($product_stmt);
    mysqli_stmt_close($product_stmt);

    $quantity = $cart_items[$product_id];
    $subtotal += $price * $quantity;
}
$shipping = 7; // Example fixed shipping fee
$total = $subtotal + $shipping;

// Bind parameters and execute
mysqli_stmt_bind_param($stmt, "issssddd", $_SESSION['user_id'], $fname, $phone, $address, $pincode, $subtotal, $shipping, $total);
mysqli_stmt_execute($stmt);
$order_id = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);

// Clear cart
unset($_SESSION['cart']);

// Redirect to payment page with order ID
header("Location: payment.php?order_id=" . $order_id);
exit;
?>
