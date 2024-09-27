<?php

include("model/model.php");

class Controller
{

    // this line for register_user

    function register_user()
    {
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

                $Object = new Model;
                $registration_result = $Object->register_user($full_name, $email, $hashed_password);

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


    // this line for login_user

    function login_user()
    {
        if (isset($_REQUEST['login'])) {
            $email = trim($_REQUEST['email']);
            $password = $_REQUEST['password'];

            $Object = new Model;
            $login_result = $Object->login_user($email);

            if ($login_result) {
                $hashed_password = $login_result['password'];

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $login_result['id'];
                    $_SESSION['user_fname'] = $login_result['full_name'];
                    $_SESSION['user_email'] = $login_result['email'];
                    header("location:profile.php");
                } else {
                    return "Invalid password.";
                }
            } else {
                return "Email not found.";
            }
        }
    }

    // this line for adding_delete_update_product

    


}
?>
