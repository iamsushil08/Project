<?php
session_start();
if (!isset($_SESSION['user_id'])) {
 
header("Location: signup.php");
exit();
}
else{
header("Location: bookcar.php");
}
?>