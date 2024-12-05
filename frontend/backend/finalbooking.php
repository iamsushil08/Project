<?php
session_start();
include('./connection.php');


if (!isset($_SESSION['email'])) {
    header("Location: ./diffsignup.php");
    exit;
}


if (!isset($_SESSION['details'])) {
    echo "No booking details found.";
    exit;
}


$details = $_SESSION['details'];
$car_id = $details['car_id'];
$fromloc = $details['fromloc'];
$toloc = $details['toloc'];
$start_time = date('Y-m-d H:i:s', $details['start_time']);
$end_time = date('Y-m-d H:i:s', $details['end_time']);
$totalpayment = $details['totalpayment'];
$downpay = $details['downpay'];

mysqli_begin_transaction($conn);

try {

    $query= "
        INSERT INTO reservations (car_id, user_email, fromloc, toloc, start_time, end_time, total_payment, downpay) 
        VALUES ('$car_id', '{$_SESSION['email']}', '$fromloc', '$toloc', '$start_time', '$end_time', '$totalpayment', '$downpay')
    ";
    if (!mysqli_query($conn, $query)) {
        throw new Exception("Error during insertion: " . mysqli_error($conn));
    }

 
    $updateduser = "
        UPDATE users 
        SET booking_count = booking_count + 1 
        WHERE email = '{$_SESSION['email']}'
    ";
    if (!mysqli_query($conn, $updateduser)) {
        throw new Exception("Error while updating : " . mysqli_error($conn));
    }


    $updatedcars = "
        UPDATE cars 
        SET status = 'Booked' 
        WHERE id = '$car_id'
    ";
    if (!mysqli_query($conn, $updatedcars)) {
        throw new Exception("Error updating car: " . mysqli_error($conn));
    }


    mysqli_commit($conn);


    unset($_SESSION['details']);


    echo "Booking confirmed successfully! Thank you for your reservation.";
} catch (Exception $e) {
    // Rollback huncha hai error aaye so imp
    mysqli_rollback($conn);
    echo "Booking failed: " . $e->getMessage();
}
?>