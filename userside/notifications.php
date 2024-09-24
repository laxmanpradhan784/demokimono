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

// Handle marking notifications as read
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notification_id'])) {
    $notification_id = intval($_POST['notification_id']);

    // Update the notification status to read
    $update_query = "UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ii", $notification_id, $user_id);
    if ($stmt->execute()) {
        // Redirect to refresh the page
        header("Location: notifications.php");
        exit;
    } else {
        echo "<script>alert('Failed to mark notification as read.');</script>";
    }
}


// Fetch unread notifications
$notifications_query = "SELECT * FROM notifications WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC";
$stmt = $conn->prepare($notifications_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$unread_count = $result->num_rows;
$stmt->close();

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kimono - Photography Agency">
    <meta name="author" content="">

    <!-- Favicon and touch Icons -->
    <link href="../assets/img/favicon.png" rel="shortcut icon" type="image/png">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="../assets/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="../assets/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Page Title -->
    <title>Kimono</title>    

    <!-- Styles Include -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/swiper.min.css"> <!-- Add Swiper CSS -->
</head>
<body>
    <!-- Your body content -->
    <div class="container">
        <h1 class="text-center mt-5">
            Notifications
        </h1>
        <!-- Back Button -->
        <div class="d-flex justify-content-center mb-4">
            <a href="project-modern-col-3.php" class="back-button">Back</a>
        </div>

        <!-- Notifications Card -->
        <div class="card mt-5">
            <div class="card-body">
                <?php if (isset($unread_count) && $unread_count > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="notification-item">
                                    <td class="notification-message"><?php echo htmlspecialchars($row['message']); ?></td>
                                    <td class="notification-time"><?php echo date('Y-m-d H:i:s', strtotime($row['created_at'])); ?></td>
                                    <td>
                                        <?php if ($row['is_read'] == 0): ?>
                                            <form action="notifications.php" method="POST" class="d-inline">
                                                <input type="hidden" name="notification_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-success btn-sm">Mark as Read</button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-muted">Read</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No new notifications</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Your scripts -->
</body>
</html>
