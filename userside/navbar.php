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
    
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Page Title -->
    <title>Kimono Photography</title>    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Styles Include -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        body {
                 font-family: 'Montserrat', sans-serif;
                 line-height: 1.6; /* Optional: for better readability */
            }

    </style>
</head>


<body class="theme-style--gradient">
     <!--  a pointer round cercle start -->
		<!-- <div class="pointer bnz-pointer" id="bnz-pointer"></div> -->

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <img src="../assets/img/preloader-logo.svg" alt="img">
                <img src="../assets/img/preloader-wheel.svg" alt="img" class="wheel">
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="header">
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
                            <li class="menu-item"><a href="project-carousel.php">Showcase</a></li>
                            <li class="menu-item menu-item-has-children"><a href="gallery.php">Gallery</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="project-overlapping.php">Overlapping</a></li>
                                    <li class="menu-item"><a href="project-details.php">Project Details</a></li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-has-children"><a href="#">Pages</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-has-children"><a href="services-1.php">Services</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="service-details.php">Service Details</a></li>
                                            <li class="menu-item"><a href="service-details-2.php">Service Details more</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item"><a href="contact.php">Contact</a></li>

                                    <li class="menu-item menu-item-has-children"><a href="#">Our Team</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="team-1.php">Team Grid</a></li>
                                            <li class="menu-item"><a href="team-details.php">Team Details</a></li>
                                        </ul>
                                     </ul>
                                    </li>
                            <li class="menu-item"><a href="price.php">Prices</a>
                            <li class="menu-item"><a href="shop.php">Shop</a></li>
                            <li class="menu-item"><a href="package.php">Packages</a></li>
                            <li class="menu-item"><a href="blog-details.php">Blog</a></li>
                            <li class="menu-item"><a href="login.php">Login</a></li> 
                            <li class="menu-item"><a href="about.php">About Us</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Navbar Toggle Button for Mobile -->
                <button class="navbar-toggler d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

        <!-- Collapsible Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="project-carousel.php">Showcase</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gallery</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="project-overlapping.php">Overlapping</a></li>
                        <li><a class="dropdown-item" href="project-details.php">Project Details</a></li>
                    </ul>
                </li>
                <!-- Add other nav items here -->
            </ul>
        </div>
    </header>

    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>

    <!-- Core JS -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
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
    <!-- Theme Custom JS -->
    <script src="../assets/js/theme.js"></script>

</body>
</html>
