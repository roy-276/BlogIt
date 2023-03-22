<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    // get the id from the url and sanitize it
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // delete the category from the database
    $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);
    $_SESSION['delete-category-success'] = 'Category deleted successfully';
}

// redirect to the manage categories page
header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
