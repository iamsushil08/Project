<?php
session_start();
include("connection.php");

$userid = isset($_GET['userid']) ? $_GET['userid'] : null;
$carid = isset($_GET['carid']) ? $_GET['carid'] : null;
$extra_charge = isset($_GET['extra_charge']) ? $_GET['extra_charge'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $userid && $carid) {
    $locationfrom = $_POST['locationfrom'];
    $locationto = $_POST['locationto'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $start = strtotime($starttime);
    $end = strtotime($endtime);
    $hours = ($end - $start) / 3600;

    $universal_price = 200;
    $total_payment = ($universal_price + ($extra_charge * $hours));

    $query = "INSERT INTO bookings (userid, carid, locationfrom, locationto, starttime, endtime, bookingdate) 
              VALUES ('$userid', '$carid', '$locationfrom', '$locationto', '$starttime', '$endtime', CURDATE())";
    
    if (mysqli_query($conn, $query)) {
        echo "Booking confirmed successfully!<br>";
        echo "Total Payment: $" . $total_payment;
    } else {
        echo "Error: " . mysqli_error($conn);
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
    <form method="POST"
        action="?userid=<?php echo $userid; ?>&carid=<?php echo $carid; ?>&extra_charge=<?php echo $extra_charge; ?>">
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
    <p>User ID, Car ID, or Extra Charge is missing in the URL.</p>
    <?php endif; ?>

</body>

</html>