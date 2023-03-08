<?php
require 'config/database.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Sanitize the data
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    // Check if the data is valid
    if (!$firstname) {
        $_SESSION['signup'] = 'Please enter your first name';
    } elseif (!$lastname) {
        $_SESSION['signup'] = 'Please enter your last name';
    } elseif (!$username) {
        $_SESSION['signup'] = 'Please enter your username';
    } elseif (!$email) {
        $_SESSION['signup'] = 'Please enter your valid email';
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = 'Password must be at least 8 characters';
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = 'Please upload your avatar';
    } else {
        // Check if the passwords match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = 'Passwords do not match';
        } else {
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // check if the username or email already exists in the database
            $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email='$email'";
            $insert_user_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($insert_user_result) > 0) {
                $_SESSION['signup'] = 'Username or email already exists';
            } else {
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // Check if the file is an image
                $allowed_extensions = ['jpg', 'jpeg', 'png'];
                $avatar_extension = explode('.', $avatar_name);
                $avatar_extension = end($avatar_extension);

                // Check if the file size is less than 2MB
                if (in_array($avatar_extension, $allowed_extensions)) {
                    if ($avatar['size'] < 2097152) {
                        // Upload the avatar to the images folder
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = 'Avatar size must be less than 2MB';
                    }
                } else {
                    $_SESSION['signup'] = 'Avatar must be png, jpg or jpeg';
                }
            }
        }
    }

    // Check if there are any errors, if not, insert the user into the database
    if (isset($_SESSION['signup'])) {
        // Store the data in the session
        $_SESSION['signup-data'] = $_POST;
        // Redirect to signup page
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // Insert the user into the database
        $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            // Redirect to login page
            $_SESSION['signup-success'] = 'You have successfully signed up';
            header('location: ' . ROOT_URL . 'login.php');
            die();
        }
    }
} else {
    // Redirect to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
