<?php
require 'constants.php';

// Create connection
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (mysqli_errno($connection)) {
    die(mysqli_error($connection));
}
