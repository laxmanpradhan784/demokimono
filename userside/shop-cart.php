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

// Handle removal of items
if (isset($_GET['remove_id'])) {
    $remove_id = intval($_GET['remove_id']);
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    header("Location: shop-cart.php");
    exit;
}

// Handle cart update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            $_SESSION['cart'][$product_id] = intval($quantity);
        }
    }
    header("Location: shop-cart.php");
    exit;
}

// Fetch cart items
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$cart_product_ids = array_keys($cart_items);

// Fetch products from the database
if (!empty($cart_product_ids)) {
    $query = "SELECT * FROM product WHERE id IN (" . implode(',', $cart_product_ids) . ")";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }
} else {
    $result = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kimono</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            color: #ffffff;
            background-color: #343a40;
        }
        .shopping-cart {
            padding: 2rem 0;
            margin-top: 100px;
            margin-bottom: 380px;
        }
        .cart-table {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: rem;
            background-color: #495057;
        }
        .cart-table th, .cart-table td {
            vertical-align: middle;
            color: #ffffff;
        }
        .cart-table img {
            max-width: 100px;
            border-radius: 4px;
        }
        .cart-table thead {
            background-color: #212529;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            font-size: 1rem;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            color: #ffffff;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .product-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #ffffff;
        }
        .product-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #ffffff;
        }
        .input-group {
            max-width: 120px;
        }
        .input-group .form-control {
            text-align: center;
            background-color: #343a40;
            color: #ffffff;
            border: 1px solid #6c757d;
        }
        .input-group .btn {
            background-color: #495057;
            color: #ffffff;
            border: 1px solid #6c757d;
        }
        .input-group .btn:hover {
            background-color: #6c757d;
        }
        .cart-total {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
        }
        .checkout-actions {
            margin-top: 20px;
        }
        .update-button-container {
            margin-top: 1rem;
        }
    </style>
</head>
<body>

<?php include 'anavbar.php'; ?>
<?php include 'search.php'; ?>

<main>
    <section class="shopping-cart">
        <div class="container">
            <h2 class="mb-4 text-center border">Shopping Cart</h2>
            <div class="cart-items">
                <?php if (empty($cart_items)) { ?>
                    <p class="text-center">Your cart is empty.</p>
                <?php } else { ?>
                    <form id="cart-form" action="shop-cart.php" method="post">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="cart-body">
                                <?php
                                $total = 0;
                                while ($product = mysqli_fetch_assoc($result)) {
                                    $product_id = $product['id'];
                                    $quantity = $cart_items[$product_id];
                                    $price = $product['price'];
                                    $subtotal = $price * $quantity;
                                    $total += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <span class="product-name"><?php echo htmlspecialchars($product['name']); ?></span><br>
                                    </td>
                                    <td><img src="../assets/img/shop/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"></td>
                                    <td class="product-quantity">
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-light" data-action="minus" data-product-id="<?php echo $product_id; ?>">&#8722;</button>
                                            <input type="text" name="quantity[<?php echo $product_id; ?>]" id="quantity-<?php echo $product_id; ?>" value="<?php echo $quantity; ?>" class="form-control text-center">
                                            <button type="button" class="btn btn-outline-light" data-action="plus" data-product-id="<?php echo $product_id; ?>">&#43;</button>
                                        </div>
                                    </td>
                                    <td class="product-price" data-price="<?php echo number_format($price, 2, '.', ''); ?>">
                                        ₹<?php echo number_format($price, 2, '.', ''); ?>
                                    </td>
                                    <td>
                                        <a href="shop-cart.php?remove_id=<?php echo $product_id; ?>" class="btn btn-danger">Remove</a>
                                        <div class="update-button-container text-center">
                                                 <button type="submit" name="update_cart" class="btn btn-custom">Update Cart</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end cart-total">Total</td>
                                    <td class="cart-total" id="grand-total">
                                        ₹<?php echo number_format($total, 2); ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <div class="d-flex justify-content-center checkout-actions">
                            <a href="shop-checkout.php" class="btn btn-success">Proceed to Checkout</a>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<script>
    function updateTotal() {
        let grandTotal = 0;
        document.querySelectorAll('.product-quantity input').forEach(function(input) {
            let productId = input.id.replace('quantity-', '');
            let quantity = parseInt(input.value);
            let price = parseFloat(document.querySelector(`#total-${productId}`).dataset.price);
            let subtotal = price * quantity;
            grandTotal += subtotal;
        });
        document.getElementById('grand-total').textContent = '₹' + grandTotal.toFixed(2);
    }

    function changeQuantity(productId, delta) {
        let input = document.getElementById('quantity-' + productId);
        let currentQuantity = parseInt(input.value);
        
        if (!isNaN(currentQuantity) && currentQuantity + delta > 0) {
            let newQuantity = currentQuantity + delta;
            input.value = newQuantity;
            updateTotal();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('button[data-action="minus"]').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.getAttribute('data-product-id');
                changeQuantity(parseInt(productId), -1);
            });
        });
        
        document.querySelectorAll('button[data-action="plus"]').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.getAttribute('data-product-id');
                changeQuantity(parseInt(productId), 1);
            });
        });

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('change', function() {
                let productId = this.id.replace('quantity-', '');
                let newQuantity = parseInt(this.value);
                if (isNaN(newQuantity) || newQuantity <= 0) {
                    newQuantity = 1; // Default to 1 if invalid
                }
                this.value = newQuantity;
                updateTotal(); // Update grand total when quantity is changed
            });
        });

        // Initialize total on page load
        updateTotal();
    });
</script>
</body>
</html>
