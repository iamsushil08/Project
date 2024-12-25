<?php
session_start();
include('../connect/connection.php');

if (!isset($_SESSION['email']) && ! isset($_SESSION['id'])) {
    echo("Session variables are not set.");
}

$userEmail = $_SESSION['email'];
$carId = $_SESSION['id'];

$sql = "UPDATE users SET booking_count = booking_count + 1 WHERE email = '$userEmail'";
$result= mysqli_query($conn,$sql);
if (!($result)) {
    die("Error updating users table: " . mysqli_error($conn));
}

$sql = "UPDATE cars SET status = 'booked' WHERE id = $carId";
$resultt= mysqli_query($conn,$sql);
if (!($resultt)) {
    die("Error updating cars table: " . mysqli_error($conn));
}

$sql = "UPDATE reservations SET payment_status = 'paid' WHERE car_id = $carId";
$rresult= mysqli_query($conn,$sql);
if (!($rresult)) {
    die("Error updating reservation table: " . mysqli_error($conn));
}

mysqli_close($conn);
header("Location:../index.php");
exit();
?>