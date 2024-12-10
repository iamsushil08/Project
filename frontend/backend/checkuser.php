<?php
session_start();
include('./connection.php');
//search bata url ma lyayera session ma fill gardai
if (isset($_GET['car_id'])) {
    $_SESSION['car_id'] = $_GET['car_id'];
}

if (!isset($_SESSION['car_id'])) {
    echo "Car ID is missing.";
    exit;
}

if (isset($_SESSION['email'])) {
    header("Location: bookcar.php");
    exit;
} else {
    $_SESSION['error'] = "Please log in first to book a car.";
    header("Location: diffsignup.php");
    exit;
}
?>