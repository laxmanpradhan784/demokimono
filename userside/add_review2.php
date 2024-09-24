<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize inputs
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $reviewer_name = isset($_POST['reviewer_name']) ? trim($_POST['reviewer_name']) : '';
    $review_text = isset($_POST['review_text']) ? trim($_POST['review_text']) : '';

    // Basic validation
    if (empty($reviewer_name) || empty($review_text)) {
        die('All fields are required.');
    }

    // Fetch product details to get name and image
    $sql_product = "SELECT name, image FROM product WHERE id = ? AND status = 'active'";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->bind_param('i', $product_id);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();

    if ($result_product->num_rows === 0) {
        die('Product not found.');
    }
    $product = $result_product->fetch_assoc();
    $product_name = $product['name'];
    $product_image = $product['image'];

    // Insert review into the database
    $sql_insert = "INSERT INTO reviews (product_id, reviewer_name, review_text, product_name, product_image) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param('issss', $product_id, $reviewer_name, $review_text, $product_name, $product_image);

    if ($stmt_insert->execute()) {
        header('Location: shop_detail.php?id=' . $product_id); // Redirect back to the product detail page
    } else {
        die('Error submitting review: ' . $stmt_insert->error);
    }

    // Close statement and connection
    $stmt_insert->close();
    $stmt_product->close();
    $conn->close();
} else {
    die('Invalid request method.');
}
?>
