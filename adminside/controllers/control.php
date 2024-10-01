<?php
// controllers/Control.php

// Include necessary files
include 'config.php'; // Database connection settings
include 'models/Model.php'; // Model for database interaction

class Control {
    private $model;

    public function __construct($connection) {
        $this->model = new Model($connection);
    }

    function register_admin() {
        if (isset($_REQUEST['register'])) {
            $full_name = trim($_REQUEST['full_name']);
            $email = trim($_REQUEST['email']);
            $password = $_REQUEST['password'];
            $error_msg = "";

            if (empty($full_name) || empty($email) || empty($password)) {
                $error_msg = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_msg = "Invalid email format.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $registration_result = $this->model->register_user($full_name, $email, $hashed_password);

                if ($registration_result) {
                    header("Location: login.php");
                    exit;
                } else {
                    $error_msg = "Registration failed!";
                }
            }

            return $error_msg;
        }
    }

    function login_admin() {
        if (isset($_REQUEST['login'])) {
            $email = trim($_REQUEST['email']);
            $password = $_REQUEST['password'];
            $login_result = $this->model->login_user($email);

            if ($login_result) {
                $hashed_password = $login_result['password'];

                if (password_verify($password, $hashed_password)) {
                    // Store user information in session variables
                    $_SESSION['admin_id'] = $login_result['id'];
                    $_SESSION['admin_fname'] = $login_result['full_name'];
                    $_SESSION['admin_email'] = $login_result['email'];
                    header("Location: index.php");
                    exit;
                } else {
                    return "Invalid password.";
                }
            } else {
                return "Email not found.";
            }
        }
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['update_id'])) {
                $this->updateSlider();
            } else {
                $this->addSlider();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
            $message = $this->deleteSlider();
            return $message; // Return message instead of redirecting
        }
    }

    private function addSlider() {
        $title = $_POST['title'] ?? '';
        $status = $_POST['status'] ?? '';
        $image = $_FILES['image'] ?? null;

        if ($title && $image && $image['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . uniqid() . "_" . basename($image['name']);

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                if ($this->model->addSlider($target_file, $title, $status)) {
                    header("Location: slider.php");
                    exit;
                } else {
                    return "Failed to add slider.";
                }
            } else {
                return "Failed to upload image.";
            }
        }
        return "Title and image are required.";
    }

    private function updateSlider() {
        $id = $_POST['update_id'];
        $title = $_POST['title'] ?? '';
        $status = $_POST['status'] ?? '';
        $image = $_FILES['image'] ?? null;

        $currentImage = $this->model->getSliderImage($id);
        $target_file = $currentImage;

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . uniqid() . "_" . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $target_file);
        }

        if ($this->model->updateSlider($id, $target_file, $title, $status)) {
            header("Location: slider.php");
            exit;
        } else {
            return "Failed to update slider.";
        }
    }

    private function deleteSlider() {
        $id = $_GET['delete_id'];
        if ($this->model->deleteSlider($id)) {
            return "Slider deleted successfully."; // Return a message instead of redirecting
        }
        return "Failed to delete slider.";
    }

    public function getSliders() {
        return $this->model->getSliders();
    }

    public function getProducts() {
        return $this->model->fetchProducts();
    }

    public function getProductById($id) {
        return $this->model->getProduct($id);
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $status = $_POST['status'] ?? '';
            $image = $_FILES['image'] ?? null;
    
            // Handle image upload
            $uploadedImage = $this->handleImageUpload($image);
            if ($uploadedImage !== false) {
                if ($this->model->addProduct($name, $description, $price, $uploadedImage, $status)) {
                    // Set a success message in session
                    $_SESSION['success_message'] = "Product added successfully.";
                    header("Location: product.php"); // Redirect to the product page
                    exit();
                }
            }
            // Set an error message in session
            $_SESSION['error_message'] = "Error adding product.";
            header("Location: product.php"); // Redirect to the product page
            exit();
        }
    }
    

    public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['edit_id'];
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $status = $_POST['status'] ?? '';
            $image = $_FILES['image'] ?? null;

            // Handle image upload
            $uploadedImage = $this->handleImageUpload($image);
            if ($this->model->updateProduct($id, $name, $description, $price, $uploadedImage, $status)) {
                return "Product updated successfully.";
            }
            return "Error updating product.";
        }
    }

    public function deleteProduct($id) {
        if ($this->model->deleteProduct($id)) {
            return "Product deleted successfully.";
        }
        return "Error deleting product.";
    }

    public function editProduct($id) {
        $product = $this->model->getProduct($id);
        if ($product) {
            return $product;
        }
        return "Product not found.";
    }

    private function handleImageUpload($image) {
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadedImageName = basename($image['name']);
            move_uploaded_file($image['tmp_name'], $uploadDir . $uploadedImageName);
            return $uploadedImageName;
        }
        return false; // Indicates no upload or an error
    }
}

// Instantiate the controller and handle the request
$controller = new Control($conn);
$controller->handleRequest();
?>
