<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, redirect to home page or another page
    header("Location: login.php"); // Replace with your preferred redirect page
    exit();
}
$user_id = $_SESSION['user_id'];

// Ensure the user exists
$query = "SELECT id FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('User does not exist.');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $token = trim($_POST['token']);
    $new_password = trim($_POST['new_password']);



    // Validate input
    if (empty($token) || empty($new_password)) {
        $error = "Please enter the token and new password.";
    } else {
        // Prepare the SQL statement to find the token
        $sql = "SELECT user_id FROM password WHERE token = ? AND created_at > NOW() - INTERVAL 1 HOUR"; // Token valid for 1 hour
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id);
            $stmt->fetch();

            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the user's password
            $update_password_query = "UPDATE user SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($update_password_query);
            $stmt->bind_param("si", $hashed_password, $user_id);
            $stmt->execute();

            // Delete the token after use
            $delete_token_query = "DELETE FROM password WHERE token = ?";
            $stmt = $conn->prepare($delete_token_query);
            $stmt->bind_param("s", $token);
            $stmt->execute();

            // Redirect to login page or show a success message
            header("Location: login.php");
            exit;
        } else {
            $error = "Invalid or expired token.";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kimono</title>
    <!-- Include your CSS and JS files here -->
</head>
<body>
    <form method="post" action="">
        <input type="text" name="token" placeholder="Enter your reset token" required>
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <button type="submit">Reset Password</button>
    </form>
    <?php if (isset($error)) { echo '<div class="error">'.$error.'</div>'; } ?>
</body>
</html>
