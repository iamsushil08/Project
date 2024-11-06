<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: signup.php");
    exit;
}

$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>

<body>
    <h1>Welcome, <?php echo htmlspecialchars($email); ?>!</h1>
    <p>This is your profile page.</p>
    <a href="logout.php">Logout</a>
</body>

</html>