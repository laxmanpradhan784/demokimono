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
        
			
			<!-- Details Content -->
			<section class="blog-details">
				<div class="container">
					<div class="row">
                            
                        <!-- Service Navigation List -->
                        <div class="col-lg-4 col-md-4 pe-md-5">
                            <div class="sidebar">
                                <div class="sidenav">
                                    <ul class="side_menu">
										<li class="menu-item active">
											<a href="service-details.php" class="d-flex align-items-center justify-content-between">
                                                <span>
                                                    Studio Photography
                                                </span>
                                                <i class="bi bi-chevron-right"></i>
											</a>
										</li>

										<li class="menu-item">
											<a href="service-details.php" class="d-flex align-items-center justify-content-between">
                                                <span>
                                                    Wedding Photography
                                                </span>
                                                <i class="bi bi-chevron-right"></i>
											</a>
										</li>
                                        
										<li class="menu-item">
											<a href="service-details.php" class="d-flex align-items-center justify-content-between">
                                                <span>
                                                    Newborn Photography
                                                </span>
                                                <i class="bi bi-chevron-right"></i>
											</a>
										</li>

										<li class="menu-item">
											<a href="service-details.php" class="d-flex align-items-center justify-content-between">
                                                <span>
                                                    Indoor Photography
                                                </span>
                                                <i class="bi bi-chevron-right"></i>
											</a>
										</li>

										<li class="menu-item">
											<a href="service-details.php" class="d-flex align-items-center justify-content-between">
                                                <span>
                                                    Outdoor Photography
                                                </span>
                                                <i class="bi bi-chevron-right"></i>
											</a>
										</li>
									</ul>
                                </div> 

                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8 mb-5 mb-md-0 ps-md-0">
                            <div class="blog-details-inner">
                                <div class="post-content">

                                    <!-- Post Image -->
                                    <figure class="block-gallery mb-4">
                                        <img src="../assets/img/services/details.jpg" alt="img">
                                    </figure>

                                    <div class="post-header">
                                        <h1 class="post-title">Studio Photography</h1>
                                    </div>
                                    <div class="fulltext">
                                        <p> The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies, our team members are some of the finest.</p>
                                        
                                        <!-- Start Section -->
                                        <h4 class="widget-title">Service Steps</h4>
                                        <p>The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. </p>

                                        <ul class="point-order">
                                            <li><i class="bi bi-check2-all"></i> The talent at Kimono runs wide and deep. Across many markets, geographies</li>
                                            <li><i class="bi bi-check2-all"></i> Our team members are some of the finest professionals in the industry</li>
                                            <li><i class="bi bi-check2-all"></i> Organized to deliver the most specialized service possible and enriched by the</li>
                                        </ul>

                                        <p>The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies, our team members are some of the finest.</p>
                                        <p>The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies, our team members are some of the finest.The talent at kimora runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies, our team members are some of the finest.</p>

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
