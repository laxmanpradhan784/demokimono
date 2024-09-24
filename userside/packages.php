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


// Fetch all packages from the database
$query = "SELECT * FROM package WHERE status = 'active'"; 
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kimono</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* Include the updated CSS here */
        .grid-item {
            border: none;
            border-radius: 15px;
            text-align: center;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 100px;
            position: relative;
            height: 100%;
            overflow: hidden;
        }

        .grid-item:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .wptb-item--image {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            height: 250px;
        }

        .wptb-item--image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease, filter 0.5s ease;
        }

        .grid-item:hover .wptb-item--image img {
            transform: scale(1.1);
            filter: brightness(90%);
        }

        .wptb-item--subtitle {
            cursor: pointer;
            font-size: 1.5rem;
            color: #007bff;
            margin-top: 1rem;
            transition: color 0.3s ease, transform 0.3s ease;
            padding: 1rem;
            background-color: blue;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .wptb-item--subtitle:hover {
            color: #0056b3;
            transform: translateY(-3px);
        }

        .details-container {
            display: none;
            border-top: 1px solid #ddd;
            padding: 1rem;
            background-color: #f8f9fa;
            color: #555;
            transition: opacity 0.5s ease, transform 0.5s ease;
            overflow: auto;
            max-height: 0;
            opacity: 0;
            transform: scaleY(0);
            transform-origin: top;
        }

        .details-container.active {
            display: block;
            max-height: 400px;
            opacity: 1;
            transform: scaleY(1);
        }

        .wptb-item--description {
            margin: 1rem 0;
            font-size: 1rem;
            color: #333;
        }

        .wptb-list1 {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .wptb-list1 div {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            transition: transform 0.3s ease;
        }

        .wptb-list1 div:hover {
            transform: translateX(5px);
        }

        .wptb-item--icon {
            width: 24px;
            height: 24px;
            background-color: #007bff;
            border-radius: 50%;
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

<?php include 'anavbar.php'; ?>

<div class="container mt-5">
    <div class="row">
        <?php 
        $packages = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $packages[] = $row;
        }
        foreach ($packages as $index => $row): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="grid-item">
                    <a href="book_appointment.php" class="wptb-item--image">
                        <img src="<?php echo htmlspecialchars('../assets/img/packages/' . $row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['package_name']); ?>">
                    </a>
                    <div class="wptb-item--holder">
                        <h5 class="wptb-item--subtitle" onclick="toggleDetails(<?php echo $index; ?>)">
                            <?php echo htmlspecialchars($row['package_name']); ?>
                        </h5>
                        <div class="details-container" id="details-<?php echo $index; ?>">
                            <p class="wptb-item--description"><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="row">
                                <?php 
                                $details = explode(', ', $row['details']);
                                foreach ($details as $detail): ?>
                                    <div class="col-6">
                                        <div class="wptb-list1">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="wptb-item--icon me-2">
                                                    <!-- Icon SVG or placeholder -->
                                                </div>
                                                <div><?php echo htmlspecialchars($detail); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

include 'footer.php'

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleDetails(index) {
        var detailsContainer = document.getElementById('details-' + index);
        if (detailsContainer.classList.contains('active')) {
            detailsContainer.classList.remove('active');
        } else {
            document.querySelectorAll('.details-container').forEach(function(el) {
                el.classList.remove('active');
            });
            detailsContainer.classList.add('active');
        }
    }
</script>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
