<?php
session_start(); // Start the session

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit;
}

include 'conn.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        // Handle product deletion
        $deleteId = $_POST['delete_id'];
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $deleteId);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        exit;
    } elseif (isset($_POST['updateProductId'])) {
        // Handle product update
        $updateId = $_POST['updateProductId'];
        $productName = $_POST['updateProductName'];
        $productPrice = $_POST['updateProductPrice'];
        $productOldPrice = $_POST['updateProductOldPrice'] ?? null;
        $productStatus = $_POST['updateProductStatus'];

        // Handle image upload if a new image is provided
        if (!empty($_FILES['updateProductImage']['name'])) {
            $targetDir = "../assets/img/shop/";
            $targetFile = $targetDir . basename($_FILES["updateProductImage"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if image file is a valid image
            $check = getimagesize($_FILES["updateProductImage"]["tmp_name"]);
            if ($check === false) {
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["updateProductImage"]["size"] > 500000) {
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["updateProductImage"]["tmp_name"], $targetFile);
                $productImage = basename($_FILES["updateProductImage"]["name"]);
            } else {
                exit;
            }
        } else {
            $productImage = null; // Keep the existing image if no new image is uploaded
        }

        // Update product details in the database
        if ($productImage) {
            $sql = "UPDATE product SET name = ?, price = ?, old_price = ?, status = ?, image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $productName, $productPrice, $productOldPrice, $productStatus, $productImage, $updateId);
        } else {
            $sql = "UPDATE product SET name = ?, price = ?, old_price = ?, status = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $productName, $productPrice, $productOldPrice, $productStatus, $updateId);
        }

        $stmt->execute();
        $stmt->close();
        $conn->close();
        exit;
    } else {
        // Handle product addition
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productOldPrice = $_POST['productOldPrice'] ?? null;
        $productStatus = $_POST['productStatus'];

        // Handle image upload
        $targetDir = "../assets/img/shop/";
        $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a valid image
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["productImage"]["size"] > 500000) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            exit;
        } else {
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                // Insert product details into database
                $sql = "INSERT INTO product (name, price, old_price, status, image) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $productName, $productPrice, $productOldPrice, $productStatus, basename($_FILES["productImage"]["name"]));

                $stmt->execute();
                $stmt->close();
            }
        }
        $conn->close();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kimono</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global text color */
        body {
            color: white;
        }

        .content-container {
            margin-top: 180px;
        }

        .product-thumb img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .product-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .product-item:hover {
            transform: scale(1.05);
        }

        .product-item-inner {
            padding: 15px;
        }

        .old-price {
            color: #999;
            text-decoration: line-through;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4CAF50, #66BB6A);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #388E3C, #43A047);
        }

        .btn-danger {
            background: linear-gradient(45deg, #E57373, #EF5350);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #D32F2F, #C62828);
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
    <?php include 'navbar.php'; ?>

    <div class="container content-container">
        <h1 class="mb-4">Manage Products</h1>

        <!-- Form for Adding Products -->
        <form id="productForm" method="POST" enctype="multipart/form-data" class="mb-5">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName" required>
                </div>
                <div class="col-md-3">
                    <label for="productPrice" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
                </div>
                <div class="col-md-3">
                    <label for="productOldPrice" class="form-label">Old Price (if applicable)</label>
                    <input type="number" class="form-control" id="productOldPrice" name="productOldPrice" step="0.01">
                </div>
                <div class="col-md-12">
                    <label for="productStatus" class="form-label">Product Status</label>
                    <select class="form-control" id="productStatus" name="productStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="productImage" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="productImage" name="productImage" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Add Product</button>
        </form>

        <!-- Toggle Between Active, Inactive, and All Products -->
        <div class="mb-4">
            <button id="showAllProducts" class="btn btn-secondary me-2">Show All Products</button>
            <button id="showActiveProducts" class="btn btn-primary me-2">Show Active Products</button>
            <button id="showInactiveProducts" class="btn btn-warning">Show Inactive Products</button>
        </div>

        <!-- Display Products -->
        <h2 class="mt-5">Product List</h2>
        <div id="productList" class="row">
            <?php
            // Default to showing active products
            $statusFilter = 'active';

            if (isset($_GET['show_all']) && $_GET['show_all'] == 'true') {
                $statusFilter = '%'; // Wildcard to show all products
            } elseif (isset($_GET['show_inactive']) && $_GET['show_inactive'] == 'true') {
                $statusFilter = 'inactive'; // Filter to show inactive products
            }

            $sql = "SELECT * FROM product WHERE status LIKE ? ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $statusFilter);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 col-lg-3 mb-4">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <img src="../assets/img/shop/' . htmlspecialchars($row['image']) . '" alt="Product Image">
                                </div>
                                <div class="product-item-inner mt-2">
                                    <h5 class="product-item-name">
                                        <a href="shop-product.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a>
                                    </h5>
                                    <p class="product-item-price">
                                        $' . htmlspecialchars($row['price']);
                    if (!empty($row['old_price'])) {
                        echo ' <span class="old-price">$' . htmlspecialchars($row['old_price']) . '</span>';
                    }
                    echo '</p>
                                    <button class="btn btn-primary btn-sm update-product" data-id="' . $row['id'] . '">Update</button>
                                    <button class="btn btn-danger btn-sm delete-product" data-id="' . $row['id'] . '">Delete</button>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Update Product Modal -->
    <div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProductModalLabel">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateProductForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="updateProductId" name="updateProductId">
                        <div class="mb-3">
                            <label for="updateProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="updateProductName" name="updateProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateProductPrice" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="updateProductPrice" name="updateProductPrice" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateProductOldPrice" class="form-label">Old Price (if applicable)</label>
                            <input type="number" class="form-control" id="updateProductOldPrice" name="updateProductOldPrice" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="updateProductStatus" class="form-label">Product Status</label>
                            <select class="form-control" id="updateProductStatus" name="updateProductStatus" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="updateProductImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="updateProductImage" name="updateProductImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Kimono Photography. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle product form submission
            document.getElementById('productForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                fetch('admin_manage_products.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(() => {
                        window.location.reload(); // Reload the page to show updated product list
                    })
                    .catch(() => {
                        window.location.reload(); // Reload the page in case of error
                    });
            });

            // Handle product deletion
            document.getElementById('productList').addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-product')) {
                    if (confirm('Are you sure you want to delete this product?')) {
                        var productId = event.target.getAttribute('data-id');

                        fetch('admin_manage_products.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'delete_id=' + encodeURIComponent(productId)
                            })
                            .then(() => {
                                window.location.reload(); // Reload the page to reflect deletion
                            })
                            .catch(() => {
                                window.location.reload(); // Reload the page in case of error
                            });
                    }
                }

                // Handle product update (open modal)
                if (event.target.classList.contains('update-product')) {
                    var productId = event.target.getAttribute('data-id');

                    fetch('get_product_details.php?id=' + productId)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('updateProductId').value = data.id;
                            document.getElementById('updateProductName').value = data.name;
                            document.getElementById('updateProductPrice').value = data.price;
                            document.getElementById('updateProductOldPrice').value = data.old_price;
                            document.getElementById('updateProductStatus').value = data.status;

                            var modal = new bootstrap.Modal(document.getElementById('updateProductModal'));
                            modal.show();
                        });
                }
            });

            // Handle update product form submission
            document.getElementById('updateProductForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                fetch('admin_manage_products.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(() => {
                        window.location.reload(); // Reload the page to show updated product list
                    })
                    .catch(() => {
                        window.location.reload(); // Reload the page in case of error
                    });
            });

            // Toggle between showing all, active, and inactive products
            document.getElementById('showAllProducts').addEventListener('click', function() {
                window.location.href = 'admin_manage_products.php?show_all=true';
            });

            document.getElementById('showActiveProducts').addEventListener('click', function() {
                window.location.href = 'admin_manage_products.php';
            });

            document.getElementById('showInactiveProducts').addEventListener('click', function() {
                window.location.href = 'admin_manage_products.php?show_inactive=true';
            });
        });
    </script>


</body>

</html>