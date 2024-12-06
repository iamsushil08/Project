<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: signup.php");
    exit;
}
include('./backend/connection.php');
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>

<body>
    <h1>Welcome to Your Dashboard!</h1>

    <nav>
        <a href="./index.php">Home</a>
        <a href="myreservations.php">My Reservations</a>
        <a href="profile.php">My Profile</a>
        <a href="logout.php">Logout</a>
    </nav>

    <section>
        <h2>Quick Actions</h2>
        <p><a href="searchcars.php">Search for Cars</a></p>
        <p><a href="myreservations.php">View My Reservations</a></p>
        <p><a href="profile.php">Edit My Profile</a></p>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Online Car Rental System</p>
    </footer>
</body>

</html>