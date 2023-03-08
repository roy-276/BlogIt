<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get form data, sanitize the data and check if the data is valid
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['login'] = "Please enter your username or email";
    } elseif (!$password) {
        $_SESSION['login'] = "Please enter your password";
    } else {
        // fetch the user from the database
        $fetch_user_query = "SELECT * FROM users WHERE username = '$username_email' OR email = '$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            // convert record to an associative array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            // compare form password with database password 
            if (password_verify($password, $db_password)) {
                // set session for access control 
                $_SESSION['user-id'] = $user_record['id'];

                // set session if user is an admin 
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                // login the user and redirect to the dashboard
                header('location: ' . ROOT_URL . 'admin/');
            } else {
                $_SESSION['login'] = "Incorrect password";
            }
        } else {
            $_SESSION['login'] = "User does not exist";
        }
    }
    // if problem was encountered, redirect to the login page with login form data
    if (isset($_SESSION['login'])) {
        $_SESSION['login-data'] = $_POST;
        header('location: ' . ROOT_URL . 'login.php');
    }
} else {
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
