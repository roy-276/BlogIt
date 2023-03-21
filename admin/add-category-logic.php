<?php
require 'config/database.php';

// get the form data from the session if invalid form data was submitted
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESION['add-category-data']['description'] ?? null;

// unset the session variable
unset($_SESSION['add-category-data']);

if (isset($_POST['submit'])) {

    // get updated form data and sanitize them
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$title) {
        $_SESSION['add-category'] = 'Please enter a category title';
    } elseif (!$description) {
        $_SESSION['add-category'] = 'Please enter a category description';
    }

    // redirect to the add category page with form data if the form is not submitted
    if (isset($_SESSION['add-category'])) {
        // save the form data in the session
        $_SESSION['add-category-data'] = $_POST;
        header("location: " . ROOT_URL . "admin/add-category.php");
        die();
    } else {
        // insert the category into the database 
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);

        // check if the query was successful 
        if (mysqli_errno($connection)) {
            $_SESSION['add-category'] = 'Error adding category to the database';
            header("location: " . ROOT_URL . "admin/add-category.php");
            die();
        } else {
            $_SESSION['add-category-success'] = "Category $title was added successfully";
            header("location: " . ROOT_URL . "admin/manage-categories.php");
            die();
        }
    }
}
