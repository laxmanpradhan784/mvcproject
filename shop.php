<?php
session_start(); // Start the session

// Include necessary files
include 'config.php';
include 'anavbar.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            margin-top: 30px;
        }
        .container h1 {
            margin-top: 100px;
        }
        .product-card {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            max-width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Our Shop</h1>
    <div class="row mt-4">
        <!-- Example Product -->
        <div class="col-md-4 mb-4">
            <div class="product-card">
                <img src="path/to/product-image.jpg" alt="Product Image">
                <h2>Product Name</h2>
                <p>Product Description goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p>Price: $XX.XX</p>
                <button class="btn btn-primary btn-block">Add to Cart</button>
            </div>
        </div>
        <!-- Add more products here -->
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
