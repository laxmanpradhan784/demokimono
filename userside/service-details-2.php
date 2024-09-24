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
                    <div class="blog-details-inner">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <h1 class="wptb-item--title mb-lg-0">Fashion Photography</h1>
                                    </div>

                                    <div class="col-lg-7">
                                        <p class="wptb-item--description">The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies, our team members are some of the finest.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <!-- Post Image -->
                                <figure class="block-gallery mb-4">
                                    <img src="../assets/img/services/details-2.jpg" alt="img">
                                </figure>
                            </div>
                            
                            <div class="col-lg-4 col-md-4">
                                <!-- Post Image -->
                                <figure class="block-gallery mb-4">
                                    <img src="../assets/img/services/details-3.jpg" alt="img">
                                </figure>
                            </div>
                        </div>

                        <div class="row mr-top-90">
                            <div class="col-lg-8 col-md-8 pd-right-70">
                                <div class="post-content">
                                    <div class="fulltext">
                                        <!-- Start Section -->
                                        <h4 class="widget-title mt-0">Service Steps</h4>
                                        <p>The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. </p>

                                        <ul class="point-order">
                                            <li><i class="bi bi-check2-all"></i> The talent at Kimono runs wide and deep. Across many markets, geographies</li>
                                            <li><i class="bi bi-check2-all"></i> Our team members are some of the finest professionals in the industry</li>
                                            <li><i class="bi bi-check2-all"></i> Organized to deliver the most specialized service possible and enriched by the</li>
                                        </ul>

                                        <p>The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies, our team members are some of the finest.</p>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 mt-5 mt-md-0">
                                <div class="wptb-counter1 mr-bottom-70 style1 wow skewIn">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder d-flex align-items-center">
                                            <div class="wptb-item--value flex-shrink-0"><span class="odometer" data-count="350"></span><span class="suffix">+</span></div>
                                            <div class="wptb-item--text">Photography Session</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wptb-counter1 mr-bottom-70 style1 wow skewIn">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder d-flex align-items-center">
                                            <div class="wptb-item--value"><span class="odometer" data-count="100"></span><span class="suffix">%</span></div>
                                            <div class="wptb-item--text">Customer Satisfaction</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wptb-counter1 style1 wow skewIn">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder d-flex align-items-center">
                                            <div class="wptb-item--value flex-shrink-0"><span class="odometer" data-count="50"></span><span class="suffix">+</span></div>
                                            <div class="wptb-item--text">Experienced Photographers</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</section>
			<!-- End Details Content -->

            <!-- BG Video -->
            <div class="wptb-video-player1 wow zoomIn mr-bottom-70 bg-image" style="background-image: url('../assets/img/background/bg-14.jpg');">
                <div class="wptb-item--inner">
                    <div class="wptb-item--holder">
                        <div class="wptb-item--video-button">
                            <a class="btn" data-fancybox href="https://www.youtube.com/watch?v=SF4aHwxHtZ0">
                                <span class="text-second"> <i class="bi bi-play-fill"></i> </span>
                                <span class="line-video-animation line-video-1"></span> 
                                <span class="line-video-animation line-video-2"></span> 
                                <span class="line-video-animation line-video-3"></span>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="wptb-item-layer wptb-item-layer-one">
                    <img src="../assets/img/more/light-3.png" alt="img">
                </div>
            </div>

            <!-- Why Choose -->
            <section class="bg-dark-200 pb-5">
                <div class="container">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner">
                            <h6 class="wptb-item--subtitle"><span>02 //</span> Our Features</h6>
                            <h1 class="wptb-item--title mb-0">Why choose Us</h1>
                        </div>
                    </div>

                    <ol class="wptb-features">
                        <li class="wptb-item active highlight">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--features-holder">
                                    <div class="wptb-item--title">
                                        <a href="#">20+ Years Experience</a>
                                    </div>
                                </div>
                                <div class="wptb-item--image">
                                    <img src="../assets/img/more/11.jpg" alt="img">

                                    <div class="wptb-item--features-bottom">
                                        <div class="wptb-item--content flex-shrink-0">
                                            <div class="logo">
                                                <a href="index.php" class="light_logo"><img src="../assets/img/logo.svg" alt="logo"></a>
                                                <a href="index.php" class="dark_logo"><img src="../assets/img/logo-dark.svg" alt="logo"></a>
                                            </div>
                                            <div class="wptb-item--description">
                                                Kimono have 20+ years of experence of photography & videography, which makes us the pioneers in this profession. We are having so muh fun doing this.
                                            </div>
                                            <div class="wptb-item--button">
                                                <a href="project-details.php" class="btn">Read More <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="wptb-counter--box">
                                            <div class="wptb-counter2">
                                                <div class="wptb-item--inner">
                                                    <div class="wptb-item--holder">
                                                        <div class="wptb-item--value"><span class="odometer" data-count="50"></span><span class="suffix">+</span></div>
                                                        <div class="wptb-item--text">Photographers</div>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="wptb-counter2">
                                                <div class="wptb-item--inner">
                                                    <div class="wptb-item--holder">
                                                        <div class="wptb-item--value"><span class="odometer" data-count="300"></span><span class="suffix"></span></div>
                                                        <div class="wptb-item--text">Events Covered</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="wptb-item">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--features-holder">
                                    <div class="wptb-item--title">
                                        <a href="#">Creative Shoot Ideas</a>
                                    </div>
                                </div>
                                <div class="wptb-item--image">
                                    <img src="../assets/img/more/9.jpg" alt="img">

                                    <div class="wptb-item--features-bottom">
                                        <div class="wptb-item--content flex-shrink-0">
                                            <div class="logo">
                                                <a href="index.php" class="light_logo"><img src="../assets/img/logo.svg" alt="logo"></a>
                                                <a href="index.php" class="dark_logo"><img src="../assets/img/logo-dark.svg" alt="logo"></a>
                                            </div>
                                            <div class="wptb-item--description">
                                                Kimono have 20+ years of experence of photography & videography, which makes us the pioneers in this profession. We are having so muh fun doing this.
                                            </div>
                                            <div class="wptb-item--button">
                                                <a href="project-details.php" class="btn">Read More <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="wptb-counter--box">
                                            <div class="wptb-counter2">
                                                <div class="wptb-item--inner">
                                                    <div class="wptb-item--holder">
                                                        <div class="wptb-item--value"><span class="odometer" data-count="30"></span><span class="suffix">+</span></div>
                                                        <div class="wptb-item--text">Wedding Photos</div>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="wptb-counter2">
                                                <div class="wptb-item--inner">
                                                    <div class="wptb-item--holder">
                                                        <div class="wptb-item--value"><span class="odometer" data-count="100"></span><span class="suffix">+</span></div>
                                                        <div class="wptb-item--text">Fashion photos</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="wptb-item">
    <div class="wptb-item--inner">
        <div class="wptb-item--features-holder">
            <div class="wptb-item--title">
                <a href="#">Globally Awarded</a>
            </div>
        </div>
        <div class="wptb-item--image">
            <img src="../assets/img/more/10.jpg" alt="img">

            <div class="wptb-item--features-bottom">
                <div class="wptb-item--content flex-shrink-0">
                    <div class="logo">
                        <a href="index.php" class="light_logo"><img src="../assets/img/logo.svg" alt="logo"></a>
                        <a href="index.php" class="dark_logo"><img src="../assets/img/logo-dark.svg" alt="logo"></a>
                    </div>
                    <div class="wptb-item--description">
                        Kimono have 20+ years of experience in photography & videography, which makes us the pioneers in this profession. We are having so much fun doing this.
                    </div>
                    <div class="wptb-item--button">
                        <a href="project-details.php" class="btn">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="wptb-counter--box">
                    <div class="wptb-counter2">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--holder">
                                <div class="wptb-item--value"><span class="odometer" data-count="20"></span><span class="suffix">+</span></div>
                                <div class="wptb-item--text">Global Awards</div>
                            </div>
                        </div>
                    </div>

                    <div class="wptb-counter2">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--holder">
                                <div class="wptb-item--value"><span class="odometer" data-count="10"></span><span class="suffix"></span></div>
                                <div class="wptb-item--text">Local Awards</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>

<li class="wptb-item">
    <div class="wptb-item--inner">
        <div class="wptb-item--features-holder">
            <div class="wptb-item--title">
                <a href="#">Best Quality Photos</a>
            </div>
        </div>
        <div class="wptb-item--image">
            <img src="../assets/img/more/8.jpg" alt="img">

            <div class="wptb-item--features-bottom">
                <div class="wptb-item--content flex-shrink-0">
                    <div class="logo">
                        <a href="index.php" class="light_logo"><img src="../assets/img/logo.svg" alt="logo"></a>
                        <a href="index.php" class="dark_logo"><img src="../assets/img/logo-dark.svg" alt="logo"></a>
                    </div>
                    <div class="wptb-item--description">
                        Kimono have 20+ years of experience in photography & videography, which makes us the pioneers in this profession. We are having so much fun doing this.
                    </div>
                    <div class="wptb-item--button">
                        <a href="project-details.php" class="btn">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="wptb-counter--box">
                    <div class="wptb-counter2">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--holder">
                                <div class="wptb-item--value"><span class="odometer" data-count="100"></span><span class="suffix">%</span></div>
                                <div class="wptb-item--text">HD Photos</div>
                            </div>
                        </div>
                    </div>

                    <div class="wptb-counter2">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--holder">
                                <div class="wptb-item--value"><span class="odometer" data-count="100%"></span><span class="suffix">%</span></div>
                                <div class="wptb-item--text">Clients Satisfaction</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>
</ol>
</div>
</section>

<!-- Testimonial -->
<section class="wptb-testimonial-one bg-image" style="background-image: url('../assets/img/background/bg-15.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="swiper-container swiper-testimonial">    
                    <!-- swiper slides -->
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="wptb-testimonial1">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder">
                                        <div class="d-flex align-items-center justify-content-between mr-bottom-25">
                                            <div class="wptb-item--meta-rating">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            
                                            <div class="wptb-item--icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="57" height="45" viewBox="0 0 57 45" fill="none">
                                                    <path d="M51.5137 38.5537C56.8209 32.7938 56.2866 25.3969 56.2697 25.3125V2.8125C56.2697 2.06658 55.9734 1.35121 55.4459 0.823763C54.9185 0.296317 54.2031 0 53.4572 0H36.5822C33.48 0 30.9572 2.52281 30.9572 5.625V25.3125C30.9572 26.0584 31.2535 26.7738 31.781 27.3012C32.3084 27.8287 33.0238 28.125 33.7697 28.125H42.4266C42.3671 29.5155 41.9517 30.8674 41.22 32.0513C39.7913 34.3041 37.0997 35.8425 33.2156 36.6188L30.9572 37.0688V45H33.7697C41.5969 45 47.5678 42.8316 51.5137 38.5537ZM20.5566 38.5537C25.8666 32.7938 25.3294 25.3969 25.3125 25.3125V2.8125C25.3125 2.06658 25.0162 1.35121 24.4887 0.823763C23.9613 0.296317 23.2459 0 22.5 0H5.625C2.52281 0 0 2.52281 0 5.625V25.3125C0 26.0584 0.296316 26.7738 0.823762 27.3012C1.35121 27.8287 2.06658 28.125 2.8125 28.125H11.4694C11.41 29.5155 10.9945 30.8674 10.2628 32.0513C8.83406 34.3041 6.1425 35.8425 2.25844 36.6188L0 37.0688V45H2.8125C10.6397 45 16.6106 42.8316 20.5566 38.5537Z" fill="#D70006"/>
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="wptb-item--description"> “I had an amazing photography session with the team at Kimono Photography Agency, highly recommended. They have an amazing atmosphere in their studio. I’d love to visit again”</p>
                                        <div class="wptb-item--meta">
                                            <div class="wptb-item--image">
                                                <img src="../assets/img/testimonial/1.jpg" alt="img">
                                            </div>
                                            <div class="wptb-item--info">
                                                <div class="wptb-item--name">Jane Doe</div>
                                                <div class="wptb-item--position">Client</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- Add more swiper slides as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

           
            

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
 
         <!-- Projects -->
         <script src="../plugins/isotope/isotope.pkgd.min.js"></script>
         <script src="../plugins/isotope/imagesloaded.pkgd.min.js"></script>
         
         <script src="../plugins/isotope/tilt.jquery.js"></script>
         <script src="../plugins/isotope/isotope-init.js"></script>
 
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