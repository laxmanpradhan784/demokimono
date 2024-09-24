<?php
// Start the session
session_name('user_session');
session_start();

// Include the database connection file
require_once 'conn.php';

// Initialize feedback variables
$success_message = '';
$error_message = '';

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Validate and sanitize data
    if (empty($name) || empty($price)) {
        $error_message = 'Name and price are required.';
    } else {
        // Get the user ID from the session
        $user_id = $_SESSION['user_id'];

        try {
            $sql = "INSERT INTO price (name, description, price, phone) VALUES (:name, :description, :price, :phone)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':phone' => $phone
            ]);

            $success_message = 'Your price entry has been added successfully!';
        } catch (PDOException $e) {
            $error_message = 'Error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
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
    <title>Kimono</title>

    <!-- Styles Include -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/swiper.min.css"> <!-- Add Swiper CSS -->
    <style>
        .text-danger {
            font-size: 0.875em;
        }

        .mb-4 {
            margin-top: 100px;
        }

        #price-form {
            margin-bottom: 100px;
        }
    </style>
</head>

<body>
    <?php include 'pronavbar.php'; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Add Price</h1>

        <?php if ($success_message): ?>
            <div id="success-message" style="color: green; margin-top: 10px;">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div id="error-message" style="color: red; margin-top: 10px;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form id="price-form" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <select class="form-control" id="name" name="name" required>
                    <option value="">Select</option>
                    <option value="Individual">Individual</option>
                    <option value="Corporate">Corporate</option>
                    <option value="Wedding">Wedding</option>
                </select>
                <div id="name-error" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
                <div id="description-error" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <select class="form-control" id="price" name="price" required>
                    <option value="">Select</option>
                    <option value="$20/session">$20/session</option>
                    <option value="$35/session">$35/session</option>
                    <option value="$55/session">$55/session</option>
                </select>
                <div id="price-error" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="number" class="form-control" id="phone" name="phone">
                <div id="phone-error" class="text-danger"></div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>

    <!-- Footer PHP Include -->
    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>