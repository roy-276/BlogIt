<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // sanitize the data 
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // check if the form data is valid 
    if (!$title || !$description) {
        $_SESSION['edit-category'] = 'Please fill in all the fields';
    } else {
        // update the category in the database 
        $query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        // check if the query was successful 
        if (mysqli_errno($connection)) {
            $_SESSION['edit-category'] = 'There was an error updating the category';
        } else {
            $_SESSION['edit-category-success'] = "Category $title was updated successfully";
        }
    }
}

// redirect the user to the manage categories page
header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
