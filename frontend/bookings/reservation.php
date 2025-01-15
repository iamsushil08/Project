<?php
session_start();
include '../connect/connection.php';

// Check if the user is logged in (via email stored in session)
if (!isset($_SESSION['email'])) {
    header('Location:../index.php');  // Redirect to login page if not logged in
    exit;
}

// Get the user's email from session
$email = $_SESSION['email'];

// Retrieve the user_id using the email
$query = "SELECT user_id FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    // Output SQL error if the query fails
    die("Error executing query: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

if ($user) {
    $user_id = $user['user_id'];
} else {
    echo "User not found.";
    exit;
}

// Query to fetch all reservations for the logged-in user
$query_reservations = "SELECT * FROM reservations WHERE user_id = '$user_id' ORDER BY start_time ASC";
$result_reservations = mysqli_query($conn, $query_reservations);

// Check if the query was successful
if (!$result_reservations) {
    // Output SQL error if the query fails
    die("Error executing query: " . mysqli_error($conn));
}

// Split reservations into current and past based on start time
$current_reservations = [];
$past_reservations = [];
$current_time = date('Y-m-d H:i:s'); // Get current date and time

while ($reservation = mysqli_fetch_assoc($result_reservations)) {
    if ($reservation['start_time'] >= $current_time) {
        $current_reservations[] = $reservation; // Future or current booking
    } else {
        $past_reservations[] = $reservation; // Past booking
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        padding: 20px;
    }

    .reservation-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .reservation-table th,
    .reservation-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .reservation-table th {
        background-color: #4CAF50;
        color: white;
    }

    .reservation-table td {
        text-align: center;
    }

    .message {
        color: red;
        text-align: center;
    }
    </style>
</head>

<body>

    <h2>My Reservations</h2>

    <!-- Current Reservations Section -->
    <?php if (empty($current_reservations)): ?>
    <div class="message">You have no current bookings.</div>
    <?php else: ?>
    <h3>Current Bookings</h3>
    <table class="reservation-table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Payment</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($current_reservations as $reservation): ?>
            <tr>
                <td><?php echo $reservation['fromloc']; ?></td>
                <td><?php echo $reservation['toloc']; ?></td>
                <td><?php echo $reservation['start_time']; ?></td>
                <td><?php echo $reservation['end_time']; ?></td>
                <td><?php echo $reservation['total_payment']; ?></td>
                <td><?php echo $reservation['payment_status']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <!-- Past Reservations Section -->
    <?php if (empty($past_reservations)): ?>
    <div class="message">You have no past bookings.</div>
    <?php else: ?>
    <h3>Past Bookings</h3>
    <table class="reservation-table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Payment</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($past_reservations as $reservation): ?>
            <tr>
                <td><?php echo $reservation['fromloc']; ?></td>
                <td><?php echo $reservation['toloc']; ?></td>
                <td><?php echo $reservation['start_time']; ?></td>
                <td><?php echo $reservation['end_time']; ?></td>
                <td><?php echo $reservation['total_payment']; ?></td>
                <td><?php echo $reservation['payment_status']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <div style='position: fixed; bottom: 12px; left: 10px;'>
        <a href="../index.php"
            style="text-decoration: none; padding: 10px 10px; background-color: #C45946; color: white; border-radius:6px;">Go
            Back</a>
    </div>

</body>

</html>