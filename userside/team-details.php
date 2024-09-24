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
        <title>Kimono - Photography Agency</title>    
        
        <!-- Styles Include -->
        <link rel="stylesheet" href="../assets/css/main.css">
        
    </head>


    <body>

    <?php include 'navbar.php'; ?>
    <?php include 'search.php'; ?>
        
        <!-- Main Wrapper-->
        <main>
           

            <!-- Details Content -->
			<section class="blog-details">
				<div class="container">
					<div class="row mr-bottom-100">
                        <div class="col-lg-6 col-md-6 pe-md-5">
                            <div class="sidebar">
                                <div class="wptb-team-grid3">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <img src="../assets/img/team/10.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 mt-5 mt-md-0">
                            <div class="blog-details-inner">
                                <div class="post-content">
                                    <div class="fulltext">
                                        <div class="wptb-team-grid3 mb-5">
                                            <div class="wptb-item--inner">
                                                <div class="wptb-item--holder">
                                                    <div class="wptb-item--meta">
                                                        <h5 class="wptb-item--title">Ellie Duncan</h5>
                                                        <h6 class="wptb-item--position">Photographer</h6>
                                                        <p class="wptb-item--description">Ellie Duncan is a stunning Photographer. Come meet him today! we understand that your thinking will change. Join today on a no lock-in contract membership.</p>
                                                    </div>
            
                                                    <div class="wptb-item--social">
                                                        <a href="#"><i class="bi bi-facebook"></i></a>
                                                        <a href="#"><i class="bi bi-twitter"></i></a>
                                                        <a href="#"><i class="bi bi-instagram"></i></a>
                                                        <a href="#"><i class="bi bi-linkedin"></i></a>
                                                        <a href="#"><i class="bi bi-pinterest"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="widget-title mt-5">Educational Qualification</h4>
                                        <ul class="point-order p-0 mb-3">
                                            <li><i class="bi bi-check2-all"></i> Graduation In From <span>YALE University</span></li>
                                            <li><i class="bi bi-check2-all"></i> Post Graduation from <span>YALE University</span></li>
                                            <li><i class="bi bi-check2-all"></i> Diploma In photography From <span>JNU</span></li>
                                        </ul>

                                        <h4 class="widget-title">Awards</h4>
                                        <ul class="point-order p-0">
                                            <li><i class="bi bi-check2-all"></i> Best Photographer Award 2022</li>
                                            <li><i class="bi bi-check2-all"></i> Best Photographer Award 2021</li>
                                            <li><i class="bi bi-check2-all"></i> Best Photographer Award 2020</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Latest Projects -->
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 mb-4 mb-lg-0">
                            <h4 class="widget-title">Latest Projects</h4>
                            <p>At vero eos et accusamus et iusto odio digni is simos ducimus qui blanditiis praesentium 
                                volu ptatum dele niti atque corryi upti quos. dolores et quas molestias. At vero eos et 
                                accusamus et iusto.</p>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                            <div class="wptb-image-single wow fadeInUp">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="project-details.php"></a><img src="../assets/img/projects/1/11.jpg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                            <div class="wptb-image-single wow fadeInUp">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="project-details.php"></a><img src="../assets/img/projects/1/12.jpg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                            <div class="wptb-image-single wow fadeInUp">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="project-details.php"></a><img src="../assets/img/projects/1/13.jpg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">                            
                            <div class="wptb-image-single wow fadeInUp">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="project-details.php"></a><img src="../assets/img/projects/1/14.jpg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">                            
                            <div class="wptb-image-single wow fadeInUp">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="project-details.php"></a><img src="../assets/img/projects/1/15.jpg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</section>
			<!-- End Details Content -->
            

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