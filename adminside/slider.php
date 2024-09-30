<?php
// views/slider.php

include 'controllers/Control.php';

$controller = new Control($conn);
$sliders = $controller->getSliders();

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_id'])) {
    // Handle update logic in Control
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sliders Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background: linear-gradient(135deg, #ff7e5f, #feb47b); /* Example gradient colors */
        color: #fff; /* Change text color for better visibility */
    }

    .slider-image {
        width: 100px; /* Fixed width for images */
        height: auto;
        object-fit: cover; /* Keeps aspect ratio */
    }
    
    .action-buttons {
        display: flex;
        gap: 10px; /* Space between buttons */
    }

    .container {
        background: rgba(0, 0, 0, 0.5); /* Semi-transparent background for better readability */
        padding: 20px;
        border-radius: 10px;
    }

    h1, h2 {
        color: #fff; /* Ensures headings are visible against the gradient */
    }
</style>

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center text-primary">Sliders</h1>

        <?php if ($successMessage): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <h2>Add New Slider</h2>
        <form method="post" enctype="multipart/form-data" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Slider</button>
        </form>

        <h2>Existing Sliders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $srno = 1;
            while ($row = $sliders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $srno++; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" class="slider-image"></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <!-- Update Form -->
                        <form method="post" enctype="multipart/form-data" class="d-inline">
                            <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="title" value="<?php echo $row['title']; ?>" required class="form-control mb-2" style="display: inline-block; width: auto;">
                            <select name="status" class="form-control mb-2" style="display: inline-block; width: auto;">
                                <option value="active" <?php echo $row['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $row['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                            <input type="file" name="image" accept="image/*" class="form-control mb-2" style="display: inline-block; width: auto;">
                            <div class="action-buttons">
                                <button type="submit" class="btn btn-warning mt-2">Update</button>
                            </div>
                        </form>

                        <!-- Delete Form -->
                        <form method="get" class="d-inline">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
