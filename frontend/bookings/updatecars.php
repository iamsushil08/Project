<!-- <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Kathmandu'); // For Nepal Standard Time

$current_time = date("Y-m-d H:i:s");


$time_limit = date("Y-m-d H:i:s", strtotime("-5 minutes"));

// Update car status and payment status
$updateCarsAndPaymentSql = "
    UPDATE cars c
    INNER JOIN reservations r ON c.id = r.car_id
    SET c.status = 'available', r.payment_status = 'paid'
    WHERE r.end_time <= '$time_limit' 
    AND c.status = 'booked' AND r.payment_status = 'pending'";

if (!mysqli_query($conn, $updateCarsAndPaymentSql)) {
    echo "Error updating car statuses and payment status: " . mysqli_error($conn);
}
?> -->