<!-- <?php
session_start();
include "./connection.php";

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the user's information from the database
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle password change
if (isset($_POST['change_password'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $update_sql = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
    if (mysqli_query($conn, $update_sql)) {
        echo "Password changed successfully!";
    } else {
        echo "Error updating password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .profile-container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 350px;
        text-align: center;
    }

    input[type="password"],
    button {
        margin-top: 10px;
        padding: 10px;
        width: 100%;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        background-color: royalblue;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: navy;
    }
    </style>
</head>

<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>

        <h3>Change Password</h3>
        <form action="profile.php" method="POST">
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" name="change_password">Change Password</button>
        </form>
    </div>
</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
</head>

<body>

    <?php if ($userid && $carid): ?>
    <form method="POST" action="">
        <label for="locationfrom">Location From:</label>
        <input type="text" id="locationfrom" name="locationfrom" required>
        <br><br>

        <label for="locationto">Location To:</label>
        <input type="text" id="locationto" name="locationto" required>
        <br><br>

        <label for="starttime">Start Date and Time:</label>
        <input type="datetime-local" id="starttime" name="starttime" required>
        <br><br>

        <label for="endtime">End Date and Time:</label>
        <input type="datetime-local" id="endtime" name="endtime" required>
        <br><br>

        <button type="submit" name="confirm">Confirm Booking</button>
    </form>
    <?php else: ?>
    <p>User or car information is missing. Please try again.</p>
    <?php endif; ?>

</body>

</html>