<?php
session_start();
include('./connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ./diffsignup.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   echo  $car_id = $_POST['car_id'];
    $car_charge = floatval($_POST['car_charge']);
    $fromloc = trim($_POST['fromloc']);
    $toloc =trim($_POST['toloc']);
    $start = $_POST['start'];
    $end = $_POST['end'];

    $start_time = strtotime($start);
    $end_time = strtotime($end);

    if ($start_time >= $end_time) {
        echo "End date/time must be after the start date/time.";
        exit;
    }

    $duration = ($end_time - $start_time) / 3600; 
    $totalpayment = $duration * $car_charge;
    $downpay = $totalpayment * 0.15;

    $_SESSION['details'] = [
        'car_id' => $car_id,
        'fromloc' => $fromloc,
        'toloc' => $toloc,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'duration' => $duration,
        'totalpayment' => $totalpayment,
        'downpay' => $downpay,
    ];

    // header("Location: ./finalbooking.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>