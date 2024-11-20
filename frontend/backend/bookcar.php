<?php 
session_start();
include('./connection.php');

if(!isset($_SESSION['email'])){
    header("Location: ./diffsignup.php");
    exit;
    
}
if(!isset($_SESSION['car_id'])){

    echo "Car id is not seen.Retry booking a car";
    exit;
}

  $car_id=$_SESSION['car_id'];

    $query="select * from cars where id='$car_id'";
    $result=mysqli_query($conn,$query);

    if($result && mysqli_num_rows($result)>0){
        $car=mysqli_fetch_assoc($result);
    }
    else{
        echo "car not found";
        exit;
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


    <form method="POST" action="./payment.php">

        <input type="hidden" name="car_id" id="car_id" value="<?php echo htmlspecialchars($car_id);?>">
        <input type="hidden" name="car_id" id="car_id" value="<?php echo htmlspecialchars($car['charge']);?>">
        <label for="">Location:</label>
        <input type=" text" id="location" name="location" required>
        <br><br>



        <label for="">Start Date:</label>
        <input type="datetime-local" id="start" name="start" required>
        <br><br>

        <label for="">End Date:</label>
        <input type="datetime-local" id="end" name="end" required>
        <br><br>

        <button type="submit" name="confirm">Proceed to Booking</button>
    </form>



</body>

</html>