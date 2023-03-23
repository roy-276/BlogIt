<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // Sanitize the data
    $author_id = $_SESSION['user_id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if it is not set
    $is_featured = $is_featured ? 1 : 0;

    if (!$title) {
        $_SESSION['add-post'] = 'Please enter the title';
    } elseif (!$category_id) {
        $_SESSION['add-post'] = 'Please select a category';
    } elseif (!$body) {
        $_SESSION['add-post'] = 'Please enter the body';
    } elseif (!$thumbnail) {
        $_SESSION['add-post'] = 'Please upload the thumbnail';
    } else {

        // rename the thumbnail
        $time = time();
        // make sure the thumbnail name is unique
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;


        // Check if the file is an image
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);
    }

    // display the thumbnail name
    var_dump($thumbnail_name);
}
