<?php
// Start the session
session_name('user_session');
session_start();

// Include the database connection file
require_once 'conn.php';
include 'check_user.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
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

    <?php include 'anavbar.php'; ?>
    <?php include 'search.php'; ?>
        

            <section class="wptb-pricing">
                <div class="container">
                    <div class="wptb-pricing--inner">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner text-center">
                                <h1 class="wptb-item--title">Pricing Options</h1>
                                <p class="wptb-item--description">Please confirm that you would like to request the following appointment:</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="wptb-packages1 active highlight">
                                    <h6 class="wptb-item--tag">Most Popular</h6>
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder">
                                            <h6 class="wptb-item--subtitle">Indivisual</h6>
                                            <h4 class="wptb-item--title">$20/<sub>session</sub></h4>
                                            <div class="wptb-list1">
                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">1 Hours on Location</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">2 Outfit Changes</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">90 Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">30 Low Resolution Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">60 High Resolution Images</div>
                                                </div>
                                            </div>

                                            <div class="wptb-item--button"> 
                                                <a class="btn gray creative" href="book_appointment.php"> 
                                                    <div class="btn-wrap">
                                                        <span class="text-first"> Book Appontment </span> 
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="wptb-packages1">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder">
                                            <h6 class="wptb-item--subtitle">Corporate</h6>
                                            <h4 class="wptb-item--title">$35/<sub>session</sub></h4>
                                            <div class="wptb-list1">
                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">1 Hours on Location</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">2 Outfit Changes</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">90 Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">30 Low Resolution Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">60 High Resolution Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">Cinematography</div>
                                                </div>
                                            </div>

                                            <div class="wptb-item--button"> 
                                                <a class="btn gray creative" href="book_appointment.php"> 
                                                    <div class="btn-wrap">
                                                        <span class="text-first"> Book Appontment </span> 
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="wptb-packages1">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--holder">
                                            <h6 class="wptb-item--subtitle">Wedding</h6>
                                            <h4 class="wptb-item--title">$55/<sub>session</sub></h4>
                                            <div class="wptb-list1">
                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">1 Hours on Location</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">2 Outfit Changes</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">90 Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">30 Low Resolution Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">60 High Resolution Images</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">Cinematography</div>
                                                </div>

                                                <div class="wptb--item">
                                                    <div class="wptb-item--icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="7" viewBox="0 0 30 7" fill="none">
                                                            <g clip-path="url(#clip0_1_31097)">
                                                                <path d="M12.0643 0H8.02251L0.585938 7H4.6277L12.0643 0Z" fill="#D70006"/>
                                                                <path d="M19.8729 0H15.8311L8.39453 7H12.4363L19.8729 0Z" fill="#D70006"/>
                                                            </g>
                                                            <defs>
                                                                <clipPath>
                                                                <rect width="30" height="7" fill="white"/>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="wptb-item--text">50 Printed copy</div>
                                                </div>
                                            </div>

                                            <div class="wptb-item--button"> 
                                                <a class="btn gray creative" href="book_appointment.php"> 
                                                    <div class="btn-wrap">
                                                        <span class="text-first"> Book Appontment </span> 
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <script src="../plugins/jquery_ui/jquery-ui.1.12.1.min.js"></script>

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

        <!-- Price Filter -->
        <script src="../plugins/price-range/price-filter.js"></script>

        

        <!-- Cursor Effect -->
        <script src="../plugins/cursor-effect/cursor-effect.js"></script>

        <!-- Theme Custom JS -->
        <script src="../assets/js/theme.js"></script>
    </body>
</html>