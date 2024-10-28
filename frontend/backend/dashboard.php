<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location:alogin.php');
    exit;
}
?>

<html>
<button><a href="./addcars.php">Add Cars</a></button>
<button><a href="">Delete Cars</a></button>
<button><a href="">Manage Users</a></button>
<button><a href="">Manage Payment</a></button>

</html>