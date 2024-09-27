<?php

include("models/model.php");

class Control
{
    private $model;

    function __construct()
    {
        $this->model = new Model();
    }

    function add_slider()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $title = $_POST['title'];
            $image = $_FILES['image']['name'];
            $target_dir = "uploads/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $target_file = $target_dir . basename($image);

            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo 'Error uploading image';
                exit;
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $this->model->add($title, $target_file);
                echo 'Image uploaded successfully with title: ' . ($title);
            } else {
                echo 'Failed to upload image';
            }
        } else {
            echo 'No image uploaded';
        }
    }
}
?>