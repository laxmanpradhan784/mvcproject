<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h3 {
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .btn-login {
            background-color: #343a40;
            color: white;
        }
        .btn-login:hover {
            background-color: #495057;
        }
        .form-footer {
            text-align: center;
            margin-top: 20px;
        }
        .form-footer a {
            color: #495057;
            text-decoration: none;
        }
        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h3>Admin Login</h3>
        <form>
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-login w-100">Login</button>
            
            <!-- Form Footer -->
            <div class="form-footer">
                <p><a href="#">Forgot Password?</a></p>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
