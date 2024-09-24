<?php
include 'conn.php';

// Fetch photos from the database
$sql = "SELECT * FROM photo WHERE status = 'active' ORDER BY id DESC";
$result = $conn->query($sql);
if (!$result) {
    die("Error fetching photos: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Photos</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-top: 20px;
        }
        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 0 15px;
        }
        .photo-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            background-color: #fff;
        }
        .photo-img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-header">Photo Gallery</h1>
        <!-- Photo Gallery -->
        <div class="photo-gallery">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="photo-item">
                    <?php
                    // Get the image file name from the database
                    $image_url = htmlspecialchars($row['image_url']);
                    // Use a relative URL path for accessing images
                    $full_image_url = "/uploads/" . $image_url;
                    ?>
                    <!-- Display the image with error handling -->
                    <img src="<?php echo $full_image_url; ?>" class="photo-img" alt="Photo" onerror="this.onerror=null;this.src='/uploads/default-image.jpg';">
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
