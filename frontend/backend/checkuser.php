<?php
session_start();
include('./connection.php');
if(isset($_GET['car_id'])){
    $car_id=$_GET['car_id'];

    // url bata liyera session ma haleko hai car id
    $_SESSION['car_id']=$car_id;

if (isset($_SESSION['email'])) {
  
    header("Location: bookcar.php?");
    exit;
}

else {
    
    header("Location:diffsignup.php");
    exit;
}
}
else{
    echo "car id missing";
    exit;
}

?>