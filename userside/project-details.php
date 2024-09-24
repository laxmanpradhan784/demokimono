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
                        <div class="post-content">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 pe-md-5">
                                    <!-- Post Image -->
                                    <div class="swiper-container swiper-gallery mb-4">    
                                        <!-- swiper slides -->
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <figure class="block-gallery">
                                                    <img src="../assets/img/projects/gallery/3.jpg" alt="img">
                                                </figure>
                                            </div>
                
                                            <div class="swiper-slide">
                                                <figure class="block-gallery">
                                                    <img src="../assets/img/projects/gallery/4.jpg" alt="img">
                                                </figure>
                                            </div>
                
                                            <div class="swiper-slide">
                                                <figure class="block-gallery">
                                                    <img src="../assets/img/projects/gallery/5.jpg" alt="img">
                                                </figure>
                                            </div>
                                        </div>
                
                                        <!-- Swiper Navigation -->
                                        <div class="wptb-swiper-navigation style2">                      
                                            <div class="wptb-swiper-arrow swiper-button-prev"></div>
                                            <div class="wptb-swiper-arrow swiper-button-next"></div>
                                        </div>
                                    </div>

                                    <div class="post-header">
                                        <h1 class="post-title">Elisa & Family Photography</h1>
                                    </div>
                                    <div class="fulltext">
                                        <p> Kimono Photography is a full-service photography compa providing wedding, newborn, fashion & portfolio
                                            photograpy. Our portfolio of completed work include highly acclaimed and award-winning projects for clients
                                            around the country & globally also.</p>
                                        
                                        <!-- Start Section -->
                                        <h4 class="widget-title">Project Concept</h4>
                                        <p>Kimono Photography is a full-service photography company providing wedding, newborn, fashion & portfolio 
                                            grapy. Our portfolio of completed work includes highly acclaimed and award-winning projects </p>

                                        <ul class="point-order">
                                            <li><i class="bi bi-check2-all"></i> The talent at Kimono runs wide and deep. Across many markets, geographies</li>
                                            <li><i class="bi bi-check2-all"></i> Our team members are some of the finest professionals in the industry</li>
                                            <li><i class="bi bi-check2-all"></i> Organized to deliver the most specialized service possible and enriched by the</li>
                                        </ul>

                                        <p>The talent at kimono runs wide and deep. Across many markets, geographies & typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies, our team members are some of the finest.</p>
                                        
                                        <div class="row mt-5">
                                            <div class="col-md-6">
                                                <figure class="block-gallery mb-4">
                                                    <img src="../assets/img/projects/details/2.jpg" alt="img">
                                                </figure>
        
                                                <figure class="block-gallery mb-4">
                                                    <img src="../assets/img/projects/details/3.jpg" alt="img">
                                                </figure>
                                            </div>
                                            <div class="col-md-6">
                                                <figure class="block-gallery mb-4">
                                                    <img src="../assets/img/projects/details/4.jpg" alt="img">
                                                </figure>
        
                                                <figure class="block-gallery mb-4">
                                                    <img src="../assets/img/projects/details/5.jpg" alt="img">
                                                </figure>
                                            </div>
                                        </div>

                                        <p>Kimono Photography is a full-service photography compa providing wedding, newborn, fashion & portfolio
                                            photograpy. Our portfolio of completed work include highly acclaimed and award-winning projects for clients
                                            around the country & globally also. Kimono Photography is a full-service photography compa providing wedding, newborn, fashion & portfolio photograpy. Kimono Photography is a full-service photography compa providing wedding, newborn, fashion & portfolio photograpy. 
                                        </p>

                                        <div class="swiper-container swiper-testimonial mt-5">    
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
                    
                                                                <p class="wptb-item--description"> “I have an amazing photography session with team
                                                                    kimono photography agency, highly recommended.
                                                                    They have amazing atmosphere in their studio. Iw’d
                                                                    love to visit again”</p>
                                                                <div class="wptb-item--meta">
                                                                    <div class="wptb-item--image">
                                                                        <img src="../assets/img/testimonial/1.jpg" alt="img">
                                                                    </div>
                                                                    <div class="wptb-item--meta-left">
                                                                        <h4 class="wptb-item--title">Rachel Jackson</h4>
                                                                        <h6 class="wptb-item--designation">New York</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
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
                    
                                                                <p class="wptb-item--description"> “I have an amazing photography session with team
                                                                    kimono photography agency, highly recommended.
                                                                    They have amazing atmosphere in their studio. Iw’d
                                                                    love to visit again”</p>
                                                                <div class="wptb-item--meta">
                                                                    <div class="wptb-item--image">
                                                                        <img src="../assets/img/testimonial/2.jpg" alt="img">
                                                                    </div>
                                                                    <div class="wptb-item--meta-left">
                                                                        <h4 class="wptb-item--title">Helen Jordan</h4>
                                                                        <h6 class="wptb-item--designation">Chicago</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
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
                    
                                                                <p class="wptb-item--description"> “I have an amazing photography session with team
                                                                    kimono photography agency, highly recommended.
                                                                    They have amazing atmosphere in their studio. Iw’d
                                                                    love to visit again”</p>
                                                                <div class="wptb-item--meta">
                                                                    <div class="wptb-item--image">
                                                                        <img src="../assets/img/testimonial/3.jpg" alt="img">
                                                                    </div>
                                                                    <div class="wptb-item--meta-left">
                                                                        <h4 class="wptb-item--title">Helen Jordan</h4>
                                                                        <h6 class="wptb-item--designation">New York</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <!-- Swiper Navigation -->
                                            <div class="wptb-swiper-navigation style1">                      
                                                <div class="wptb-swiper-arrow swiper-button-prev"></div>
                                                <div class="wptb-swiper-arrow swiper-button-next"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="wptb-page-links">
                                            <div class="wptb-pge-link--item previous">
                                                <a href="case-details.html"><i class="bi bi-arrow-left"></i> <span>Previous</span></a>
                                            </div>
                                            <div class="wptb-pge-link--item next">
                                                <a href="case-details.html"><span>Next</span> <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                    
                                <!-- Service Side Info -->
                                <div class="col-lg-3 col-md-4 p-md-0 mt-5 mt-md-0">
                                    <div class="sidebar">
                                        <div class="wptb-project-info1">
                                            <h5 class="wptb-item--title">Project Details</h5>
                                            <div class="wptb--holder">
                                                <div class="wptb--item">
                                                    <div class="wptb--meta"><label>Client Name:</label> <span>Elizabeth Rose</span></div>
                                                </div>
                                                <div class="wptb--item">
                                                    <div class="wptb--meta"><label>Address:</label> <span>California, USA</span></div>
                                                </div>
                                                <div class="wptb--item">
                                                    <div class="wptb--meta"><label>Place:</label> <span>Kimora Indoor Studio </span></div>
                                                </div>
                                                <div class="wptb--item">
                                                    <div class="wptb--meta"><label>Concept:</label> <span>Newborn</span></div>
                                                </div>
                                                <div class="wptb--item rating">
                                                    <div class="wptb--meta"><label>Client Rating:</label> <span><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i></span></div>
                                                </div>
                                            </div>
                                            <div class="wptb-item--footer">
                                                <div class="wptb-footer--item">
                                                    <h3>Sony</h3>
                                                    <label>Alfa 6700</label>
                                                </div>
                                                <div class="wptb-footer--item">
                                                    <h3>Canon</h3>
                                                    <label>EOS R50 camera</label>
                                                </div>
                                            </div>
                                        </div>
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