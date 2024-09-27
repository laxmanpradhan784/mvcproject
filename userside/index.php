<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php"); // Redirect to profile if logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            /* Gradient background for the body */
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white; /* Optional: Change text color for better contrast */
        }
        .container h1{
            margin-top: 100px;
        }
        .feature-icon {
            font-size: 50px;
            color: #007bff;
        }
        .card {
            background: rgba(255, 255, 255, 0.9); /* White background for cards with some transparency */
            color: #333; /* Dark text color for card content */
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Welcome to Our Website</h1>
    
    <div class="text-center mt-4">
        <a href="login.php" class="btn btn-primary btn-lg">Login</a>
        <a href="register.php" class="btn btn-secondary btn-lg">Register</a>
    </div>

    <div class="text-center mt-4">
        <p>Don't have an account? <a href="register.php" class="text-light">Sign up now</a></p>
        <p>Already have an account? <a href="login.php" class="text-light">Log in</a></p>
    </div>

    <hr class="my-5">

    <h2 class="text-center">Testimonials</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">"This website changed my life! Highly recommended!"</p>
                    <h5 class="card-title">- User One</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">"A fantastic experience, I loved every moment!"</p>
                    <h5 class="card-title">- User Two</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">"Great service and amazing support!"</p>
                    <h5 class="card-title">- User Three</h5>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <h2 class="text-center">Join Us Today!</h2>
    <p class="text-center">
        Become a part of our community and enjoy all the benefits we offer. 
        <br>
        <a href="register.php" class="btn btn-success btn-lg mt-3">Get Started</a>
    </p>

</div>

<?php include 'footer.php'; ?>


<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
