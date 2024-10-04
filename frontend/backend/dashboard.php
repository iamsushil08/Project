<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location:alogin.php');
    exit;
}
?>

<html>
<h2>Admin Dashboard</h2>
<button><a href=".div1" style="text-decoration:none">Add Car</a></button>
<button><a href="" style="text-decoration:none">Delete Car </a></button>



<div class="div1">
    <form action="" method="POST">
        hello
    </form>
</div>

</html>