<?php
require 'config/database.php';

// Check if the form is submitted else redirect to the manage users page
if (isset($_POST['submit'])) {
    // get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // check if the input is valid
    if (!$firstname || !$lastname) {
        $_SESSION['edit-user'] = 'Invalid form input on edit user page';
    } else {
        // update the user in the database limit to 1 user only to be updated
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        // check if the query was successful 
        if (mysqli_errno($connection)) {
            $_SESSION['edit-user'] = 'Error updating user in the database';
        } else {
            $_SESSION['edit-user-success'] = "User $firstname $lastname was updated successfully";
        }
    }
}

// redirect to the manage users page
header("location: " . ROOT_URL . "admin/manage-users.php");
