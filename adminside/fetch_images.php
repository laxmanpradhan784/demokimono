<?php
header('Content-Type: application/json');

// Start the session
session_start();

// Include the database connection file
require_once 'conn.php';

// Check if the user is an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$sql = "SELECT * FROM photo WHERE status = 'active'";
$result = $conn->query($sql);

$photos = [];
while ($row = $result->fetch_assoc()) {
    $photos[] = $row['image_url'];
}

echo json_encode($photos);
?>
