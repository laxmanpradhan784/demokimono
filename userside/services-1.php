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
        

            <!-- Our Services -->
            <section>
                <div class="container">
                    <div class="wptb-service--inner">
                        <div class="row">
                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3 active highlight">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-1.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-1-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">01</p>
                                            <h4 class="wptb-item--title mb-0">Wedding Photography</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-2.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-2-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">02</p>
                                            <h4 class="wptb-item--title mb-0">Drone Cinematography</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-3.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-3-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">03</p>
                                            <h4 class="wptb-item--title mb-0">Wedding Cinematography</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-4.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-4-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">04</p>
                                            <h4 class="wptb-item--title mb-0">Personal Portfolio Shoot</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-5.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-5-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">05</p>
                                            <h4 class="wptb-item--title mb-0">Wildlife Photography</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-6.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-6-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">06</p>
                                            <h4 class="wptb-item--title mb-0">Studio Photography</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-7.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-7-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">07</p>
                                            <h4 class="wptb-item--title mb-0">Photography Archive</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Iconbox -->
                            <div class="col-lg-3 col-md-6 col-sm-6 ps-0 wow fadeInLeft">
                                <div class="wptb-icon-box5 mb-3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            <img src="../assets/img/services/icon-8.svg" alt="img" class="default-icon">
                                            <img src="../assets/img/services/icon-8-3.svg" alt="img" class="hover-icon">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <p class="wptb-item--description">08</p>
                                            <h4 class="wptb-item--title mb-0">Photography Training</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wptb-pagination-wrap text-center">
                        <ul class="pagination">
                            <li><a class="disabled page-number previous" href="#"><i class="bi bi-chevron-left"></i></a></li>
                            <li><span class="page-number current">1</span></li>
                            <li><a class="page-number" href="#">2</a></li>
                            <li><a class="page-number" href="#">3</a></li>
                            <li>.....</li>
                            <li><a class="page-number" href="#">9</a></li>
                            <li><a class="page-number next" href="#"><i class="bi bi-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </section>

        </main>

<!-- footer -->
<?php

include 'footer.php';

?>
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