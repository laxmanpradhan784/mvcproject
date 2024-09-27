<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php"); // Redirect to profile if logged in
    exit();
}

include("controller/control.php");

$ob = new Controller;
$error_msg = $ob->register_user();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            margin-top: 30px;
        }

        .container h1 {
            margin-top: 100px;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">Create an Account</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($error_msg)): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo  ($error_msg); ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="full_name" placeholder="Enter your full name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="login.php" class="text-primary">Log in</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>