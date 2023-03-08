<?php
require 'config/constants.php';

// destroy the session and redirect to the homepage
session_destroy();
header('location: ' . ROOT_URL);
die();
