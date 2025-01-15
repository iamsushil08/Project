<?php
session_start();
include '../connect/connection.php';


if (isset($_SESSION['email'])) {

    $_SESSION['message'] = "Please log out first to log in as Admin.";
    header('Location: ../index.php#footerlinks');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['email'] = $admin['email'];  
        header('Location: ../dashboard/dashboard.php');
        exit;
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: "Segoe UI Historic", "Segoe UI", Helvetica, Arial, sans-serif;
        background-color: #c45946;
    }

    form {
        display: flex;
        flex-direction: column;
        max-width: 350px;
        background-color: #9aa0a6;
        padding: 20px;
        border-radius: 10px;
        height: 250px;
    }

    form h2 {
        text-align: center;
    }

    form label {
        margin-bottom: 10px;
    }

    #submit {
        border: none;
        background-color: royalblue;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
        margin-top: 10px;
    }

    #submit:hover {
        background-color: rgb(56, 90, 194);
    }

    input[type="text"],
    input[type="password"] {
        width: 95%;
        padding: 10px;
        padding-left: 5px;
        border: 1px solid rgba(105, 105, 105, 0.4);
        border-radius: 10px;
        font-size: 15px;
        margin-top: 3px;
        text-align: center;
    }

    .message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>


    <form method="POST" action="./admin.php">
        <h2>Admin Login</h2>
        <input type="text" name="username" placeholder="Admin Username" required /><br /><br />
        <input type="password" name="password" placeholder="Password" required /><br />
        <button type="submit" id="submit">Login</button>
    </form>
</body>

</html>