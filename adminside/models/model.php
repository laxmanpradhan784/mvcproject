<?php
// models/Model.php

class Model {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

     // Login user method (SELECT query)
     public function login_user($email) {
        $query = "SELECT * FROM admin WHERE email = '$email'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc(); // Fetch and return user data
    }

    // Register user method (INSERT query)
    public function register_user($full_name, $email, $hashed_password) {
        $query = "INSERT INTO admin (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')";
        return $this->conn->query($query); // Returns true on success
    }
    
    public function addSlider($image, $title, $status) {
        $query = "INSERT INTO sliders (image, title, status) VALUES ('$image', '$title', '$status')";
        return $this->conn->query($query); // Return the result directly
    }

    public function getSliders() {
        return $this->conn->query("SELECT * FROM sliders ORDER BY id DESC"); // Return the result directly
    }

    public function updateSlider($id, $image, $title, $status) {
        $query = "UPDATE sliders SET image = '$image', title = '$title', status = '$status' WHERE id = $id";
        return $this->conn->query($query); // Return the result directly
    }

    public function deleteSlider($id) {
        $query = "DELETE FROM sliders WHERE id = $id";
        return $this->conn->query($query); // Return the result directly
    }

    public function getSliderImage($id) {
        $result = $this->conn->query("SELECT image FROM sliders WHERE id = $id");
        return $result ? $result->fetch_assoc()['image'] : null; // Return the image or null
    }

    public function getSlider() {
        return $this->conn->query("SELECT * FROM sliders WHERE status = 'active' ORDER BY id DESC"); // Return the result directly
    }

    public function registerUser($full_name, $email, $hashed_password) {
        $query = "INSERT INTO admin (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')";
        return $this->conn->query($query); // Return the result directly
    }

    public function loginUser($email) {
        $result = $this->conn->query("SELECT * FROM admin WHERE email = '$email'");
        return $result ? $result->fetch_assoc() : null; // Return user data or null
    }

    public function fetchProducts() {
        return $this->conn->query("SELECT * FROM products"); // Return the result directly
    }

    public function getProduct($id) {
        $result = $this->conn->query("SELECT * FROM products WHERE id = $id");
        return $result ? $result->fetch_assoc() : null; // Return product data or null
    }

    public function addProduct($name, $description, $price, $image, $status) {
        $query = "INSERT INTO products (name, description, price, image, status) VALUES ('$name', '$description', $price, '$image', '$status')";
        return $this->conn->query($query); // Return the result directly
    }

    public function updateProduct($id, $name, $description, $price, $image = null, $status) {
        $query = "UPDATE products SET name = '$name', description = '$description', price = $price, status = '$status'" .
                 ($image ? ", image = '$image'" : "") . " WHERE id = $id";
        return $this->conn->query($query); // Return the result directly
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = $id";
        return $this->conn->query($query); // Return the result directly
    }

    public function getProducts() {
        $result = $this->conn->query("SELECT id, name, description, price, status, image FROM products WHERE status = 'active'");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : []; // Fetching as an associative array
    }
}
?>
