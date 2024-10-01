<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';
include 'controllers/Control.php';

// Instantiate the Product model and controller
$controller = new Control($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_id'])) {
        $message = $controller->updateProduct();
    } else {
        $message = $controller->addProduct();
    }
}

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $message = $controller->deleteProduct((int)$_GET['delete_id']);
}

// Fetch all products
$products = $controller->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center">Product Management</h1>

    <!-- Add Product Form -->
    <h2>Add Product</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" class="form-control" required step="0.01">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>

    <!-- Product List -->
    <h2>Product List</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $srno = 1;
            foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $srno++; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td>₹<?php echo $product['price']; ?></td>
                    <td><?php echo $product['status']; ?></td>
                    <td><img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 100px;"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8'); ?>)">Edit</button>
                        <a href="?delete_id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_name">Product Name:</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description:</label>
                        <textarea id="edit_description" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_price">Price:</label>
                        <input type="number" id="edit_price" name="price" class="form-control" required step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status:</label>
                        <select id="edit_status" name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_image">Image:</label>
                        <input type="file" id="edit_image" name="image" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitEditForm()">Update Product</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal(product) {
        $('#edit_id').val(product.id);
        $('#edit_name').val(product.name);
        $('#edit_description').val(product.description);
        $('#edit_price').val(product.price);
        $('#edit_status').val(product.status);
        $('#editProductModal').modal('show');
    }

    function submitEditForm() {
        $('#editProductForm').submit();
    }
</script>

</body>
</html>
