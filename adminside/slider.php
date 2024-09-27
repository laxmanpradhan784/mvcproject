<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Slider Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .slider-card {
            margin-top: 20px;
        }
        .slider-img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .slider-actions {
            margin-top: 15px;
        }
        .btn-edit {
            background-color: #ffc107;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
        }
        .form-title {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h3 class="text-center form-title">Manage Sliders</h3>

        <!-- Form to Add a New Slider -->
        <div class="card p-4 mb-4">
            <h5 class="mb-3">Add New Slider</h5>
            <form>
                <!-- Slider Title -->
                <div class="mb-3">
                    <label for="slider-title" class="form-label">Slider Title</label>
                    <input type="text" class="form-control" id="slider-title" placeholder="Enter slider title" required>
                </div>

                <!-- Slider Image Upload -->
                <div class="mb-3">
                    <label for="slider-image" class="form-label">Slider Image</label>
                    <input type="file" class="form-control" id="slider-image" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-add w-100">Add Slider</button>
            </form>
        </div>

        <!-- List of Existing Sliders -->
        <div class="card p-4">
            <h5 class="mb-3">Existing Sliders</h5>

            <!-- Example of a Single Slider -->
            <div class="row slider-card">
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/350x150" alt="Slider Image" class="slider-img">
                </div>
                <div class="col-md-8">
                    <h5>Slider Title 1</h5>
                    <p>Image description or additional slider information can go here.</p>
                    <div class="slider-actions">
                        <button class="btn btn-edit">Edit</button>
                        <button class="btn btn-delete">Delete</button>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Another Slider -->
            <div class="row slider-card">
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/350x150" alt="Slider Image" class="slider-img">
                </div>
                <div class="col-md-8">
                    <h5>Slider Title 2</h5>
                    <p>Image description or additional slider information can go here.</p>
                    <div class="slider-actions">
                        <button class="btn btn-edit">Edit</button>
                        <button class="btn btn-delete">Delete</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
