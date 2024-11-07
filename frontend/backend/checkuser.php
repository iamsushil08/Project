<?php
session_start();
if (isset($_SESSION['username'])) {
    $car_id = $_GET['car_id'];
    $extra_charge = $_GET['extra_charge'];
    header("Location: bookcar.php?car_id=$car_id&extra_charge=$extra_charge");
    exit;
} else {
    $_SESSION['intended_page'] = "bookcar.php?car_id=" . $_GET['car_id'] . "&extra_charge=" . $_GET['extra_charge'];
    header("Location: signup.php");
    exit;
}

?>