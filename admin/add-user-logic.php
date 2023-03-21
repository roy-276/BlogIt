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
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    // Check if the data is valid
    if (!$firstname) {
        $_SESSION['add-user'] = 'Please enter your first name';
    } elseif (!$lastname) {
        $_SESSION['add-user'] = 'Please enter your last name';
    } elseif (!$username) {
        $_SESSION['add-user'] = 'Please enter your username';
    } elseif (!$email) {
        $_SESSION['add-user'] = 'Please enter your valid email';
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = 'Password must be at least 8 characters';
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = 'Please upload your avatar';
    } else {
        // Check if the passwords match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = 'Passwords do not match';
        } else {
            // Hash the password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // check if the username or email already exists in the database
            $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email='$email'";
            $insert_user_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($insert_user_result) > 0) {
                $_SESSION['add-user'] = 'Username or email already exists';
            } else {
                // rename the avatar 
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

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
                        $_SESSION['add-user'] = 'Avatar size must be less than 2MB';
                    }
                } else {
                    $_SESSION['add-user'] = 'Avatar must be png, jpg or jpeg';
                }
            }
        }
    }

    // Check if there are any errors, if not, insert the user into the database
    if (isset($_SESSION['add-user'])) {
        // Store the data in the session
        $_SESSION['add-user-data'] = $_POST;
        // Redirect to add-user page
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        // Insert the user into the database
        $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=$is_admin";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            // redirect to manage-users page with a success message
            $_SESSION['add-user-success'] = "$firstname $lastname added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
} else {
    // if the form is not submitted, redirect to add-user page  
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
