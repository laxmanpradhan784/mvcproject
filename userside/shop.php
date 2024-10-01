<?php
session_start();
include 'config.php';
include '../adminside/models/Model.php'; // Adjust the path as necessary

// Instantiate the Product model and controller
$model = new Model($connection);
$products = $model->getProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-primary">

<?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Product List</h1>

        <!-- Product List -->
        <div class="row">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <?php if ($product['status'] === 'active'): // Show only active products ?>
                        <div class="col-md-4 mb-4"> <!-- 3 products per row -->
                            <div class="card">
                                <img src="../adminside/uploads/<?php echo $product['image']; ?>"
                                    class="card-img-top"
                                    alt="<?php echo $product['name']; ?>"
                                    onerror="this.onerror=null; this.src='../uploads/fallback.jpg';"> <!-- Fallback image -->
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                    <p class="card-text"><?php echo $product['description']; ?></p>
                                    <p class="card-text"><strong>Price: $<?php echo number_format($product['price'], 2); ?></strong></p>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p>No products available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
