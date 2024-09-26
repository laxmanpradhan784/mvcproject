<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar,
        .footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            margin-top: 100px;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="content">
    <h1>Profile Page</h1>
    <p>Welcome to your profile, <?php echo $_SESSION['user_fname']; ?>!</p>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
