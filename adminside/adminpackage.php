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

include 'navbar.php';

// Handle form submissions for adding, editing, deleting, and toggling status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add']) || isset($_POST['edit'])) {
        // Handle file upload
        $image_url = $_POST['current_image_url'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/img/packages/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);

            // Check if directory exists and create it if necessary
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move uploaded file and update image_url
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image_url = basename($_FILES['image']['name']);
            } else {
                echo "File upload failed.";
            }
        }

        $package_name = $_POST['package_name'];
        $description = $_POST['description'];
        $details = $_POST['details'];
        $status = $_POST['status'];

        if (isset($_POST['add'])) {
            // Add new package
            $query = "INSERT INTO package (package_name, description, image_url, details, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'sssss', $package_name, $description, $image_url, $details, $status);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } elseif (isset($_POST['edit'])) {
            // Edit existing package
            $id = $_POST['id'];
            $query = "UPDATE package SET package_name = ?, description = ?, image_url = ?, details = ?, status = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'sssssi', $package_name, $description, $image_url, $details, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } elseif (isset($_POST['delete'])) {
        // Delete package
        $id = $_POST['id'];
        $query = "DELETE FROM package WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } elseif (isset($_POST['toggle_status'])) {
        // Toggle status (active/inactive)
        $id = $_POST['id'];
        $current_status = $_POST['current_status'];
        $new_status = ($current_status === 'active') ? 'inactive' : 'active';
        
        $query = "UPDATE package SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'si', $new_status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Fetch all packages from the database
$query = "SELECT * FROM package ORDER BY id DESC";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Management - Kimono Photography</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container,
        .package-list {
            margin-top: 100px;
            text-align: center;
        }

        .form-container input,
        .form-container textarea,
        .form-container button {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .package-list table img {
            width: 100px;
            height: auto;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }

        .btn-danger-custom {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-danger-custom:hover {
            background-color: #c82333;
            color: white;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2 class="mb-4">Add/Edit Package</h2>
        <form action="adminpackage.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" name="id" id="package-id">
            <input type="hidden" name="current_image_url" id="current-image-url">
            <div class="mb-3">
                <input type="text" class="form-control" name="package_name" id="package-name" placeholder="Package Name">
                <div id="package-name-error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                <div id="description-error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" name="image" id="image-url" placeholder="Image URL" accept="image/*">
                <div id="image-url-error" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="details" id="details" placeholder="Details"></textarea>
                <div id="details-error" class="text-danger"></div>
            </div>
            <button type="submit" class="btn btn-custom" name="add" id="add-button">Add Package</button>
            <button type="submit" class="btn btn-custom" name="edit" id="edit-button" style="display: none;">Edit Package</button>
        </form>
    </div>

    <div class="container package-list">
        <h2 class="mb-4">Existing Packages</h2>
        <table class="table table-bordered">
            <thead class="table-light thead-white">
                <tr>
                    <th>Sr No</th>
                    <th>Package Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sr_no = 1; // Initialize Sr No
                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr class="bg-white">
                        <td><?php echo $sr_no++; ?></td>
                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><img src="../assets/img/packages/<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['package_name']); ?>"></td>
                        <td><?php echo htmlspecialchars($row['details']); ?></td>
                        <td>
                            <!-- Form to delete a package -->
                            <form action="adminpackage.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-danger btn-danger-custom" name="delete">Delete</button>
                            </form>

                            <!-- Form to toggle package status -->
                            <form action="adminpackage.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="hidden" name="current_status" value="<?php echo htmlspecialchars($row['status']); ?>">
                                <button type="submit" class="btn btn-custom" name="toggle_status">
                                    <?php echo htmlspecialchars($row['status']) === 'active' ? 'Deactivate' : 'Activate'; ?>
                                </button>
                            </form>

                            <!-- Button to edit a package -->
                            <button onclick="editPackage(<?php echo htmlspecialchars($row['id']); ?>, '<?php echo htmlspecialchars(addslashes($row['package_name'])); ?>', '<?php echo htmlspecialchars(addslashes($row['description'])); ?>', '<?php echo htmlspecialchars(addslashes($row['image_url'])); ?>', '<?php echo htmlspecialchars(addslashes($row['details'])); ?>')" class="btn btn-custom">
                                Edit
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; 2024 Kimono Photography</p>
    </div>

    <script>
        function editPackage(id, packageName, description, imageUrl, details) {
            document.getElementById('package-id').value = id;
            document.getElementById('package-name').value = packageName;
            document.getElementById('description').value = description;
            document.getElementById('current-image-url').value = imageUrl;
            document.getElementById('details').value = details;
            document.getElementById('add-button').style.display = 'none';
            document.getElementById('edit-button').style.display = 'block';
        }
        
        function validateForm() {
            let isValid = true;

            // Add your validation logic here

            return isValid;
        }
    </script>
</body>

</html>
