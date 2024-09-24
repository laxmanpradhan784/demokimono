<?php
$user_id = $_SESSION['user_id'] ?? null;

// Ensure the user exists
if ($user_id) {
    $query = "SELECT id FROM user WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Destroy the session and log the user out
        session_unset();
        session_destroy();

        echo "<script>
            alert('User does not exist. Logging out...');
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 2000);
        </script>";
        exit;
    }
} else {
    // If the session ID is not set, destroy the session
    session_unset();
    session_destroy();

    echo "<script>
        alert('Session expired. Logging out...');
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 2000);
    </script>";
    exit;
}
?>
