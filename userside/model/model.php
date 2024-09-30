<?php
class Model
{
    private $connection;

    function __construct()
    {
        include("config.php"); // Ensure this file establishes the connection
        $this->connection = $connection; // Set the connection variable
    }

    // Register a new user
    function register_user($full_name, $email, $hashed_password)
    {
        $query = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')";
        return mysqli_query($this->connection, $query); // Execute the query
    }

    // Fetch user data for login
    function login_user($email)
    {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_assoc($result); // Fetch the user data
    }

    
    
}
?>