<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Replace with your preferred redirect page
    exit();
}

// Fetch active products from the database
$sql = "SELECT id, name, price, image FROM product WHERE status = 'active' ORDER BY uploaded_at DESC LIMIT 6";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->get_result();

// Fetch active blogs from the database
$blogQuery = "SELECT id, title, description, image, uploaded_at FROM blog WHERE status = 'active' ORDER BY uploaded_at DESC LIMIT 3";
$blogResult = $conn->query($blogQuery);

// Error handling
if (!$products || !$blogResult) {
    die("Database query failed: " . $conn->error);
}

// Fetch all sliders from the database
$query = "SELECT * FROM sliders WHERE status = 'active' ORDER BY uploaded_at DESC ";
$sliders = $conn->query($query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kimono - Photography Agency">
    <meta name="author" content="">

    <!-- Favicon and Touch Icons -->
    <link href="../assets/img/favicon.png" rel="shortcut icon" type="image/png">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="../assets/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="../assets/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Page Title -->
    <title>Kimono</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Additional Styles */
        .carousel-item img {
            width: 100%;
            height: 700px;
            object-fit: cover;
            margin-top: 100px;
            border-radius: 10px;
        }

        .product_item {
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .product_thumb {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product_thumb img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product_item:hover .product_thumb img {
            transform: scale(1.1);
        }

        .product_item_inner {
            padding: 15px;
            text-align: center;
        }

        .product_item_name {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .product_item_price {
            font-size: 1.5rem;
            color: #28a745;
        }

        .cart_button button {
            width: 100%;
            padding: 10px 20px;
        }

        .blog-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .blog-item img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-item:hover img {
            transform: scale(1.05);
        }

        .blog-item .card-body {
            padding: 15px;
        }

        .blog-item-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .blog-item-description {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .read-more {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <!-- Bootstrap Carousel -->
    <div class="container-fluid mt-5 carousel-container">
        <?php if ($sliders->num_rows > 0): ?>
            <div id="sliderCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $active = true;
                    while ($row = $sliders->fetch_assoc()): ?>
                        <div class="carousel-item <?= $active ? 'active' : ''; ?>">
                            <img src="../adminside/uploads/<?= htmlspecialchars($row['image']); ?>" class="d-block w-100" alt="Slider Image">
                            <?php if (!empty($row['caption'])): ?>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?= htmlspecialchars($row['caption']); ?></h5>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php $active = false; ?>
                    <?php endwhile; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#sliderCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#sliderCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php else: ?>
            <p>No slider images found!</p>
        <?php endif; ?>
    </div>

    <!-- Slider Section -->
    <section class="wptb-slider style4">
                <div class="wptb-heading-two">
                    <div class="wptb-item--inner text-center">
                        <h6 class="wptb-item">Kimono Photography Agency</h6>
                        <h1 class="wptb-item--title"> We Capture Your Best <br> <span>Memories</span> Here</h1>
                        <div class="wptb-item--description">
                            kimono photography Agency runs wide and deep. Across many <br> markets, geographies & typologies, our team members
                        </div>
                    </div>
                </div>

    <!-- Product Grid Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Our Product List</h2>
        <div class="row g-4">
            <?php while ($product = $products->fetch_assoc()) {
                $imagePath = '../assets/img/shop/' . htmlspecialchars($product['image']);
                if (!file_exists($imagePath)) {
                    $imagePath = '../assets/img/shop/default.jpg'; // Fallback image
                }
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="product_item">
                        <a href="product_detail.php?id=<?= htmlspecialchars($product['id']); ?>" class="product_thumb">
                            <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                        </a>
                        <div class="product_item_inner">
                            <h2 class="product_item_name">
                                <a href="product_detail.php?id=<?= htmlspecialchars($product['id']); ?>"><?= htmlspecialchars($product['name']); ?></a>
                            </h2>
                            <span class="product_item_price">₹<?= number_format(htmlspecialchars($product['price']), 2); ?></span>
                            <div class="cart_button mt-3">
                                <form method="post">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                                    <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Latest Blog Posts</h2>
        <div class="row g-4">
            <?php while ($blog = $blogResult->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card blog-item ">
                        <a href="image.php?id=<?= htmlspecialchars($blog['id']); ?>">
                            <img src="../adminside/uploads/<?= htmlspecialchars($blog['image']); ?>" alt="<?= htmlspecialchars($blog['title']); ?>" class="card-img-top">
                        </a>
                        <div class="card-body bg-dark">
                            <h5 class="blog-item-title">
                                <a href="image.php?id=<?= htmlspecialchars($blog['id']); ?>"><?= htmlspecialchars($blog['title']); ?></a>
                            </h5>
                            <p class="blog-item-description"><?= htmlspecialchars(substr($blog['description'], 0, 100)); ?>...</p>
                            <a href="image.php?id=<?= htmlspecialchars($blog['id']); ?>" class="read-more text-primary">Read more</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Services -->
    <section class="wptb-services-one pd-bottom-80 bg-image-4" style="background-image: url('../assets/img/more/texture-3.png'); background-position: 50% -16%;">
        <div class="container position-relative">
            <div class="wptb-heading-two">
                <div class="wptb-item--inner text-center">
                    <h6 class="wptb-item">Photography</h6>
                    <h1 class="wptb-item--title"> Explore Kimono <br> Photography <span>Services</span> </h1>
                    <div class="wptb-item--description">
                        kimono photography Agency runs wide and deep. Across many <br> markets, geographies & typologies, our team members
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Iconbox -->
                <div class="col-md-4 pd-left-25 pd-right-25 wow fadeInLeft">
                    <div class="wptb-icon-box7 mb-0">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon">
                                <img src="../assets/img/services/icon-9.svg" alt="img">
                            </div>
                            <div class="wptb-item--holder">
                                <h4 class="wptb-item--title"><a href="book_appointment.php">Wedding Photography</a></h4>
                                <p class="wptb-item--description">The talent at kimono runs wide range of services. Across many markets, geographies</p>
                                <h6 class="wptb-item--count text-outline">01</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Iconbox -->
                <div class="col-md-4 pd-left-25 pd-right-25 wow fadeInLeft">
                    <div class="wptb-icon-box7 mb-0 active highlight">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon">
                                <img src="../assets/img/services/icon-10.svg" alt="img">
                            </div>
                            <div class="wptb-item--holder">
                                <h4 class="wptb-item--title"><a href="book_appointment.php">Wedding Cinematography</a></h4>
                                <p class="wptb-item--description">The talent at kimono runs wide range of services. Across many markets, geographies</p>
                                <h6 class="wptb-item--count text-outline">02</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Iconbox -->
                <div class="col-md-4 pd-left-25 pd-right-25 wow fadeInLeft">
                    <div class="wptb-icon-box7 mb-0">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon">
                                <img src="../assets/img/services/icon-11.svg" alt="img">
                            </div>
                            <div class="wptb-item--holder">
                                <h4 class="wptb-item--title"><a href="book_appointment.php">Wedding Cinematography</a></h4>
                                <p class="wptb-item--description">The talent at kimono runs wide range of services. Across many markets, geographies</p>
                                <h6 class="wptb-item--count text-outline">03</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Iconbox -->
                <div class="col-md-4 pd-left-25 pd-right-25 wow fadeInLeft">
                    <div class="wptb-icon-box7 mb-0">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon">
                                <img src="../assets/img/services/icon-12.svg" alt="img">
                            </div>
                            <div class="wptb-item--holder">
                                <h4 class="wptb-item--title"><a href="book_appointment.php">Personal Portfolio Shoot</a></h4>
                                <p class="wptb-item--description">The talent at kimono runs wide range of services. Across many markets, geographies</p>
                                <h6 class="wptb-item--count text-outline">04</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Iconbox -->
                <div class="col-md-4 pd-left-25 pd-right-25 wow fadeInLeft">
                    <div class="wptb-icon-box7 mb-0">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon">
                                <img src="../assets/img/services/icon-13.svg" alt="img">
                            </div>
                            <div class="wptb-item--holder">
                                <h4 class="wptb-item--title"><a href="book_appointment.php">Wedding Cinematography</a></h4>
                                <p class="wptb-item--description">The talent at kimono runs wide range of services. Across many markets, geographies</p>
                                <h6 class="wptb-item--count text-outline">05</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Iconbox -->
                <div class="col-md-4 pd-left-25 pd-right-25 wow fadeInLeft">
                    <div class="wptb-icon-box7 mb-0">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--icon">
                                <img src="../assets/img/services/icon-14.svg" alt="img">
                            </div>
                            <div class="wptb-item--holder">
                                <h4 class="wptb-item--title"><a href="book_appointment.php">Personal Portfolio Shoot</a></h4>
                                <p class="wptb-item--description">The talent at kimono runs wide range of services. Across many markets, geographies</p>
                                <h6 class="wptb-item--count text-outline">06</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid_lines">
                <div class="grid_line"></div>
                <div class="grid_line"></div>
                <div class="grid_line"></div>
                <div class="grid_line"></div>
            </div>
        </div>
    </section>

    <div class="divider-line-hr"></div>

    <!-- About Kimono -->
    <section class="wptb-about-three">
        <!-- Layer Image -->
        <div class="wptb-item-layer wptb-item-layer-one both-version">
            <img src="../assets/img/more/overlay-1.png" alt="img">
            <img src="../assets/img/more/overlay-1-light.png" alt="img">
        </div>

        <div class="container">
            <div class="row">
                <div class="col-xl-7">
                    <div class="wptb-heading-two">
                        <div class="wptb-item--inner">
                            <h6 class="wptb-item">About Kimono Photography</h6>
                            <h1 class="wptb-item--title">We are the kimono <br> Photography Studio</h1>
                            <div class="wptb-item--description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius
                                mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-10">
                            <div class="wptb-progressbar mb-4">
                                <div class="wptb-progressbar--inner">
                                    <div class="wptb-progress--label">Photography</div>
                                    <div class="progress" style="height: 3px;">
                                        <div class="progress-bar bg-one" role="progressbar" style="width: 92%" aria-valuemin="0" aria-valuemax="100"><span class="wptb-progress--value">92%</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="wptb-progressbar mb-4">
                                <div class="wptb-progressbar--inner">
                                    <div class="wptb-progress--label">Cinematography</div>
                                    <div class="progress" style="height: 3px;">
                                        <div class="progress-bar bg-one" role="progressbar" style="width: 78%" aria-valuemin="0" aria-valuemax="100"><span class="wptb-progress--value">78%</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="wptb-progressbar mb-4">
                                <div class="wptb-progressbar--inner">
                                    <div class="wptb-progress--label">Film Making</div>
                                    <div class="progress" style="height: 3px;">
                                        <div class="progress-bar bg-one" role="progressbar" style="width: 86%" aria-valuemin="0" aria-valuemax="100"><span class="wptb-progress--value">86%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mr-top-50 mr-bottom-50 d-inline-block w-100"></div>

                    <h4 class="widget-title"><span>//</span>Why Choose Us</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius mod
                        unt ut labore et dolore magna aliqua. Ut enim ad minim.</p>

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="wptb-list1">
                                <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">Printed Photograph provided</div>
                                </div>
                                <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">High Resolution Camera</div>
                                </div>
                                <div class="wptb--item mr-bottom-10 wow skewIn" data-wow-delay="700ms">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">Experienced Photographer</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="wptb-list1">
                                <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">Indoor & Outdoor Arrangement</div>
                                </div>
                                <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">Awarded For Photography</div>
                                </div>
                                <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">International Recognition</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mr-top-50 mr-bottom-50 d-inline-block w-100"></div>

                    <h4 class="widget-title"><span>//</span>Kimono Operation</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius mod
                        unt ut labore et dolore magna aliqua. Ut enim ad minim.</p>

                    <div class="row mt-5">
                        <div class="col-md-6 mr-bottom-75 pe-md-5">
                            <div class="wptb-counter1 style1 position-relative z-index-3 wow skewIn">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder d-flex align-items-center">
                                        <div class="wptb-item--value"><span class="odometer" data-count="100"></span><span class="suffix">%</span></div>
                                        <div class="wptb-item--text">Customer Satisfaction</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mr-bottom-75 pe-md-5">
                            <div class="wptb-counter1 style1 position-relative z-index-3 wow skewIn">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder d-flex align-items-center">
                                        <div class="wptb-item--value flex-shrink-0"><span class="odometer" data-count="350"></span><span class="suffix">+</span></div>
                                        <div class="wptb-item--text">Photography Session</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mr-bottom-75 mb-md-0 pe-md-5">
                            <div class="wptb-counter1 style1 position-relative z-index-3 wow skewIn">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder d-flex align-items-center">
                                        <div class="wptb-item--value"><span class="odometer" data-count="50"></span><span class="suffix">+</span></div>
                                        <div class="wptb-item--text">Experienced Photographers</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mr-bottom-75 mb-md-0 pe-md-5">
                            <div class="wptb-counter1 style1 position-relative z-index-3 wow skewIn">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder d-flex align-items-center">
                                        <div class="wptb-item--value flex-shrink-0"><span class="odometer" data-count="250"></span><span class="suffix">+</span></div>
                                        <div class="wptb-item--text">Event Covered</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 offset-xl-1">
                    <div class="wptb-gallery-box">
                        <div class="swiper-container swiper-gallery-left">
                            <!-- swiper slides -->
                            <div class="swiper-wrapper">
                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/1.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/2.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/3.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/1.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/2.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->
                            </div>
                        </div>

                        <div class="swiper-container swiper-gallery-right">
                            <!-- swiper slides -->
                            <div class="swiper-wrapper">
                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/4.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/5.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/6.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/4.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->

                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="wptb-slider--item">
                                        <div class="wptb-slider--image">
                                            <img src="../assets/img/team/5.jpg" alt="img">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Slide Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Layer Image -->
        <div class="wptb-item-layer wptb-item-layer-two both-version">
            <img src="../assets/img/more/overlay-2.png" alt="img">
            <img src="../assets/img/more/overlay-2-light.png" alt="img">
        </div>
    </section>


    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core JS -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- Framework -->
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Other Plugins -->
    <script src="../plugins/wow/wow.min.js"></script>
    <script src="../plugins/swiper/swiper-bundle.min.js"></script>
    <script src="../plugins/swiper/swiper-gl.min.js"></script>
    <script src="../plugins/odometer/appear.js"></script>
    <script src="../plugins/odometer/odometer.js"></script>
    <script src="../plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="../plugins/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="../plugins/isotope/isotope-init.js"></script>
    <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="../plugins/flatpickr/flatpickr.min.js"></script>
    <script src="../plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="../plugins/cursor-effect/cursor-effect.js"></script>

    <!-- Theme Custom JS -->
    <script src="../assets/js/theme.js"></script>
</body>

</html>