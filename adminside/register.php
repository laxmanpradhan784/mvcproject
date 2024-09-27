<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Registration</title>
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
        .register-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .register-container h3 {
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .btn-register {
            background-color: #343a40;
            color: white;
        }
        .btn-register:hover {
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

    <div class="register-container">
        <h3>Admin Registration</h3>
        <form>
            <!-- Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
            </div>

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

            <!-- Register Button -->
            <button type="submit" class="btn btn-register w-100">Register</button>

            <!-- Form Footer -->
            <div class="form-footer">
                <p>Already have an account? <a href="#">Login</a></p>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
