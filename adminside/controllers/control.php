<?php
// controllers/Control.php

// Include necessary files
include 'config.php'; // Database connection settings
include 'models/Model.php'; // Model for database interaction

class Control {
    private $model;

    // Constructor to initialize the model with a database connection
    public function __construct($connection) { // Fixing the constructor
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
                    header("location:login.php");
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
                    $_SESSION['user_id'] = $login_result['id'];
                    $_SESSION['user_fname'] = $login_result['full_name'];
                    $_SESSION['user_email'] = $login_result['email'];
                    header("location:index.php");
                } else {
                    return "Invalid password.";
                }
            } else {
                return "Email not found.";
            }
        }
    }

    // Main method to handle incoming requests
    public function handleRequest() {
        // Check if the request is a POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // If there's an update_id, update the slider; otherwise, add a new one
            if (isset($_POST['update_id'])) {
                $this->updateSlider();
            } else {
                $this->addSlider();
            }
        }
        // Check if it's a GET request to delete a slider
        elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_id'])) {
            $this->deleteSlider();
        }
    }

    // Method to add a new slider
    private function addSlider() {
        $title = $_POST['title'] ?? ''; // Get title from the form
        $status = $_POST['status'] ?? ''; // Get status from the form
        $image = $_FILES['image'] ?? null; // Get uploaded image

        if ($title && $image) { // Check if title and image are provided
            $target_dir = "../uploads/"; // Directory to store images
            $target_file = $target_dir . uniqid() . "_" . basename($image['name']); // Create a unique file name

            // Create the uploads directory if it doesn't exist
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Move the uploaded file to the target directory
            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                $this->model->addSlider($target_file, $title, $status); // Add slider to the database
            }
        }
    }

    // Method to update an existing slider
    private function updateSlider() {
        $id = $_POST['update_id']; // Get the slider ID
        $title = $_POST['title']; // Get the new title
        $status = $_POST['status']; // Get the new status
        $image = $_FILES['image'] ?? null; // Get the uploaded image

        // Get the current image from the database
        $currentImage = $this->model->getSliderImage($id);
        $target_file = $currentImage; // Default to the current image

        // If a new image is uploaded, handle the upload
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . uniqid() . "_" . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $target_file); // Move the new image
        }

        // Update the slider in the database
        $this->model->updateSlider($id, $target_file, $title, $status);
    }

    // Method to delete a slider
    private function deleteSlider() {
        $id = $_GET['delete_id']; // Get the ID of the slider to delete
        $this->model->deleteSlider($id); // Call the model to delete the slider
    }

    // Method to get all sliders
    public function getSliders() {
        return $this->model->getSliders(); // Retrieve all sliders from the database
    }
}

// Instantiate the controller and handle the request
$controller = new Control($conn);
$controller->handleRequest();
?>