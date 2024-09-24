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
        <!-- Page Header -->
        <div class="wptb-page-heading">
            <div class="wptb-item--inner" style="background-image: url('../assets/img/background/page-header-bg-8.jpg');">
                <div class="wptb-item-layer wptb-item-layer-one">
                    <img src="../assets/img/more/circle.png" alt="img">
                </div>
                <h2 class="wptb-item--title ">Our Projects</h2>
            </div>
        </div>

        <!-- Our Services -->
        <section>
            <div class="container">
                <div class="wptb-project--inner">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner text-center">
                            <h6 class="wptb-item--subtitle"><span>01//</span> Our Portfolio</h6>
                            <h1 class="wptb-item--title"> Kimono captures <span>All of Your</span> <br>
                                beautiful memories</h1>
                        </div>
                    </div>

                    <div class="has-radius effect-tilt">
                        <div class="grid gutter-30 clearfix"> 
                            <div class="grid-sizer"></div>                          
                            <div class="grid-item width-50">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-video-1"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">Bright Boho Sunshine</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="grid-item width-50"> 
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-2"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">California Fall Collection 2023</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="grid-item width-100"> 
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-3"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">Brown girl next door</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="grid-item width-50"> 
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-4"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">Fashion next stage</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="grid-item width-50"> 
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-video-2"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">Jenifer in green</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="grid-item width-100"> 
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-6"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">Sunflower Boho girl</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="grid-item width-50"> 
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-7"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">Iceland girl</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                                       
                            <div class="grid-item width-50"> 
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image project-distortion project-distortion-8"></div>

                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a href="project-details.php">Summer sadness</a></h4>
                                            <p>By Jonathon Willson</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wptb-pagination-wrap text-center">
                    <ul class="pagination justify-content-center">
                        <li><a class="disabled page-number previous" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        <li><span class="page-number current">01</span></li>
                        <li><a class="page-number" href="#">02</a></li>
                        <li><a class="page-number" href="#">03</a></li>
                        <li>.....</li>
                        <li><a class="page-number" href="#">09</a></li>
                        <li><a class="page-number next" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>

    </main>

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
    <script src="../plugins/swiper/swiper-gl.min.js"></script>

    <!-- Odometer Counter -->
    <script src="../plugins/odometer/appear.js"></script>
    <script src="../plugins/odometer/odometer.js"></script>

    <!-- Projects -->
    <script src="../plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="../plugins/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="../plugins/isotope/tilt.jquery.js"></script>
    <script src="../plugins/isotope/isotope-init.js"></script>

    <!-- Fancybox -->
    <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>

    <!-- Flatpickr -->
    <script src="../plugins
