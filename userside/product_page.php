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
    header("Location: product_page.php");
    exit;
}

// Fetch active products from the database
$sql = "SELECT id, name, price, image FROM product WHERE status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Error handling
if (!$result) {
    die("Database query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kimono - Photography Agency">
    <meta name="author" content="">

    <!-- Favicon and touch Icons -->
    <link href="../assets/img/favicon.png" rel="shortcut icon" type="image/png">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="../assets/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="../assets/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Page Title -->
    <title>Kimono - Photography Agency</title>    
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        .product_item {
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: .5rem;
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 100%;
            margin-bottom: 1.5rem;
        }

        .product_thumb {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product_thumb img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product_item:hover .product_thumb img {
            transform: scale(1.1);
        }

        .product_item_inner {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product_item_name {
            font-size: 1.25rem;
            line-height: 1.2;
            margin-bottom: .5rem;
        }

        .product_item_price {
            font-size: 1.5rem;
            color: #28a745; /* Bootstrap's success green color */
            margin-bottom: 1rem;
        }

        .cart_button {
            text-align: center;
        }

        .cart_button button {
            font-size: 1rem;
            padding: .5rem 1.5rem;
            border-radius: .3rem;
        }
    </style>
</head>
<body>

<?php include 'pronavbar.php'; ?>
<?php include 'search.php'; ?>

<section>
    <div class="container">
        <div class="tab-content">
            <div class="tab-pane fade active show" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                <div class="row">
                    <?php while ($product = $result->fetch_assoc()) {
                        $imagePath = '../assets/img/shop/' . htmlspecialchars($product['image']);
                        if (!file_exists($imagePath)) {
                            $imagePath = '../assets/img/shop/default.jpg'; // Fallback image if product image not found
                        }
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="product_item">
                            <a href="shop_detail.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="product_thumb">
                                <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </a>
                            <div class="product_item_inner">
                                <div class="label_text">
                                    <h2 class="product_item_name d-flex align-items-center justify-content-between">
                                        <a href="shop_detail.php?id=<?php echo htmlspecialchars($product['id']); ?>"><?php echo htmlspecialchars($product['name']); ?></a>
                                        <span class="product_item_price">₹<?php echo number_format(htmlspecialchars($product['price']), 2); ?></span>
                                    </h2>
                                </div>
                                <div class="cart_button">
                                    <form method="post">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'footer.php'; ?>
<!-- Footer -->
<div class="totop">
    <a href="#"><i class="bi bi-chevron-up"></i></a>
</div>

<!-- Core JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
