<?php
require '../partials/header.php';

// check login status and redirect to the login page if not logged in
if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'login.php');
    die();
}
