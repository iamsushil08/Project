<?php
include('../connect/connection.php');

// Get the current time
$current_time = date("Y-m-d H:i:s");


$sql = "UPDATE cars c
        INNER JOIN reservations r ON c.id = r.car_id
        SET c.status = 'available', r.status = 'completed'
        WHERE r.end_time <= '$current_time' AND c.status = 'booked' AND r.status = 'booked'";


if (mysqli_query($conn, $sql)) {
    echo "Car statuses updated successfully.";
} else {
    echo "Error updating statuses: " . mysqli_error($conn);
}

mysqli_close($conn);
?>