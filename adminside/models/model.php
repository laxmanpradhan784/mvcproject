<?php
class Model
{
    private $connection;

    // Constructor to initialize the database connection
    function __construct()
    {
        include("config.php"); // Ensure this file sets up the connection
        $this->connection = $connection; // Set the connection variable
    }

    // Function to add a slider entry into the database
    function add($title, $image_path)
    {
        // Create the SQL query
        $query = "INSERT INTO sliders (title, image) VALUES ('$title', '$image_path')";
        return mysqli_query($this->connection, $query); // Execute the query

    }


    function show_slider($title, $image_past)
    {

        $query = "SELECT * FROM sliders WHERE title = '$title' , image = '$image_past'";
        return mysqli_query($this->connection, $query); // Execute the query
        return mysqli_fetch_assoc($result); // Fetch the user data
    }

}

?>
