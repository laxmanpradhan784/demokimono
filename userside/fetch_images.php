<?php
// fetch_images.php

// Database connection
include 'conn.php';

// Fetch image URLs
$sql = "SELECT image_url FROM photo";
$result = $conn->query($sql);

$images = [];
while ($row = $result->fetch_assoc()) {
    // Extract filename from the URL (e.g., 'image1.jpg')
    $images[] = basename($row['image_url']);
}

header('Content-Type: application/json');
echo json_encode($images);
?>
