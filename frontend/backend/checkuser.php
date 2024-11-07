<?php
session_start();

if (isset($_SESSION['username'])) {
    
    $car_id = $_GET['car_id'];
    $extra_charge = $_GET['extra_charge'];
    $username = $_SESSION['username'];  
    header("Location: bookcar.php?car_id=$car_id&extra_charge=$extra_charge&username=$username");
    exit;
} else {
   
  
    $_SESSION['car_id'] = $_GET['car_id'];  
    $_SESSION['extra_charge'] = $_GET['extra_charge'];
    $_SESSION['redirect_to_checkuser'] = true; 
    header("Location: signup.php");
  
    exit;
}
?>