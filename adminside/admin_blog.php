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

// Handle file upload and add blog post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_blog'])) {
        $uploadDir = 'uploads/';
        $image = uploadFile($_FILES['blog_image'], $uploadDir);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        if ($image) {
            $stmt = $conn->prepare("INSERT INTO blog (title, description, image, status) VALUES (?, ?, ?, 'active')");
            $stmt->bind_param('sss', $title, $description, $image);
            if ($stmt->execute()) {
                setMessage('success', 'Blog post added successfully!');
            } else {
                setMessage('error', 'Error adding blog post!');
            }
        } else {
            setMessage('error', 'Error uploading image!');
        }

        header('Location: admin_blog.php');
        exit;
    } elseif (isset($_POST['update_blog'])) {
        $id = $_POST['blog_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $uploadDir = 'uploads/';
        $image = $_FILES['blog_image']['name'];

        if ($image) {
            // Get the current image file to delete the old one
            $stmt = $conn->prepare("SELECT image FROM blog WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($current_image);
            $stmt->fetch();
            $stmt->close();

            if (file_exists($uploadDir . $current_image)) {
                unlink($uploadDir . $current_image);
            }

            $image = uploadFile($_FILES['blog_image'], $uploadDir);

            // Update blog post with new image and details
            $stmt = $conn->prepare("UPDATE blog SET title = ?, description = ?, image = ? WHERE id = ?");
            $stmt->bind_param('sssi', $title, $description, $image, $id);
        } else {
            // Only update details if no new image is uploaded
            $stmt = $conn->prepare("UPDATE blog SET title = ?, description = ? WHERE id = ?");
            $stmt->bind_param('ssi', $title, $description, $id);
        }

        if ($stmt->execute()) {
            setMessage('success', 'Blog post updated successfully!');
        } else {
            setMessage('error', 'Error updating blog post!');
        }

        header('Location: admin_blog.php');
        exit;
    }
}

// Handle blog post deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $conn->prepare("SELECT image FROM blog WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    if (file_exists('uploads/' . $image)) {
        unlink('uploads/' . $image);
    }

    $stmt = $conn->prepare("DELETE FROM blog WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        setMessage('success', 'Blog post deleted successfully!');
    } else {
        setMessage('error', 'Error deleting blog post!');
    }

    header('Location: admin_blog.php');
    exit;
}

// Toggle blog post status (active/inactive)
if (isset($_GET['toggle_status']) && isset($_GET['status'])) {
    $id = $_GET['toggle_status'];
    $new_status = $_GET['status'];

    $stmt = $conn->prepare("UPDATE blog SET status = ? WHERE id = ?");
    $stmt->bind_param('si', $new_status, $id);
    if ($stmt->execute()) {
        setMessage('success', 'Blog post status updated successfully!');
    } else {
        setMessage('error', 'Error updating blog post status!');
    }

    header('Location: admin_blog.php');
    exit;
}

// Get all blog posts ordered by ID in descending order
$result = $conn->query("SELECT * FROM blog ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Blog Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body h2 {
            margin-top: 100px;
        }
        .blog-img {
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
    <h2 class="text-center">Blog Management</h2>

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

    <!-- Edit Blog Form (Shown when editing) -->
    <?php if (isset($_GET['edit'])): 
        $id = $_GET['edit'];
        $stmt = $conn->prepare("SELECT * FROM blog WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $blog = $stmt->get_result()->fetch_assoc();
    ?>
    <hr>
    <h3>Edit Blog Post</h3>
    <form action="admin_blog.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="blog_id" value="<?= $blog['id']; ?>">
        <div class="mb-3">
            <label for="blog_image" class="form-label">Update Blog Image (Optional)</label>
            <input type="file" class="form-control" name="blog_image">
            <img src="uploads/<?= $blog['image']; ?>" alt="Blog Image" class="blog-img mt-2">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="<?= $blog['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description"><?= $blog['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="update_blog">Update Blog Post</button>
    </form>
    <?php endif; ?>

    <hr>

    <!-- Add Blog Form -->
    <?php if (!isset($_GET['edit'])): ?>
    <form action="admin_blog.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="blog_image" class="form-label">Upload Blog Image</label>
            <input type="file" class="form-control" name="blog_image" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="add_blog">Add Blog Post</button>
    </form>
    <?php endif; ?>

    <hr>

    <!-- Display existing blog posts -->
    <h3>Existing Blog Posts</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Sr no</th>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $srNo = 1; // Initialize serial number
        while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $srNo++; ?></td> <!-- Increment serial number for each row -->
                <td><img src="uploads/<?= $row['image']; ?>" alt="Blog Image" class="blog-img"></td>
                <td><?= $row['title']; ?></td>
                <td><?= $row['description']; ?></td>
                <td>
                    <a href="admin_blog.php?delete=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
                    <?php if ($row['status'] == 'active'): ?>
                        <a href="admin_blog.php?toggle_status=<?= $row['id']; ?>&status=inactive" class="btn btn-warning">Set Inactive</a>
                    <?php else: ?>
                        <a href="admin_blog.php?toggle_status=<?= $row['id']; ?>&status=active" class="btn btn-success">Set Active</a>
                    <?php endif; ?>
                    <a href="admin_blog.php?edit=<?= $row['id']; ?>" class="btn btn-info">Edit</a>
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
