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
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/main.css">
    
    <!-- Font Awesome (Optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .carousel-wrapper {
            position: relative;
            height: 500px;
            width: 80%;
            margin: auto;
            overflow: hidden;
            margin-top: 100px;
        }

        .carousel-wrapper .scrolltrigger-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 1s ease, transform 1s ease;
            border-radius: 8px;
        }

        .carousel-wrapper .scrolltrigger-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .carousel-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .carousel-controls button {
            background: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
        }

        #backToTop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<?php include 'navbar.php'; ?>

<!-- Search Bar -->
<?php include 'search.php'; ?>

<!-- Main Content -->
<main class="container my-5">
    <!-- Slider Section -->
    <div class="carousel-wrapper">
        <!-- Slide Items with Lazy Load -->
        <div class="scrolltrigger-slide active" data-bg="url('../assets/img/slider/7.jpg')" style="background-image: url('../assets/img/slider/7.jpg');"></div>
        <div class="scrolltrigger-slide" data-bg="url('../assets/img/slider/8.jpg')"></div>
        <div class="scrolltrigger-slide" data-bg="url('../assets/img/slider/9.jpg')"></div>
        <div class="scrolltrigger-slide" data-bg="url('../assets/img/slider/10.jpg')"></div>
        <div class="scrolltrigger-slide" data-bg="url('../assets/img/slider/12.jpg')"></div>
        <div class="scrolltrigger-slide" data-bg="url('../assets/img/slider/29.jpg')"></div>
        <div class="scrolltrigger-slide" data-bg="url('../assets/img/slider/30.jpg')"></div>
        
        <!-- Carousel Controls -->
        <div class="carousel-controls">
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- Back to Top Button -->
<a href="#" class="btn btn-primary btn-lg rounded-circle" id="backToTop" role="button">
    <i class="bi bi-chevron-up"></i>
</a>

<!-- Core JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script src="../assets/js/theme.js"></script>

<script>
    // Back to Top Button
    document.addEventListener('scroll', function () {
        const backToTopButton = document.getElementById('backToTop');
        if (window.scrollY > 200) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });

    // Lazy load background images for carousel slides
    const lazyLoadSlide = (slide) => {
        const bg = slide.getAttribute('data-bg');
        if (bg && !slide.style.backgroundImage) {
            slide.style.backgroundImage = bg;
        }
    };

    const slides = document.querySelectorAll('.scrolltrigger-slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            if (i === index) {
                lazyLoadSlide(slide);
            }
        });
    }

    // Automatic slide transition
    setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }, 5000); // Change slide every 5 seconds

    // Manual Slide Navigation
    document.querySelector('.next').addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    });

    document.querySelector('.prev').addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    });
</script>

</body>
</html>
