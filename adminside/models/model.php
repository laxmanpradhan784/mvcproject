<?php
// models/Model.php

class Model {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function addSlider($image, $title, $status) {
        $query = "INSERT INTO sliders (image, title, status) VALUES ('$image', '$title', '$status')";
        return $this->conn->query($query);
    }

    public function getSliders() {
        return $this->conn->query("SELECT * FROM sliders ORDER BY id DESC");
    }

    public function updateSlider($id, $image, $title, $status) {
        $query = "UPDATE sliders SET image = '$image', title = '$title', status = '$status' WHERE id = $id";
        return $this->conn->query($query);
    }

    public function deleteSlider($id) {
        $query = "DELETE FROM sliders WHERE id = $id";
        return $this->conn->query($query);
    }

    public function getSliderImage($id) {
        $query = "SELECT image FROM sliders WHERE id = $id";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_assoc()['image'] : null;
    }

    public function getSlider() {
        $query = "SELECT * FROM sliders WHERE status = 'active' ORDER BY id DESC";
        return $this->conn->query($query);
    }

     // Register a new user
     public function register_user($full_name, $email, $hashed_password)
     {
         $query = "INSERT INTO admin (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')";
         return mysqli_query($this->conn, $query); // Execute the query
     }
 
     // Fetch user data for login
     public function login_user($email)
     {
         $query = "SELECT * FROM admin WHERE email = '$email'";
         $result = mysqli_query($this->conn, $query);
         return mysqli_fetch_assoc($result); // Fetch the user data
     }
}
?>
