<form method="POST" action="">
    <label for="hours">Enter number of hours:</label>
    <input type="number" name="hours" min="" value="" required>
    <button type="submit">Confirm Booking</button>
</form>
<?php
include("connection.php");

if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
    
    
    $query = "SELECT * FROM cars WHERE id = '$car_id' AND status = 'Available'";
    $result = mysqli_query($conn, $query);
    $universal_price=200;

    if (mysqli_num_rows($result) > 0) {
        
        $car = mysqli_fetch_assoc($result);
        $hours = $_POST['hours']; 
        $extra_charge = $car['extra_charge'];
        
      
        $total_payment = ($universal_price + $extra_charge) * $hours;

     
        $update_query = "UPDATE cars SET status = 'Rented Out' WHERE id = '$car_id'";
        
        if (mysqli_query($conn, $update_query)) {
           
            $user_id = 1; 
            $booking_query = "INSERT INTO bookings (user_id, car_id) VALUES ('$user_id', '$car_id')";
            mysqli_query($conn, $booking_query);
            
            echo "Car has been successfully booked!<br>";
            echo "Total Payment: $" . $total_payment;
        } else {
            echo "Error booking the car: " . mysqli_error($conn);
        }
    } else {
        echo "This car is not available for booking.";
    }
} else {
    echo "No car ID provided.";
}
?>