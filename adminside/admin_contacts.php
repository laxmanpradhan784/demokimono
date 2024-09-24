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

// Handle delete request
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $delete_id);

    if ($stmt->execute()) {
        $success = "Record deleted successfully.";
    } else {
        $error = "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch contact form submissions
$query = "SELECT id, name, email, subject, message FROM contacts ORDER BY id DESC";
$result = $conn->query($query);

if (!$result) {
    die("Error fetching data: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kimono</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
        .table-responsive {
            border-radius: 10px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .container h1 {
            margin-top: 100px;
        }
        /* Hide the messages with opacity 0 and transition effect */
        .alert {
            transition: opacity 1s ease-in-out;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Contact Form Submissions</h1>

        <!-- Success message -->
        <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <!-- Error message -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Contact Form Submissions Table -->
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered bg-secondary">
                    <thead class="bg-white">
                        <tr>
                            <th>Sr no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $srNo = 1;
                         while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $srNo++; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                                <td>
                                    <a href="admin_contacts.php?delete=<?php echo htmlspecialchars($row['id']); ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this record?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                No submissions found.
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; 2024 Kimono Photography. All rights reserved.</p>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fade out alerts after 2 seconds
            setTimeout(function() {
                const alertMessages = document.querySelectorAll('.alert');
                alertMessages.forEach(function(alert) {
                    alert.style.opacity = '0'; // Fade out
                    setTimeout(function() {
                        alert.remove(); // Remove from the DOM after fade out
                    }, 1000); // Allow fade-out duration before removing
                });
            }, 2000);
        });
    </script>

</body>

</html>
