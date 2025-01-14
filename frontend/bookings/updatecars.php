<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);



// Set the correct timezone
date_default_timezone_set('Asia/Kathmandu'); // For Nepal Standard Time

// Get the current time
$current_time = date("Y-m-d H:i:s");

// Update the car status based on the reservation end_time
$updateCarsSql = "
    UPDATE cars c
    INNER JOIN reservations r ON c.id = r.car_id
    SET c.status = 'available'
    WHERE r.end_time <= '$current_time' AND c.status = 'booked'";

// Execute the query to update the car status
if (!mysqli_query($conn, $updateCarsSql)) {
    echo "Error updating car statuses: " . mysqli_error($conn);
}


?>