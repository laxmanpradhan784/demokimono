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

// Handle file upload and add slider
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_slider'])) {
        $uploadDir = 'uploads/';
        $image = uploadFile($_FILES['slider_image'], $uploadDir);
        $caption = $_POST['caption'] ?? '';

        if ($image) {
            $stmt = $conn->prepare("INSERT INTO sliders (image, caption, status) VALUES (?, ?, 'active')");
            $stmt->bind_param('ss', $image, $caption);
            if ($stmt->execute()) {
                setMessage('success', 'Slider added successfully!');
            } else {
                setMessage('error', 'Error adding slider!');
            }
        } else {
            setMessage('error', 'Error uploading image!');
        }

        header('Location: admin_slider.php');
        exit;
    } elseif (isset($_POST['update_slider'])) {
        $id = $_POST['slider_id'];
        $caption = $_POST['caption'];
        $uploadDir = 'uploads/';
        $image = $_FILES['slider_image']['name'];

        if ($image) {
            // Get the current image file to delete the old one
            $stmt = $conn->prepare("SELECT image FROM sliders WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($current_image);
            $stmt->fetch();
            $stmt->close();

            if (file_exists($uploadDir . $current_image)) {
                unlink($uploadDir . $current_image);
            }

            $image = uploadFile($_FILES['slider_image'], $uploadDir);

            // Update slider with new image and caption
            $stmt = $conn->prepare("UPDATE sliders SET image = ?, caption = ? WHERE id = ?");
            $stmt->bind_param('ssi', $image, $caption, $id);
        } else {
            // Only update caption if no new image is uploaded
            $stmt = $conn->prepare("UPDATE sliders SET caption = ? WHERE id = ?");
            $stmt->bind_param('si', $caption, $id);
        }

        if ($stmt->execute()) {
            setMessage('success', 'Slider updated successfully!');
        } else {
            setMessage('error', 'Error updating slider!');
        }

        header('Location: admin_slider.php');
        exit;
    }
}

// Handle slider deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("SELECT image FROM sliders WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    if (file_exists('uploads/' . $image)) {
        // Check if image is referenced by any other slider
        $stmt = $conn->prepare("SELECT COUNT(*) FROM sliders WHERE image = ?");
        $stmt->bind_param('s', $image);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        // If the image is not referenced by any other slider, delete it
        if ($count == 1) {
            unlink('uploads/' . $image);
        }
    }

    $stmt = $conn->prepare("DELETE FROM sliders WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        setMessage('success', 'Slider deleted successfully!');
    } else {
        setMessage('error', 'Error deleting slider!');
    }

    header('Location: admin_slider.php');
    exit;
}

// Toggle slider status (active/inactive)
if (isset($_GET['toggle_status']) && isset($_GET['status'])) {
    $id = $_GET['toggle_status'];
    $new_status = $_GET['status'];

    $stmt = $conn->prepare("UPDATE sliders SET status = ? WHERE id = ?");
    $stmt->bind_param('si', $new_status, $id);
    if ($stmt->execute()) {
        setMessage('success', 'Slider status updated successfully!');
    } else {
        setMessage('error', 'Error updating slider status!');
    }

    header('Location: admin_slider.php');
    exit;
}

// Get all sliders ordered by ID in descending order
$result = $conn->query("SELECT * FROM sliders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Slider Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body h2 {
            margin-top: 100px;
        }
        .slider-img {
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
    <h2 class="text-center">Slider Management</h2>

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

    <!-- Edit Slider Form (Shown when editing) -->
    <?php if (isset($_GET['edit'])): 
        $id = $_GET['edit'];
        $stmt = $conn->prepare("SELECT * FROM sliders WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $slider = $stmt->get_result()->fetch_assoc();
    ?>
    <hr>
    <h3>Edit Slider</h3>
    <form action="admin_slider.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="slider_id" value="<?= $slider['id']; ?>">
        <div class="mb-3">
            <label for="slider_image" class="form-label">Update Slider Image (Optional)</label>
            <input type="file" class="form-control" name="slider_image">
            <img src="uploads/<?= $slider['image']; ?>" alt="Slider Image" class="slider-img mt-2">
        </div>
        <div class="mb-3">
            <label for="caption" class="form-label">Caption</label>
            <input type="text" class="form-control" name="caption" value="<?= $slider['caption']; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="update_slider">Update Slider</button>
    </form>
    <?php endif; ?>

    <hr>

    <!-- Add Slider Form -->
    <?php if (!isset($_GET['edit'])): ?>
    <form action="admin_slider.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="slider_image" class="form-label">Upload Slider Image</label>
            <input type="file" class="form-control" name="slider_image" required>
        </div>
        <div class="mb-3">
            <label for="caption" class="form-label">Caption (Optional)</label>
            <input type="text" class="form-control" name="caption" required>
        </div>
        <button type="submit" class="btn btn-primary" name="add_slider">Add Slider</button>
    </form>
    <?php endif; ?>

    <hr>

    <!-- Display existing sliders -->
    <h3>Existing Sliders</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Sr no</th>
            <th>Image</th>
            <th>Caption</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $srNo = 1; // Initialize serial number
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $srNo++; ?></td> <!-- Increment serial number for each row -->
                <td><img src="uploads/<?= $row['image']; ?>" alt="Slider Image" class="slider-img"></td>
                <td><?= $row['caption']; ?></td>
                <td>
                    <a href="admin_slider.php?delete=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
                    <?php if ($row['status'] == 'active'): ?>
                        <a href="admin_slider.php?toggle_status=<?= $row['id']; ?>&status=inactive" class="btn btn-warning">Set Inactive</a>
                    <?php else: ?>
                        <a href="admin_slider.php?toggle_status=<?= $row['id']; ?>&status=active" class="btn btn-success">Set Active</a>
                    <?php endif; ?>
                    <a href="admin_slider.php?edit=<?= $row['id']; ?>" class="btn btn-info">Edit</a>
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
