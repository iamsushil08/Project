<?php
session_start();
include("connection.php");

// Retrieve user ID from the session
$userid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Get car ID and extra charge from URL parameters
$carid = isset($_GET['carid']) ? intval($_GET['carid']) : null;
$extra_charge = isset($_GET['extra_charge']) ? floatval($_GET['extra_charge']) : 0;

// Check if user is logged in
if (!$userid) {
    // Redirect to signup.html if user is not logged in
    header("Location: signup.html?carid=$carid&extra_charge=$extra_charge");
    exit();
}

// Validate the user ID
$user_check_query = "SELECT * FROM users WHERE id = '$userid'";
$user_result = mysqli_query($conn, $user_check_query);

if (mysqli_num_rows($user_result) == 0) {
    // Redirect to signup.html if user ID is not found
    header("Location: signup.html?carid=$carid&extra_charge=$extra_charge");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $carid) {
    $locationfrom = $_POST['locationfrom'];
    $locationto = $_POST['locationto'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $start = strtotime($starttime);
    $end = strtotime($endtime);
    $hours = ($end - $start) / 3600;

    $universal_price = 200; // Set the universal price
    $total_payment = ($universal_price + ($extra_charge * $hours)); // Calculate total payment

    // Prepare and execute booking insertion
    $query = "INSERT INTO bookings (userid, carid, locationfrom, locationto, starttime, endtime, bookingdate) 
              VALUES ('$userid', '$carid', '$locationfrom', '$locationto', '$starttime', '$endtime', CURDATE())";

    if (mysqli_query($conn, $query)) {
        echo "Booking confirmed successfully!<br>";
        echo "Total Payment: $" . number_format($total_payment, 2); // Format payment

        // Redirect to payment page with user ID, car ID, and total payment
        header("Location: payment.php?userid=$userid&carid=$carid&total_payment=$total_payment");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Handle query error
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
</head>

<body>

    <?php if ($userid && $carid): ?>
    <form method="POST" action="">
        <label for="locationfrom">Location From:</label>
        <input type="text" id="locationfrom" name="locationfrom" required>
        <br><br>

        <label for="locationto">Location To:</label>
        <input type="text" id="locationto" name="locationto" required>
        <br><br>

        <label for="starttime">Start Date and Time:</label>
        <input type="datetime-local" id="starttime" name="starttime" required>
        <br><br>

        <label for="endtime">End Date and Time:</label>
        <input type="datetime-local" id="endtime" name="endtime" required>
        <br><br>

        <button type="submit" name="confirm">Confirm Booking</button>
    </form>
    <?php else: ?>
    <p>User or car information is missing. Please try again.</p>
    <?php endif; ?>

</body>

</html>