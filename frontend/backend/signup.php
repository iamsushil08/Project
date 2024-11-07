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

                header("Location: ../index.php");
                exit;
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
    <title>Document</title>

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
    }

    form {
        display: flex;
        flex-direction: column;
        max-width: 350px;
        background-color: #9AA0A6;
        padding: 20px;
        border-radius: 10px;
        justify-content: center;
        padding-bottom: 5px;
    }

    form label #username,
    #pw {
        width: 95%;
        height: 10px;
        padding: 10px 10px 20px 10px;
        border: 1px solid rgba(105, 105, 105, 0.397);
        border-radius: 10px;
        font-size: 15px;
    }

    .submit {
        border: none;
        background-color: royalblue;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 15px;
    }

    .submit:hover {
        background-color: rgb(56, 90, 194);
    }

    #pforget {
        margin-left: 190px;
        margin-top: 5px;
    }

    #pforget a {
        text-decoration: none;
        font-size: 12px;
    }

    #createone {
        margin-bottom: 8px;
        text-align: center;
        font-size: 12px;
    }

    #createone a {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <form action="./signup.php" method="POST">
        <div class="username">
            <label>
                <span>Username</span>
                <input required="" placeholder="" type="text" id="username" name="username" />
            </label>
        </div>
        <br />
        <div class="password">
            <label>
                <span>Password</span>
                <input required="" placeholder="" type="password" id="pw" name="password" />
            </label>
        </div>
        <br />
        <button class="submit" name="signin">SIGN IN</button>
        <p id="pforget"><a href="">Forgot Password?</a></p>
        <p id="createone">Don't have an account? <a href="./register.html">Create One</a></p>
    </form>
</body>

</html>