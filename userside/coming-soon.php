<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, redirect to home page or another page
    header("Location: login.php"); // Replace with your preferred redirect page
    exit();
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

    <body>
       
    <?php include 'navbar.php'; ?>
    <?php include 'search.php'; ?>
        
        <!-- Main Wrapper-->
        <main class="wrapper">

            <!-- Coming Soon -->
            <section class="wptb-credential">
                <div class="wptb-credential--inner bg-image" style="background-image: url('../assets/img/background/bg-11.jpg');">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-heading">
                                        <div class="wptb-item--inner text-center">
                                            <h1 class="wptb-item--title"> Coming Soon!</h1>
                                        </div>
                                    </div>
            
                                    <div id="countdown" class="mr-bottom-50 wow fadeInUp">
                                        <ul>
                                            <li><span id="days"></span>days</li>
                                            <li><span id="hours"></span>Hours</li>
                                            <li><span id="minutes"></span>Minutes</li>
                                            <li><span id="seconds"></span>Seconds</li>
                                        </ul>
                                    </div>
            
                                    <div class="text-center mr-top-30">
                                        <a href="index.php" class="btn">
                                            <span class="btn-wrap">
                                                <span class="text-first text-uppercase">Homepage</span>
                                            </span>
                                        </a>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Footer -->
        <?php include 'footer.php'; ?>

        <div class="totop">
            <a href="#"><i class="bi bi-chevron-up"></i></a>
        </div>
        
        <!-- Core JS -->
        <script src="../assets/js/jquery-3.6.0.min.js"></script>

        <!-- Framework -->
        <script src="../assets/js/bootstrap.min.js"></script>
        
        <!-- WOW Scroll Effect -->
        <script src="../plugins/wow/wow.min.js"></script>

        <!-- Swiper Slider -->
        <script src="../plugins/swiper/swiper-bundle.min.js"></script>
        <script src="../plugins/swiper/swiper-gl.min.js"></script>

        <!-- Odometer Counter -->
        <script src="../plugins/odometer/appear.js"></script>
        <script src="../plugins/odometer/odometer.js"></script>

        <!-- Fancybox -->
        <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>

        <!-- Flatpickr -->
        <script src="../plugins/flatpickr/flatpickr.min.js"></script>

        <!-- Nice Select -->
        <script src="../plugins/nice-select/jquery.nice-select.min.js"></script>

        <!-- Cursor Effect -->
        <script src="../plugins/cursor-effect/cursor-effect.js"></script>

        <!-- Theme Custom JS -->
        <script src="../assets/js/theme.js"></script>
    </body>
</html>
