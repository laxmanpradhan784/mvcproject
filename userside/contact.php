<?php

include("controller/control.php");

$controller = new Controller();
$messageResult = []; // Array to hold success and error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageResult = $controller->addContact();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .header-image {
            background-image: url('https://via.placeholder.com/1200x300'); /* Replace with your image URL */
            background-size: cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .container {
            margin-top: -150px; /* Pull the form up over the image */
            z-index: 2;
            position: relative;
        }
        .form-control, .btn {
            border-radius: 0.5rem;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="header-image">
    <h1>Contact Us</h1>
</div>

<div class="container mt-1 mb-5">
    <?php if (!empty($messageResult['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($messageResult['error']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($messageResult['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($messageResult['success']); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
