<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Fetch active images or blog posts
$query = "SELECT * FROM blog WHERE status = 'active'";
$result = $conn->query($query);

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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kimono - Photography Blog">
    <meta name="author" content="">

    <!-- Favicon and touch Icons -->
    <link href="../assets/img/favicon.png" rel="shortcut icon" type="image/png">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="../assets/img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="../assets/img/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Page Title -->
    <title>Kimono - Blog Gallery</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <style>
        .post {
            margin-bottom: 40px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }

        .post img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .post-title {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .post-date {
            color: #888;
            margin-bottom: 15px;
        }

        .post-content p {
            font-size: 18px;
        }

        .post-footer {
            margin-top: 20px;
        }

        .share-list {
            list-style: none;
            padding: 0;
        }

        .share-list li {
            display: inline;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <!-- Main Wrapper -->
    <main class="container my-4">
        <!-- Blog Posts -->
        <section class="blog-section">
            <div class="row">
                <div class="col-12">
                    <div class="post-list">
                        <!-- Fetch and display blog posts -->
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <article class="post">
                                    <div class="post-header text-center">
                                        <a href="image.php?id=<?php echo $row['id']; ?>">
                                            <h2 class="post-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                                            <p class="post-date">Posted on <?php echo date('F j, Y', strtotime($row['uploaded_at'])); ?></p>
                                            <img src="../adminside/uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" style="width: 1300px; height: 800px; object-fit: cover;">
                                        </a>
                                    </div>

                                    <div class="post-content">
                                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                                    </div>

                                    <div class="post-footer text-center">
                                        <ul class="share-list">
                                            <li>Share:</li>
                                            <li><a href="#">Facebook</a></li>
                                            <li><a href="#">Twitter</a></li>
                                            <li><a href="#">Pinterest</a></li>
                                            <li><a href="#">Instagram</a></li>
                                            <li><a href="#">LinkedIn</a></li>
                                        </ul>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-center">No posts available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Main Wrapper End -->

    <!-- JS Include -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <?php include 'footer.php'; ?>
</body>

</html>
