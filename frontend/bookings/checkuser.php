<?php
session_start();
include("../connect/connection.php");
//search bata url ma lyayera session ma fill gardai
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
}

if (!isset($_SESSION['id'])) {
    echo "Car ID is missing.";
    exit;
}

if (isset($_SESSION['email'])) {
    header("Location:./bookcar.php");
    exit;
} else {
    $_SESSION['error'] = "Please log in first to book a car.";
    header("Location:../connect/diffsignup.php");
    exit;
}
?>