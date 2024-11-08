<?php
session_start();
include "./connection.php";

if (isset($_POST['signin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];

                // Check if there’s a saved redirect target after login
                if (isset($_SESSION['redirect_to_checkuser']) && $_SESSION['redirect_to_checkuser'] === true) {
                    $car_id = $_SESSION['car_id'];
                    $extra_charge = $_SESSION['extra_charge'];

                    unset($_SESSION['car_id']);
                    unset($_SESSION['extra_charge']);
                    unset($_SESSION['redirect_to_checkuser']);

                    header("Location: checkuser.php?car_id=$car_id&extra_charge=$extra_charge");
                    exit;
                } else {
                    // If no specific redirection target, go to index.php
                    header("Location: index.php");
                    exit;
                }
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No user found with that username.";
        }
    } else {
        echo "Please enter both username and password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <style>
    * {
        font-family: "Open Sans", sans-serif;
        font-optical-sizing: auto;
        font-weight: 500;
        font-style: normal;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    form {
        display: flex;
        flex-direction: column;
        max-width: 350px;
        background-color: #9aa0a6;
        padding: 20px;
        border-radius: 10px;
        justify-content: center;
    }

    form label input[type="text"],
    form label input[type="password"] {
        width: 95%;
        padding: 10px;
        border: 1px solid rgba(105, 105, 105, 0.4);
        border-radius: 10px;
        font-size: 15px;
        margin-top: 5px;
    }

    .submit {
        border: none;
        background-color: royalblue;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
    }

    .submit:hover {
        background-color: rgb(56, 90, 194);
    }

    #pforget {
        margin-left: auto;
        margin-top: 5px;
    }

    #pforget a,
    #createone a {

        font-size: 12px;
        color: blue;
    }

    #createone {
        margin-top: 10px;
        text-align: center;
        font-size: 12px;

    }





    #message {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: black;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <form action="./signup.php" method="POST">
        <p id="message">WELCOME BACK!</p>
        <div class="username">
            <label>
                <span>Username</span>
                <input required type="text" id="username" name="username" />
            </label>
        </div>
        <br />
        <div class="password">
            <label>
                <span>Password</span>
                <input required type="password" id="pw" name="password" />
            </label>
        </div>
        <br />
        <button class="submit" name="signin">SIGN IN</button>
        <p id="pforget"><a href="#">Forgot Password?</a></p>
        <p id="createone">Don't have an account? <a href="./register.html">Create One</a></p>
    </form>
</body>

</html>