<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location:alogin.php');
    exit;
}
?>

<html>
<button><a href="./addcars.php">Add Cars</a></button>
<button><a href="./feedbacks.php">feedbacks</a></button>
<button><a href="./managecars.php">Manage Cars</a></button>
<button><a href="">Manage Users</a></button>
<button><a href="">Manage Payment</a></button>
<button><a href="./adminlogout.php">Log out</a></button>

</html>