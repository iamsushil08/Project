<?php
session_start();
session_unset();
setcookie('PHPSESSID', '', time() - 3600, '/');
session_destroy();

header("Location: ../index.php"); 
exit();
?>