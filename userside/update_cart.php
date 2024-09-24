<?php
// Start the session
session_name('user_session');
session_start();

include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


// Update cart quantities
if (isset($_POST['quantity'])) {
    $cart_items = $_POST['quantity'];
    $_SESSION['cart'] = array_filter($cart_items, function($qty) {
        return $qty > 0;
    });
}

// Redirect to the cart page
header("Location: shop-cart.php");
exit;
?>
