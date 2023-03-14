<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    // sanitize the id
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch the user from the database
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure only one user is fetched
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        // delete image if it exists
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    // delete the user from the database
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "There was an error deleting the {$user['firstname']} {$user['lastname']}. Please try again";
    } else {
        $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} deleted successfully";
    }
}

// redirect to the manage users page
header('localhost: ' . ROOT_URL . 'admin/manage-users.php');
die();
