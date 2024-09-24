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

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
    $conn->close();
}
?>