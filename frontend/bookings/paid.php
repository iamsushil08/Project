<?php
session_start();
include('../connect/connection.php');

if (!isset($_SESSION['user_email']) && !isset($_SESSION['id'])) {
    die("Session variables are not set.");
}

$userEmail = $_SESSION['user_email'];
$carId = $_SESSION['id'];

$sql = "UPDATE users SET booking_count = booking_count + 1 WHERE email = '$userEmail'";
if (!mysqli_query($conn, $sql)) {
    die("Error updating users table: " . mysqli_error($conn));
}

$sql = "UPDATE cars SET status = 'booked' WHERE id = $carId";
if (!mysqli_query($conn, $sql)) {
    die("Error updating cars table: " . mysqli_error($conn));
}

$sql = "UPDATE reservations SET payment_status = 'paid' WHERE car_id = $carId";
if (!mysqli_query($conn, $sql)) {
    die("Error updating reservation table: " . mysqli_error($conn));
}

mysqli_close($conn);
header("Location:../index.php");
exit();
?>