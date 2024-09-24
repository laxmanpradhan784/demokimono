<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Check if an image ID is passed in the URL
if (isset($_GET['id'])) {
    $image_id = intval($_GET['id']);
    
    // Fetch image details from the database
    $query = "SELECT * FROM blog WHERE id = $image_id AND status = 'active'";
    $result = $conn->query($query);

    // Check if the image exists
    if ($result->num_rows > 0) {
        $image = $result->fetch_assoc();
    } else {
        // Redirect to the gallery if no image found
        header('Location: blog-details.php');
        exit();
    }
} else {
    // Redirect to gallery if no ID is provided
    header('Location: blog-details.php');
    exit();
}

// Fetch other posts for the sidebar
$other_posts_query = "SELECT id, title, description, image FROM blog WHERE status = 'active' AND id != $image_id LIMIT 5";
$other_posts_result = $conn->query($other_posts_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($image['title']); ?> - Image Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        main {
            flex: 3;
            margin-top: 100px;
        }

        aside {
            flex: 1;
            padding: 20px;
            margin-left: 20px;
            margin-top: 100px;
            border-left: 1px solid #ddd;
        }

        aside h3 {
            margin-bottom: 20px;
        }

        aside .other-post {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        aside .other-post img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        aside .other-post-title {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        aside .other-post-description {
            font-size: 0.9rem;
            color: #777;
            margin-top: 5px;
        }

        .post-footer {
            margin-top: 20px;
        }

        .comments-area {
            margin-top: 20px;
        }

        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .comment:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>
<?php include 'search.php'; ?>

<div class="container">
    <main>
    <article>
    <h1><?php echo htmlspecialchars($image['title']); ?></h1>
    <img src="../adminside/uploads/<?php echo htmlspecialchars($image['image']); ?>" 
         alt="<?php echo htmlspecialchars($image['title']); ?>" 
         class="img-fluid mt-4" 
         style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); width: 900px; height: 500px; object-fit: cover;">
    <p class="mt-3"><?php echo nl2br(htmlspecialchars($image['description'])); ?></p>
    <p><strong>Uploaded on:</strong> <?php echo htmlspecialchars($image['uploaded_at']); ?></p>
</article>

        <!-- Post footer with share buttons -->
        <div class="post-footer text-center mt-5">
            <div class="post-share">
                <ul class="share-list list-inline">
                    <li class="list-inline-item">Share:</li>
                    <li class="list-inline-item"><a href="#">Facebook</a></li>
                    <li class="list-inline-item"><a href="#">Twitter</a></li>
                    <li class="list-inline-item"><a href="#">Pinterest</a></li>
                    <li class="list-inline-item"><a href="#">Instagram</a></li>
                    <li class="list-inline-item"><a href="#">LinkedIn</a></li>
                </ul>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="comments-area mt-5">
            <h3 class="comments-title">Comments</h3>
            <ul class="comment-list">
                <!-- Example Comment -->
                <li class="comment">
                    <div class="commenter-block">
                        <div class="comment-avatar">
                            <img src="../assets/img/blog/commenter-1.jpg" alt="Avatar" class="avatar" style="border-radius: 50%; width: 50px; height: 50px;">
                        </div>
                        <div class="comment-content">
                            <div class="comment-author-name">John Doe <span class="comment-date">January 12, 2023</span></div>
                            <p>Great photo! The lighting is perfect.</p>
                            <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="comments-area mt-5">
            <h3 class="comments-title">Comments</h3>
            <ul class="comment-list">
                <!-- Example Comment -->
                <li class="comment">
                    <div class="commenter-block">
                        <div class="comment-avatar">
                            <img src="../assets/img/blog/commenter-1.jpg" alt="Avatar" class="avatar" style="border-radius: 50%; width: 50px; height: 50px;">
                        </div>
                        <div class="comment-content">
                            <div class="comment-author-name">John Doe <span class="comment-date">January 12, 2023</span></div>
                            <p>Great photo! The lighting is perfect.</p>
                            <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                        </div>
                    </div>
                </li>
                <!-- Example Comment -->
                <li class="comment">
                    <div class="commenter-block">
                        <div class="comment-avatar">
                            <img src="../assets/img/blog/commenter-1.jpg" alt="Avatar" class="avatar" style="border-radius: 50%; width: 50px; height: 50px;">
                        </div>
                        <div class="comment-content">
                            <div class="comment-author-name">John Doe <span class="comment-date">January 12, 2023</span></div>
                            <p>Great photo! The lighting is perfect.</p>
                            <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                        </div>
                    </div>
                </li>
                <!-- Example Comment -->
                <li class="comment">
                    <div class="commenter-block">
                        <div class="comment-avatar">
                            <img src="../assets/img/blog/commenter-1.jpg" alt="Avatar" class="avatar" style="border-radius: 50%; width: 50px; height: 50px;">
                        </div>
                        <div class="comment-content">
                            <div class="comment-author-name">John Doe <span class="comment-date">January 12, 2023</span></div>
                            <p>Great photo! The lighting is perfect.</p>
                            <span class="comment-reply"><a href="#" class="comment-reply-link">Reply</a></span>
                        </div>
                    </div>
                </li>
                
            </ul>
        </div>
        
    </main>

    <aside>
    <h3>Other Posts</h3>
    <?php while ($other_post = $other_posts_result->fetch_assoc()): ?>
        <div class="other-post">
            <a href="image.php?id=<?php echo $other_post['id']; ?>">
                <img src="../adminside/uploads/<?php echo htmlspecialchars($other_post['image']); ?>" alt="<?php echo htmlspecialchars($other_post['title']); ?>"
                 style="width: 300px; height: 250px; object-fit: cover;">
                <h4 class="other-post-title"><?php echo htmlspecialchars($other_post['title']); ?></h4>
            </a>
            <p class="other-post-description">
                <?php echo htmlspecialchars(substr($other_post['description'], 0, 100)); ?>...
            </p>
        </div>
    <?php endwhile; ?>
</aside>
</div>

<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
