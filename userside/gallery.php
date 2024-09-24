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

// Pagination setup
$limit = 9; // Number of photos per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch photos from the database with pagination
$sql = "SELECT * FROM model WHERE status = 'active' LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$photos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row;
    }
}

// Get the total number of photos to calculate the number of pages
$sqlTotal = "SELECT COUNT(*) as total FROM model WHERE status = 'active'";
$resultTotal = $conn->query($sqlTotal);
$totalPhotos = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalPhotos / $limit);

$conn->close();

// Define the filepath for images
$filepath = '../adminside/uploads/';
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

    <!-- Styles Include -->
    <link rel="stylesheet" href="../assets/css/main.css">

    <!-- Custom Styles -->
    <style>
        .card-img-top {
            width: 100%;
            height: 400px;
            /* Adjust height as needed for larger images */
            object-fit: cover;
            /* Ensures the image covers the area without stretching */
        }

        .grid-item {
            margin-bottom: 30px;
            /* Space between grid items */
        }

        .wptb-item--link {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .wptb-item--holder {
            padding: 15px;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>
    <?php include 'search.php'; ?>

    <!-- Our Projects -->
    <section>
        <div class="container">
            <div class="wptb-project--inner">
                <div class="wptb-heading">
                    <div class="wptb-item--inner text-center">
                        <h6 class="wptb-item--subtitle"><span>01//</span> Our Portfolio</h6>
                        <h1 class="wptb-item--title">Kimono captures <span>All of Your</span> <br>
                            beautiful memories</h1>
                    </div>
                </div>

                <!-- Photo Grid -->
                <div class="effect-gradient has-radius">
                    <div class="grid grid-3 gutter-10 clearfix">
                        <div class="grid-sizer"></div>

                        <?php if (count($photos) > 0): ?>
                            <?php foreach ($photos as $photo): ?>
                                <div class="grid-item">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <?php
                                            // Construct the relative path for the image
                                            $imagePath = $filepath . basename($photo['image']);
                                            ?>
                                            <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top" alt="<?= htmlspecialchars($photo['image']) ?>">
                                            <a class="wptb-item--link" href="project-details.php?id=<?= htmlspecialchars($photo['id']) ?>"><i class="bi bi-chevron-right"></i></a>
                                        </div>

                                        <div class="wptb-item--holder">
                                            <div class="wptb-item--meta">
                                                <!-- Display the photo title -->
                                                <h4><a href="project-details.php?id=<?= htmlspecialchars($photo['id']) ?>"><?= htmlspecialchars($photo['id']) ?></a></h4>
                                                <p>By Jonathon Willson</p> <!-- Placeholder author, replace if necessary -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center">No photos available.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="wptb-pagination-wrap text-center">
                <ul class="pagination justify-content-center">
                    <li class="<?= $page <= 1 ? 'disabled' : '' ?>"><a class="page-number previous" href="?page=<?= $page - 1 ?>"><i class="bi bi-chevron-left"></i></a></li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li><a class="page-number <?= $i == $page ? 'current' : '' ?>" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="<?= $page >= $totalPages ? 'disabled' : '' ?>"><a class="page-number next" href="?page=<?= $page + 1 ?>"><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->

    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>

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