<?php 
include"./connection.php";
if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];
                header("Location:../..index.php");
                exit;
            } else {
                $error = "Incorrect username or password right here";
            }
        } else {
            $error = "User doenot exist";
        }
    } else {
        $error = "Please enter both username and password.";
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
        font-family: "Segoe UI Historic",
            "Segoe UI",
            Helvetica,
            Arial,
            sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        background-color: #f0f0f0;
    }

    form {
        display: flex;
        flex-direction: column;
        max-width: 350px;
        background-color: #9aa0a6;
        padding: 20px;
        border-radius: 10px;
    }

    form label {
        margin-bottom: 10px;
    }

    form label span {
        font-size: 14px;
    }

    input[type="text"],
    input[type="password"] {
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
        margin-top: 10px;
    }

    .submit:hover {
        background-color: rgb(56, 90, 194);
    }

    #pforget,
    #createone {
        font-size: 12px;
        color: blue;
        text-align: center;
        margin-top: 5px;
    }

    #message {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: black;
        margin-bottom: 10px;
    }

    #pw_error,
    #uname_error {
        color: red;
        font-size: 11px;
        margin-top: 2px;
        margin-bottom: 8px;
    }
    </style>
</head>

<body>
    <form action="./signup.php" method="POST">
        <p id="message">WELCOME BACK!</p>

        <div class="username">
            <label>
                <span>Username</span>
                <input type="text" id="uname" name="username" />
            </label>
            <br>
            <div id="phperror" style="font-size:13px;color: red;">
                <?php if (!empty($error)) { echo $error; } ?>
            </div>

        </div>
        <br />
        <div class="password">
            <label>
                <span>Password</span>
                <input type="password" id="pw" name="password" />
            </label>

        </div>
        <br />
        <button class="submit" name="signin">SIGN IN</button>
        <p id="pforget"><a href="./forgetpw.php">Forgot Password?</a></p>
        <p id="createone">Don't have an account? <a href="./register.html">Create One</a></p>
    </form>
</body>

</html>