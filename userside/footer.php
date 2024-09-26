<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for the footer */
        html,
        body {
            height: 100%;
            /* Ensure the body takes up the full height */
        }

        body {
            display: flex;
            flex-direction: column;
            /* Stack content vertically */
        }

        .footer {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 20px 0;
            margin-top: auto;
            /* Pushes the footer to the bottom */
        }

        .footer a {
            color: #f8f9fa;
        }

        .content {
            flex: 1;
            /* Takes up remaining space */
        }
    </style>
</head>

<body>

    <div class="content">
        <!-- Your page content goes here -->
    </div>

    <footer class="footer">
        <div class="container">

            <div class="text-center">
                <p>&copy; <?php echo date("Y"); ?> My Website. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>