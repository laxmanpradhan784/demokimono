<?php
// Start the session
session_name('user_session');
session_start();

// Include database connection
include('conn.php');

// Initialize variables
$name = $email = $subject = $message = '';
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate input
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Name, email, and message are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Your message has been sent successfully!";
            header('Location: contact.php'); // Redirect to avoid form resubmission
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kimono</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Include your CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <style>
        .form-control.error {
            border-color: red;
        }
        .error-message {
            color: #721c24;
            font-size: 0.875em;
            margin-top: 0.25rem;
            display: block;
        }
        #messages {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            z-index: 1000;
            text-align: center; /* Center the text */
        }
        #messages .alert {
            margin-bottom: 0;
            display: inline-block; /* Ensure it's centered horizontally */
        }
    </style>
</head>
<body>

<?php include 'anavbar.php'; ?>

<!-- Messages -->
<div id="messages">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success mt-3">
            <?php 
            echo htmlspecialchars($_SESSION['success']);
            unset($_SESSION['success']); // Clear the message after displaying
            ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger mt-3">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
</div>

<!-- Contact Section -->
<section class="wptb-contact-form bg-image-5" style="background-image: url('../assets/img/background/bg-9.jpg');">
    <div class="container">
        <div class="wptb-form--wrapper no-bg">
            <div class="row">
                <div class="col-lg-5">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner">
                            <h6 class="wptb-item--subtitle"> <span>01 //</span> Contact Us</h6>
                            <h1 class="wptb-item--title"> Feel Free To Ask Us <span>Anything</span></h1>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="wptb-office">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--subtitle">
                                    Call Us For Query
                                </div>
                                <h5 class="wptb-item--title"><a href="tel:+919913817411">+919913817411</a></h5>
                            </div>
                        </div>

                        <div class="wptb-office">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--subtitle">
                                    SEND US EMAIL
                                </div>
                                <h5 class="wptb-item--title"><a href="mailto:laxmanpradhan@gmail.com">laxmanpradhan@gmail.com</a></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <form id="contactForm" class="wptb-form" action="contact.php" method="post">
                        <div class="wptb-form--inner">        
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Name*" value="<?php echo htmlspecialchars($name); ?>">
                                    </div>
                                </div>
    
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail*" value="<?php echo htmlspecialchars($email); ?>">
                                    </div>
                                </div>
    
                                <div class="col-lg-12 col-md-12 mb-4">
                                    <div class="form-group">
                                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="<?php echo htmlspecialchars($subject); ?>">
                                    </div>
                                </div>
    
                                <div class="col-md-12 col-lg-12 mb-4">
                                    <div class="form-group">
                                        <textarea id="message" name="message" class="form-control" placeholder="Text" rows="5"><?php echo htmlspecialchars($message); ?></textarea>
                                    </div>
                                </div>
    
                                <div class="col-md-12 col-lg-12">
                                    <div class="wptb-item--button"> 
                                        <button class="btn btn-primary" type="submit">
                                            <span class="btn-wrap">
                                                <span class="text-first">Submit</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> <!-- Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const subjectField = document.getElementById('subject');
    const messageField = document.getElementById('message');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous error states
        clearErrors();

        // Validate Name
        if (nameField.value.trim() === '') {
            showError(nameField, 'Name is required.');
            isValid = false;
        }

        // Validate Email
        if (emailField.value.trim() === '') {
            showError(emailField, 'Email is required.');
            isValid = false;
        } else if (!validateEmail(emailField.value)) {
            showError(emailField, 'Invalid email format.');
            isValid = false;
        }

        // Validate Subject
        if (subjectField.value.trim() === '') {
            showError(subjectField, 'Subject is required.');
            isValid = false;
        }

        // Validate Message
        if (messageField.value.trim() === '') {
            showError(messageField, 'Message is required.');
            isValid = false;
        }

        // Prevent form submission if invalid
        if (!isValid) {
            event.preventDefault();
        }
    });

    function showError(field, message) {
        field.classList.add('error');
        const errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        errorSpan.textContent = message;
        field.parentElement.appendChild(errorSpan);
    }

    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.form-control').forEach(el => el.classList.remove('error'));
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    // Fade out messages after 2 seconds
    setTimeout(function() {
        const alertMessages = document.querySelectorAll('#messages .alert');
        alertMessages.forEach(function(alert) {
            alert.style.transition = 'opacity 1s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 1000); // Fully remove after fade
        });
    }, 2000);
});
</script>

</body>
</html>
