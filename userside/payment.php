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

// Retrieve the order_id from query parameter
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id <= 0) {
    echo "Invalid order ID.";
    exit;
}

// Prepare and execute the query to fetch order details
$query = "SELECT * FROM cart_order WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param('i', $order_id);
$execute_result = $stmt->execute();

if (!$execute_result) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

if (!$result) {
    die("Get result failed: " . $stmt->error);
}

$order = $result->fetch_assoc();

if (!$order) {
    echo "Order not found for ID: " . $order_id;
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kimono - Payment Page">
    <title>Kimono</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/main.css" rel="stylesheet">

    <style>
        .container h4 {
            margin-top: 100px;
        }
        .checkout-summary {
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: .25rem;
            margin-top: 100px;
            background-color: transparent;
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
        .payment-options img {
            width: 100px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <?php include 'anavbar.php'; ?>
    <?php include 'search.php'; ?>

    <main class="container my-5">
        <div class="text-center mb-4">
            <h4>Payment Information</h4>
        </div>
        <div class="checkout-summary">
            <h4 class="text-center mb-4">Order Summary</h4>
            <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>$<?php echo number_format($order['subtotal'], 2); ?></span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <span>$<?php echo number_format($order['shipping'], 2); ?></span>
                </li>
                <li class="d-flex justify-content-between font-weight-bold">
                    <span>Total</span>
                    <span>$<?php echo number_format($order['total'], 2); ?></span>
                </li>
            </ul>

            <h4 class="text-center mt-4">Select Payment Method</h4>
            <div class="payment-options text-center mt-3">
                <form action="thanks.php" method="POST">
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" name="payment_method" value="upi" class="btn btn-light border w-100 mb-2">
                                <img src="path/to/upi-logo.png" alt="UPI"> UPI
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="payment_method" value="google_pay" class="btn btn-light border w-100 mb-2">
                                <img src="path/to/google-pay-logo.png" alt="Google Pay"> Google Pay
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="payment_method" value="credit_debit" class="btn btn-light border w-100 mb-2">
                                <img src="path/to/credit-debit-card-logo.png" alt="Credit/Debit"> Credit/Debit Card
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
