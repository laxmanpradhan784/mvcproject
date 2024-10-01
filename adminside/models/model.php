<?php
// models/Model.php

class Model {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function addSlider($image, $title, $status) {
        $stmt = $this->conn->prepare("INSERT INTO sliders (image, title, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $image, $title, $status);
        return $stmt->execute(); // Return the result directly
    }

    public function getSliders() {
        return $this->conn->query("SELECT * FROM sliders ORDER BY id DESC"); // Return the result directly
    }

    public function updateSlider($id, $image, $title, $status) {
        $stmt = $this->conn->prepare("UPDATE sliders SET image = ?, title = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssi", $image, $title, $status, $id);
        return $stmt->execute(); // Return the result directly
    }

    public function deleteSlider($id) {
        $stmt = $this->conn->prepare("DELETE FROM sliders WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute(); // Return the result directly
    }

    public function getSliderImage($id) {
        $stmt = $this->conn->prepare("SELECT image FROM sliders WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc()['image'] : null; // Return the image or null
    }

    public function getSlider() {
        return $this->conn->query("SELECT * FROM sliders WHERE status = 'active' ORDER BY id DESC"); // Return the result directly
    }

    public function registerUser($full_name, $email, $hashed_password) {
        $stmt = $this->conn->prepare("INSERT INTO admin (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $hashed_password);
        return $stmt->execute(); // Return the result directly
    }

    public function loginUser($email) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null; // Return user data or null
    }

    // Fetch all products
    public function fetchProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : []; // Return array of products or empty array
    }

    // Fetch a single product by ID
    public function getProduct($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null; // Return product data or null
    }

    // Add a new product
    public function addProduct($name, $description, $price, $image, $status) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, description, price, image, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $name, $description, $price, $image, $status);
        return $stmt->execute(); // Return the result directly
    }

    // Update an existing product
    public function updateProduct($id, $name, $description, $price, $image = null, $status) {
        $query = "UPDATE products SET name = ?, description = ?, price = ?, status = ?" . ($image ? ", image = ?" : "") . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        if ($image) {
            $stmt->bind_param("ssdssi", $name, $description, $price, $status, $image, $id);
        } else {
            $stmt->bind_param("ssdsi", $name, $description, $price, $status, $id);
        }
        
        return $stmt->execute(); // Return the result directly
    }

    // Delete a product
    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute(); // Return the result directly
    }
    public function getProducts() {
        $result = mysqli_query($this->conn, "SELECT id, name, description, price, status, image FROM products WHERE status = 'active'");
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetching as an associative array
    }
    
}
?>
