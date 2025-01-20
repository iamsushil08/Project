<?php
session_start();
include('../connect/connection.php');

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location:../connect/diffsignup.php");
    exit;
}

$user_email = $_SESSION['email'];

// Fetch the user_id from the users table using the email
$query_user = "SELECT user_id FROM users WHERE email = '$user_email'";
$result_user = mysqli_query($conn, $query_user);
if (!$result_user) {
    echo "Error fetching user: " . mysqli_error($conn);
    exit;
}
$user = mysqli_fetch_assoc($result_user);
$user_id = $user['user_id'];

// Fetch the latest reservation where payment_status is 'pending'
$query = "SELECT r.*, c.id AS car_id FROM reservationS r INNER JOIN cars c ON r.car_id = c.id WHERE r.user_id = '$user_id' AND r.payment_status = 'pending' ORDER BY r.id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Error fetching reservation: " . mysqli_error($conn);
    exit;
}
$details = mysqli_fetch_assoc($result);

if ($details) {
    $car_id = $details['car_id'];

    // Update car status to 'booked'
    $update_car_query = "UPDATE cars SET status = 'booked' WHERE id = '$car_id'";
    if (!mysqli_query($conn, $update_car_query)) {
        echo "Error updating car status: " . mysqli_error($conn) . "<br>";
        exit; // Exit if there's an error
    }

    // Increase the booking count for the user
    $update_user_query = "UPDATE users SET booking_count = booking_count + 1 WHERE user_id = '$user_id'";
    if (!mysqli_query($conn, $update_user_query)) {
        echo "Error updating user booking count: " . mysqli_error($conn) . "<br>";
        exit; // Exit if there's an error
    }

    // Redirect to index.php after the updates
    echo "<script>window.location.href = '../index.php';</script>";
} else {
    echo "No pending booking found for this user.";
}
?>