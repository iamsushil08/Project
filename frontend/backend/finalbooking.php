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


$query = "SELECT * FROM cars WHERE id = '$car_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $car = mysqli_fetch_assoc($result);
} else {
    echo "Car details not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Booking</title>
</head>

<body>
    <h1>Final Booking</h1>
    <div>
        <h2>Car Details</h2>
        <p><strong>Car Name:</strong> <?php echo htmlspecialchars($car['name']); ?></p>
        <p><strong>Car Description:</strong> <?php echo htmlspecialchars($car['description']); ?></p>
        <p><strong>Car Color:</strong> <?php echo htmlspecialchars($car['color']); ?></p>
        <p><strong>Car Charge per Hour:</strong> <?php echo htmlspecialchars($car['charge']); ?></p>
        <p><strong>Total Payment:</strong> <?php echo number_format($totalpayment, 2); ?></p>
        <p><strong>Down Payment (15%):</strong> <?php echo number_format($downpay, 2); ?></p>
    </div>

    <h2>Booking Details</h2>
    <p><strong>From:</strong> <?php echo htmlspecialchars($fromloc); ?></p>
    <p><strong>To:</strong> <?php echo htmlspecialchars($toloc); ?></p>
    <p><strong>Start Time:</strong> <?php echo $start_time; ?></p>
    <p><strong>End Time:</strong> <?php echo $end_time; ?></p>


    <form action="./processpayment.php" method="POST">
        <input type="hidden" name="downpay" value="<?php echo $downpay; ?>">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        <button type="submit">Pay Now (15% Down Payment)</button>
    </form>
</body>

</html>