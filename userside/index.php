<?php
session_start(); // Start the session

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include configuration and model
include 'config.php'; // Adjust the path as necessary  
include '../adminside/models/Model.php'; // Adjust the path as necessary

// Create a Model instance and fetch sliders
$model = new Model($connection);
$sliders = $model->getSlider(); // Ensure this function returns a valid result set

// Debugging: Check if $sliders is false or empty
if ($sliders === false) {
    echo "Error fetching sliders: " . $connection->error; // Debugging message
    $hasSliders = false;
} else {
    $hasSliders = $sliders->num_rows > 0; // Check if there are any sliders
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
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            font-family: 'Arial', sans-serif;
        }
        .container h1 {
            margin-top: 100px;
        }
        .carousel-item img {
            max-height: 500px; /* Set a max height for images */
            width: 100%; /* Ensure it takes full width */
            object-fit: cover; /* Ensures the image covers the area */
            border: 5px solid #ffffff; /* Add a white border */
            border-radius: 10px; /* Optional: rounded corners */
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            border: none; /* Remove border for a cleaner look */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Add shadow */
            transition: transform 0.2s; /* Animation for hover */
        }
        .card:hover {
            transform: scale(1.05); /* Scale on hover */
        }
        .btn-custom {
            border-radius: 50px; /* Rounded buttons */
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; // Adjust the path as necessary ?>

<div class="container mt-5">
    <h1 class="text-center">Welcome to Our Website</h1>

    <h2 class="mb-4 text-center">Available Sliders</h2>

    <?php if ($hasSliders): ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php 
                $active = true; // To set the first slider as active
                while ($row = $sliders->fetch_assoc()): ?>
                    <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        </div>
                    </div>
                    <?php $active = false; // After the first item, set active to false ?>
                <?php endwhile; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            No sliders available at this time.
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="login.php" class="btn btn-primary btn-lg btn-custom">Login</a>
        <a href="register.php" class="btn btn-secondary btn-lg btn-custom">Register</a>
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
        <a href="register.php" class="btn btn-success btn-lg btn-custom mt-3">Get Started</a>
    </p>
</div>

<?php include 'footer.php'; // Adjust the path as necessary ?>

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
