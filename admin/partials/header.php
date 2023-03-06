<?php
require 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BlogIt</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css" />

    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <!-- Google Fonts Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Nav starts here -->
    <nav>
        <div class="container nav_container">
            <a href="<?= ROOT_URL ?>" class="nav_logo">BlogIt</a>
            <ul class="nav_items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <li><a href="<?= ROOT_URL ?>signin.php">SignIn</a></li>
                <li class="nav_profile">
                    <div class="avatar">
                        <img src="./images/avatar11.jpg" />
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>

            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!-- Nav ends here -->