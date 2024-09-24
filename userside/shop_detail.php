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

// Handle "Add to Cart" action
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    // Redirect to the cart page
    header("Location: shop_detail.php?id=$product_id");
    exit;
}

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details from the database
$sql = "SELECT id, name, price, image FROM product WHERE id = ? AND status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the product exists
if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

// Fetch other products for the sidebar
$sql_sidebar = "SELECT id, name, price, image FROM product WHERE id != ? AND status = 'active' LIMIT 5";
$stmt_sidebar = $conn->prepare($sql_sidebar);
$stmt_sidebar->bind_param('i', $product_id);
$stmt_sidebar->execute();
$result_sidebar = $stmt_sidebar->get_result();

// Fetch reviews for the product
$sql_reviews = "SELECT reviewer_name, review_text, review_date FROM reviews WHERE product_id = ? ORDER BY review_date DESC";
$stmt_reviews = $conn->prepare($sql_reviews);
$stmt_reviews->bind_param('i', $product_id);

// Execute the review query
if ($stmt_reviews->execute()) {
    $result_reviews = $stmt_reviews->get_result();
} else {
    $result_reviews = null;
    // Handle error if needed
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tags -->
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
    <title>Product Detail - Kimono Photography Agency</title>

    <!-- Styles Include -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product_image {
            width: 100%;
            height: auto;
        }

        .product_info {
            text-align: center;
        }

        .product_name {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .product_price {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .cart_button {
            margin-top: 20px;
        }

        .sidebar .product_item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .sidebar .product_item img {
            width: 100%;
            height: auto;
        }

        .sidebar .product_item .product_info {
            padding: 10px;
        }

        .sidebar .product_item h4 {
            font-size: 1rem;
        }

        .sidebar .product_item .product_price {
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .review_section {
            margin-top: 30px;
        }

        .review_item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .review_item .reviewer_name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .review_item .review_date {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 10px;
        }

        .review_item .review_text {
            font-size: 1rem;
        }

        .add_review_form {
            margin-top: 20px;
        }

        .add_review_form h4 {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <?php include 'pronavbar.php'; ?>
    <?php include 'search.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <!-- Product Details Section -->
                <div class="col-lg-8">
                    <div class="product_detail">
                        <img class="product_image" src="../assets/img/shop/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product_info">
                            <h1 class="product_name"><?php echo htmlspecialchars($product['name']); ?></h1>
                            <p class="product_price">₹<?php echo number_format(htmlspecialchars($product['price']), 2); ?></p>
                            <div class="cart_button">
                                <form method="post">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Review Section -->
                    <div class="review_section">
                        <h3>Reviews</h3>
                        <?php if ($result_reviews && $result_reviews->num_rows > 0) { ?>
                            <?php while ($review = $result_reviews->fetch_assoc()) { ?>
                                <div class="review_item">
                                    <div class="reviewer_name"><?php echo htmlspecialchars($review['reviewer_name']); ?></div>
                                    <div class="review_date"><?php echo date('F j, Y', strtotime($review['review_date'])); ?></div>
                                    <div class="review_text"><?php echo htmlspecialchars($review['review_text']); ?></div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p>No reviews yet.</p>
                        <?php } ?>

                        <!-- Add Review Form -->
                        <div class="add_review_form">
                            <h4>Add a Review</h4>
                            <form method="post" action="add_review2.php">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                <div class="form-group">
                                    <label for="reviewer_name">Your Name:</label>
                                    <input type="text" id="reviewer_name" name="reviewer_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="review_text">Your Review:</label>
                                    <textarea id="review_text" name="review_text" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Section -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <h3>Other Products</h3>
                        <?php while ($sidebar_product = $result_sidebar->fetch_assoc()) { ?>
                            <div class="product_item">
                                <a href="shop_detail.php?id=<?php echo htmlspecialchars($sidebar_product['id']); ?>">
                                    <img src="../assets/img/shop/<?php echo htmlspecialchars($sidebar_product['image']); ?>" alt="<?php echo htmlspecialchars($sidebar_product['name']); ?>">
                                    <div class="product_info">
                                        <h4><?php echo htmlspecialchars($sidebar_product['name']); ?></h4>
                                        <p class="product_price">₹<?php echo number_format(htmlspecialchars($sidebar_product['price']), 2); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- footer -->
    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>

    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
