<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connection.php';

    $model = $_POST['model'];
    $brand = $_POST['brand'];
    $year = $_POST['year'];
    $price_per_day = $_POST['price_per_day'];
    $availability = 'available';

    $query = "INSERT INTO cars (model, brand, year, price_per_day, availability)
              VALUES ('$model', '$brand', '$year', '$price_per_day', '$availability')";

    if (mysqli_query($conn, $query)) {
        echo "Car added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}