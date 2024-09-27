<?php
require_once 'models/model.php';

class control {
    private $slider;

    public function __construct($db) {
        $this->slider = new model($db);
    }

    // Add a new slider
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $image = $_FILES['image']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($image);

            // Move the uploaded file to the desired location
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $this->slider->add($title, $target_file);
                echo json_encode(['message' => 'Slider added successfully']);
            } else {
                echo json_encode(['message' => 'Failed to upload image']);
            }
        }
    }

    // Update an existing slider
    public function update() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $title = $data['title'] ?? null;
        $status = $data['status'] ?? null;

        if ($title) {
            $this->slider->updateTitle($id, $title);
        }
        if ($status) {
            $this->slider->updateStatus($id, $status);
        }

        echo json_encode(['message' => 'Slider updated successfully']);
    }

    // Delete a slider
    public function delete() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $this->slider->delete($id);
        echo json_encode(['message' => 'Slider deleted successfully']);
    }

    // Fetch all sliders
    public function getAll() {
        $sliders = $this->slider->getAll();
        echo json_encode($sliders);
    }
}
?>
