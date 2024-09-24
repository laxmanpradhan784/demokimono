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

// Calculate subtotal and total
$subtotal = 0;
while ($product = mysqli_fetch_assoc($result)) {
    $product_id = $product['id'];
    $quantity = $cart_items[$product_id];
    $price = $product['price'];
    $subtotal += $price * $quantity;
}
$total = $subtotal + 7; // Example fixed shipping fee
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kimono - Checkout Page">
    <title>Kimono - Checkout</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/main.css" rel="stylesheet">

    <style>
        .checkout-summary {
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: .25rem;
            background-color: transparent;
            margin-top: 144px;
            text-transform: capitalize;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: .25rem;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-group {
            position: relative;
            margin-bottom: 1rem;
        }
        .form-group .error-message {
            color: red;
            font-size: 0.875rem;
            position: absolute;
            bottom: -1.5rem;
            left: 0;
        }
        .form-group input.invalid {
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <?php include 'anavbar.php'; ?>
    <?php include 'search.php'; ?>

    <main class="container my-5">
        <div class="row">
            <!-- Billing Address Form -->
            <div class="col-lg-5">
                <h4 class="mb-4 mt-5">Billing Address</h4>
                <form id="checkout-form" action="process_checkout.php" method="POST">
                    <div class="form-group">
                        <label for="fname">Full Name *</label>
                        <input type="text" class="form-control" id="fname" name="fname">
                        <div class="error-message" id="fname-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                        <div class="error-message" id="phone-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="address">Street Address *</label>
                        <input type="text" class="form-control" id="address" name="address">
                        <div class="error-message" id="address-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="pincode">Pin Code *</label>
                        <input type="text" class="form-control" id="pincode" name="pincode">
                        <div class="error-message" id="pincode-error"></div>
                    </div>
                    <button type="submit" class="btn btn-custom mt-4">Place Order Now</button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-7">
                <div class="checkout-summary">
                    <h4 class="mb-4">Your Order Summary</h4>
                    <ul class="list-unstyled">
                        <?php
                        // Reset pointer to fetch cart items again
                        mysqli_data_seek($result, 0);
                        while ($product = mysqli_fetch_assoc($result)) {
                            $product_id = $product['id'];
                            $quantity = $cart_items[$product_id];
                            $price = $product['price'];
                            $item_total = $price * $quantity;
                        ?>
                            <li class="d-flex justify-content-between mb-2">
                                <span><?php echo htmlspecialchars($product['name']); ?> (<?php echo $quantity; ?>)</span>
                                <span>₹<?php echo number_format($item_total, 2); ?></span>
                            </li>
                        <?php } ?>
                        <li class="d-flex justify-content-between font-weight-bold mb-2">
                            <span>Subtotal</span>
                            <span>₹<?php echo number_format($subtotal, 2); ?></span>
                        </li>
                        <li class="d-flex justify-content-between font-weight-bold mb-2">
                            <span>Shipping</span>
                            <span>₹7.00</span> <!-- Example fixed shipping fee -->
                        </li>
                        <li class="d-flex justify-content-between font-weight-bold">
                            <span>Total</span>
                            <span>₹<?php echo number_format($total, 2); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- To Top Button -->
    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>

    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="../assets/js/theme.js"></script>

    <!-- JavaScript Validation -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("checkout-form");

            form.addEventListener("submit", function(event) {
                const fname = document.getElementById("fname");
                const phone = document.getElementById("phone");
                const address = document.getElementById("address");
                const pincode = document.getElementById("pincode");

                let isValid = true;

                // Clear previous error messages and styles
                document.querySelectorAll('.error-message').forEach(el => el.textContent = "");
                document.querySelectorAll('.form-group input').forEach(el => el.classList.remove('invalid'));

                // Validate Full Name
                if (!/^[a-zA-Z\s]+$/.test(fname.value.trim())) {
                    document.getElementById("fname-error").textContent = "Full Name must only contain letters and spaces.";
                    fname.classList.add('invalid');
                    isValid = false;
                }

                // Validate Phone Number
                if (!/^\d{10}$/.test(phone.value.trim())) {
                    document.getElementById("phone-error").textContent = "Phone Number must be exactly 10 digits.";
                    phone.classList.add('invalid');
                    isValid = false;
                }

                // Validate Address
                if (!/^[\w\s,]+$/.test(address.value.trim())) {
                    document.getElementById("address-error").textContent = "Street Address is invalid.";
                    address.classList.add('invalid');
                    isValid = false;
                }

                // Validate Pin Code
                if (!/^\d{6}$/.test(pincode.value.trim())) {
                    document.getElementById("pincode-error").textContent = "Pin Code must be exactly 6 digits.";
                    pincode.classList.add('invalid');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });
        });
    </script>
</html>
</body>