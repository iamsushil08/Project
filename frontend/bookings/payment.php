<?php
session_start();
include('../connect/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location:../connect/diffsignup.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id'];
    $fromloc = trim($_POST['fromloc']);
    $toloc = trim($_POST['toloc']);
    $start = $_POST['start'];  // Format: YYYY-MM-DDTHH:MM
    $end = $_POST['end'];      // Format: YYYY-MM-DDTHH:MM

    // Validate and convert datetime inputs to MySQL compatible format
    // These inputs are in the format: YYYY-MM-DDTHH:MM
    $start_datetime = date("Y-m-d H:i:s", strtotime($start)); // Convert to MySQL DATETIME format
    $end_datetime = date("Y-m-d H:i:s", strtotime($end));     // Convert to MySQL DATETIME format

    // Fetch car charge
    $query = "SELECT charge FROM cars WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $car = mysqli_fetch_assoc($result);
        $car_charge = floatval($car['charge']);
    } else {
        echo "Invalid car ID.";
        exit;
    }

    // Convert start and end datetimes to timestamps for validation
    $start_time = strtotime($start_datetime);
    $end_time = strtotime($end_datetime);

    if ($start_time >= $end_time) {
        echo "End date/time must be after the start date/time.";
        exit;
    }

    // Calculate the duration (in hours)
    $duration = ($end_time - $start_time) / 3600; 
    $totalpayment = $duration * $car_charge;
    $downpay = $totalpayment * 0.15;

    // Fetch the user ID based on the email
    $user_email = $_SESSION['email'];
    $query_user = "SELECT user_id FROM users WHERE email = '$user_email'";
    $result_user = mysqli_query($conn, $query_user);

    if (mysqli_num_rows($result_user) > 0) {
        $user = mysqli_fetch_assoc($result_user);
        $user_id = $user['user_id'];
    } else {
        echo "User not found.";
        exit;
    }

    // Insert the reservation into the database
    $payment_status = 'Pending';
    $query = "INSERT INTO reservationS (car_id, user_id, fromloc, toloc, start_time, end_time, total_payment, downpay, payment_status)
              VALUES ('$id', '$user_id', '$fromloc', '$toloc', '$start_datetime', '$end_datetime', '$totalpayment', '$downpay', '$payment_status')";

    if (mysqli_query($conn, $query)) {
        header("Location: ./finalbooking.php?success=1");
        exit;
    } else {
        echo "Error inserting reservation: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>