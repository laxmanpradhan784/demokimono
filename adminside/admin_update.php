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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'update_status') {
        $booking_id = intval($_POST['booking_id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $query = "UPDATE booking SET status = '$status' WHERE id = $booking_id";
        if (mysqli_query($conn, $query)) {
            echo 'Status updated successfully.';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    if ($action == 'delete_booking') {
        $booking_id = intval($_POST['booking_id']);

        $query = "DELETE FROM booking WHERE id = $booking_id";
        if (mysqli_query($conn, $query)) {
            echo 'Booking deleted successfully.';
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
}
?>
