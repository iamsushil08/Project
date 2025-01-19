<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);




date_default_timezone_set('Asia/Kathmandu'); // For Nepal Standard Time


$current_time = date("Y-m-d H:i:s");


$updateCarsSql = "
    UPDATE cars c
    INNER JOIN reservations r ON c.id = r.car_id
    SET c.status = 'available'
    WHERE r.end_time <= '$current_time' AND c.status = 'booked'";


if (!mysqli_query($conn, $updateCarsSql)) {
    echo "Error updating car statuses: " . mysqli_error($conn);
}


?>