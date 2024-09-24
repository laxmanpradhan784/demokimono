<?php

// Initialize cart count
$cart_count = 0;

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch cart count
    if (isset($_SESSION['cart'])) {
        $cart_count = array_sum($_SESSION['cart']);
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
</head>

<body class="theme-style--gradient">

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <img src="../assets/img/preloader-logo.svg" alt="img">
                <img src="../assets/img/preloader-wheel.svg" alt="img" class="wheel">
            </div>
        </div>
    </div>

    <!--  a pointer round cercle start -->
    <!-- <div class="pointer bnz-pointer" id="bnz-pointer"></div> -->

    <!-- Main Header -->
    <header class="header">
        <div class="header-inner">
            <div class="container-fluid pe-0">
                <div class="d-flex align-items-center justify-content-between">
                    <!-- Left Part -->
                    <div class="header_left_part d-flex align-items-center">
                        <div class="logo">
                            <a href="index.php" class="light_logo"><img src="../assets/img/logo.svg" alt="logo"></a>
                            <a href="index.php" class="dark_logo"><img src="../assets/img/logo-dark.svg" alt="logo"></a>
                        </div>
                    </div>

                    <!-- Center Part -->
                    <div class="header_center_part d-none d-xl-block">
                        <div class="mainnav">
                            <ul class="main-menu">
                                <li class="menu-item"><a href="project-modern-col-3.php">Gallery</a></li>
                                <li class="menu-item"><a href="pricetable.php">Price</a></li>
                                <li class="menu-item"><a href="packages.php">Packages</a></li>
                                <li class="menu-item"><a href="product_page.php">Shop</a></li>
                                <li class="menu-item"><a href="shop-cart.php">Cart (<?php echo htmlspecialchars($cart_count); ?>)</a></li>
                                <li class="menu-item"><a href="user_orders.php">Orders</a></li>
                                <li class="menu-item"><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Notification Icon (Newly Added) -->
                    <div class="header_notifications wptb-element">
                        <a href="notifications.php" class="notification_icon">
                            <i class="bi bi-bell"></i>
                            <!-- If you want to add a count badge -->
                            <span class="notification_count"></span>
                        </a>
                    </div>

                    <!-- Search Icon Removed -->
                    <!-- Removed this block <div class="header_search wptb-element"> -->

                </div>
            </div>
        </div>
    </header>

    <!-- Scroll to Top -->
    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>

    <!-- Core JS -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Additional Plugins -->
    <script src="../plugins/wow/wow.min.js"></script>
    <script src="../plugins/swiper/swiper-bundle.min.js"></script>
    <script src="../plugins/swiper/swiper-gl.min.js"></script>
    <script src="../plugins/odometer/appear.js"></script>
    <script src="../plugins/odometer/odometer.js"></script>
    <script src="../plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="../plugins/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="../plugins/isotope/tilt.jquery.js"></script>
    <script src="../plugins/isotope/isotope-init.js"></script>
    <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="../plugins/flatpickr/flatpickr.min.js"></script>
    <script src="../plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="../plugins/cursor-effect/cursor-effect.js"></script>
    <script src="../assets/js/theme.js"></script>

</body>

</html>