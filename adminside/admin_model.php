<?php
// Start the session
session_start();

// Include the database connection file
require_once 'conn.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to the admin login page if not logged in as an admin
    header("Location: admin_login.php");
    exit;
}

// Function to handle file uploads with unique filenames
function uploadFile($file, $uploadDir) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uniqueName = time() . '_' . bin2hex(random_bytes(8)) . '_' . basename($file['name']);
        $imagePath = $uploadDir . $uniqueName;
        if (move_uploaded_file($file['tmp_name'], $imagePath)) {
            return $uniqueName;
        }
    }
    return false;
}

// Function to set a message in the session
function setMessage($type, $message) {
    $_SESSION['message_type'] = $type;
    $_SESSION['message'] = $message;
}

// Function to get and clear messages from the session
function getMessage() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $type = $_SESSION['message_type'] ?? 'info'; // Default to 'info' if type not set
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        return ['type' => $type, 'message' => $message];
    }
    return null;
}

// Handle file upload and add model
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_model'])) {
        $uploadDir = 'uploads/';
        $image = uploadFile($_FILES['model_image'], $uploadDir);

        if ($image) {
            $stmt = $conn->prepare("INSERT INTO model (image, status) VALUES (?, 'active')");
            $stmt->bind_param('s', $image);
            if ($stmt->execute()) {
                setMessage('success', 'Model added successfully!');
            } else {
                setMessage('error', 'Error adding model!');
            }
        } else {
            setMessage('error', 'Error uploading image!');
        }

        header('Location: admin_model.php');
        exit;
    } elseif (isset($_POST['update_model'])) {
        $id = $_POST['model_id'];
        $uploadDir = 'uploads/';
        $image = $_FILES['model_image']['name'];

        if ($image) {
            // Get the current image file to delete the old one
            $stmt = $conn->prepare("SELECT image FROM model WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($current_image);
            $stmt->fetch();
            $stmt->close();

            if (file_exists($uploadDir . $current_image)) {
                unlink($uploadDir . $current_image);
            }

            $image = uploadFile($_FILES['model_image'], $uploadDir);

            // Update model with new image
            $stmt = $conn->prepare("UPDATE model SET image = ? WHERE id = ?");
            $stmt->bind_param('si', $image, $id);
        } else {
            // Only update image if a new one is uploaded
            $stmt = $conn->prepare("UPDATE model SET image = image WHERE id = ?");
            $stmt->bind_param('i', $id);
        }

        if ($stmt->execute()) {
            setMessage('success', 'Model updated successfully!');
        } else {
            setMessage('error', 'Error updating model!');
        }

        header('Location: admin_model.php');
        exit;
    }
}

// Handle model deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("SELECT image FROM model WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    if (file_exists('uploads/' . $image)) {
        unlink('uploads/' . $image);
    }

    $stmt = $conn->prepare("DELETE FROM model WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        setMessage('success', 'Model deleted successfully!');
    } else {
        setMessage('error', 'Error deleting model!');
    }

    header('Location: admin_model.php');
    exit;
}

// Toggle model status (active/inactive)
if (isset($_GET['toggle_status']) && isset($_GET['status'])) {
    $id = $_GET['toggle_status'];
    $new_status = $_GET['status'];

    $stmt = $conn->prepare("UPDATE model SET status = ? WHERE id = ?");
    $stmt->bind_param('si', $new_status, $id);
    if ($stmt->execute()) {
        setMessage('success', 'Model status updated successfully!');
    } else {
        setMessage('error', 'Error updating model status!');
    }

    header('Location: admin_model.php');
    exit;
}

// Get all models ordered by ID in descending order
$result = $conn->query("SELECT * FROM model ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Model Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body h2 {
            margin-top: 100px;
        }
        .model-img {
            max-width: 80px; /* Adjust the width as needed */
            height: auto; /* Keep aspect ratio */
        }
        .table {
            color: #343a40;
            background-color: gray;
            margin-bottom: 100px;
        }
        .alert {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php';?>
<div class="container">
    <h2 class="text-center">Model Management</h2>

    <!-- Display any messages -->
    <?php
    $message = getMessage();
    if ($message):
        $alertClass = $message['type'] === 'success' ? 'alert-success' : 'alert-danger';
    ?>
        <div id="alert-message" class="alert <?= $alertClass; ?>">
            <?= $message['message']; ?>
        </div>
    <?php endif; ?>

    <!-- Edit Model Form (Shown when editing) -->
    <?php if (isset($_GET['edit'])): 
        $id = $_GET['edit'];
        $stmt = $conn->prepare("SELECT * FROM model WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $model = $stmt->get_result()->fetch_assoc();
    ?>
    <hr>
    <h3>Edit Model</h3>
    <form action="admin_model.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="model_id" value="<?= $model['id']; ?>">
        <div class="mb-3">
            <label for="model_image" class="form-label">Update Model Image (Optional)</label>
            <input type="file" class="form-control" name="model_image">
            <img src="uploads/<?= $model['image']; ?>" alt="Model Image" class="model-img mt-2">
        </div>
        <button type="submit" class="btn btn-primary" name="update_model">Update Model</button>
    </form>
    <?php endif; ?>

    <hr>

    <!-- Add Model Form -->
    <?php if (!isset($_GET['edit'])): ?>
    <form action="admin_model.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="model_image" class="form-label">Upload Model Image</label>
            <input type="file" class="form-control" name="model_image" required>
        </div>
        <button type="submit" class="btn btn-primary" name="add_model">Add Model</button>
    </form>
    <?php endif; ?>

    <hr>

    <!-- Display existing models -->
    <h3>Existing Models</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Sr no</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $srNo = 1; // Initialize serial number
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $srNo++; ?></td> <!-- Increment serial number for each row -->
                <td><img src="uploads/<?= $row['image']; ?>" alt="Model Image" class="model-img"></td>
                <td>
                    <a href="admin_model.php?delete=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
                    <?php if ($row['status'] == 'active'): ?>
                        <a href="admin_model.php?toggle_status=<?= $row['id']; ?>&status=inactive" class="btn btn-warning">Set Inactive</a>
                    <?php else: ?>
                        <a href="admin_model.php?toggle_status=<?= $row['id']; ?>&status=active" class="btn btn-success">Set Active</a>
                    <?php endif; ?>
                    <a href="admin_model.php?edit=<?= $row['id']; ?>" class="btn btn-info">Edit</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<div class="footer text-center">
        <p>&copy; 2024 Kimono Photography. All rights reserved.</p>
    </div>

    <script>
        // Function to hide the alert message after 1 second
        document.addEventListener('DOMContentLoaded', function() {
            var alertMessage = document.getElementById('alert-message');
            if (alertMessage) {
                setTimeout(function() {
                    alertMessage.style.opacity = 0;
                    setTimeout(function() {
                        alertMessage.style.display = 'none';
                    }, 2000); // Match this with the opacity transition duration
                }, 2000); // Delay before hiding
            }
        });
    </script>

</body>
</html>
