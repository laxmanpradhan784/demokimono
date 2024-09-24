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

<!-- Albums -->
<section class="wptb-album-one">
    <div class="wptb-project--inner">
        <div class="wptb-heading">
            <div class="wptb-item--inner text-center">
                <h6 class="wptb-item--subtitle"><span>01//</span> Photo Albums</h6>
                <h1 class="wptb-item--title">Collection of photos <span>All of Our</span> <br> Best Works</h1>
            </div>
        </div>

        <div class="swiper-container swiper-gallery-two has-radius">
            <div class="swiper-wrapper">
                <!-- Item -->
                <div class="swiper-slide">
                    <div class="grid-item">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="../assets/img/projects/gallery/1.jpg" alt="img">
                                <a class="wptb-item--link" href="project-details.php"><i class="bi bi-chevron-right"></i></a>
                            </div>

                            <div class="wptb-item--holder">
                                <div class="wptb-item--meta">
                                    <h4><a href="project-details.php">Bright Boho Sunshine</a></h4>
                                    <p>By Jonathon Willson</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="swiper-slide">
                    <div class="grid-item">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="../assets/img/projects/gallery/2.jpg" alt="img">
                                <a class="wptb-item--link" href="project-details.php"><i class="bi bi-chevron-right"></i></a>
                            </div>

                            <div class="wptb-item--holder">
                                <div class="wptb-item--meta">
                                    <h4><a href="project-details.php">California Fall Collection 2023</a></h4>
                                    <p>By Jonathon Willson</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="swiper-slide">
                    <div class="grid-item">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="../assets/img/projects/gallery/3.jpg" alt="img">
                                <a class="wptb-item--link" href="project-details.php"><i class="bi bi-chevron-right"></i></a>
                            </div>

                            <div class="wptb-item--holder">
                                <div class="wptb-item--meta">
                                    <h4><a href="project-details.php">Brown girl next door</a></h4>
                                    <p>By Jonathon Willson</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="swiper-slide">
                    <div class="grid-item">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="../assets/img/projects/gallery/4.jpg" alt="img">
                                <a class="wptb-item--link" href="project-details.php"><i class="bi bi-chevron-right"></i></a>
                            </div>

                            <div class="wptb-item--holder">
                                <div class="wptb-item--meta">
                                    <h4><a href="project-details.php">Fashion next stage</a></h4>
                                    <p>By Jonathon Willson</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="swiper-slide">
                    <div class="grid-item">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--image">
                                <img src="../assets/img/projects/gallery/5.jpg" alt="img">
                                <a class="wptb-item--link" href="project-details.php"><i class="bi bi-chevron-right"></i></a>
                            </div>

                            <div class="wptb-item--holder">
                                <div class="wptb-item--meta">
                                    <h4><a href="project-details.php">Jenifer in green</a></h4>
                                    <p>By Jonathon Willson</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper Navigation -->
            <div class="wptb-swiper-navigation style2">
                <div class="wptb-swiper-arrow swiper-button-prev"></div>
                <div class="wptb-swiper-arrow swiper-button-next"></div>
            </div>
        </div>

        <div class="shadow-heading">
            <h1 class="wptb-item--title ">Laxman</h1>
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
<script src="../assets/js/jquery-3.6.0.min.js"></script>

<!-- Framework -->
<script src="../assets/js/bootstrap.min.js"></script>

<!-- WOW Scroll Effect -->
<script src="../plugins/wow/wow.min.js"></script>

<!-- Swiper Slider -->
<script src="../plugins/swiper/swiper-bundle.min.js"></script>

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
