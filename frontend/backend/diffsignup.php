<?php
session_start();
include "./connection.php";

$error="";

   

if (isset($_POST['signin'])) {
    $username =  $_POST['username'];
    $password = $_POST['password'];

  
    if (!empty($username) && !empty($password)) {
        $sql = "select * from users where username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

           
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];
            
                    header("Location: checkuser.php"); 
                    exit;
                }
      
            } else {
                
                $error= "Incorrect username or password.";
            }
        } else {
           
            $error= "User not found.";
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
        margin-bottom: 8p
    }
    </style>
</head>

<body>
    <form
        action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?car_id=<?php echo isset($_GET['car_id']) ? $_GET['car_id'] : ''; ?>"
        method="POST" onsubmit="return validateForm(event)">
        <p id="message">WELCOME BACK!</p>
        <div id="phperror" style=" font-size:13px;color: red; text-align: center;">
            <?php if (!empty($error)) { echo $error; } ?>
        </div>
        <div class="username">
            <label>
                <span>Username</span>
                <input type="text" id="uname" name="username" />
            </label>
            <br>
            <div id="uname_error"></div>
        </div>
        <br />
        <div class="password">
            <label>
                <span>Password</span>
                <input type="text" id="pw" name="password" />
            </label>
            <br>
            <div id="pw_error"></div>
        </div>
        <br />
        <button class="submit" name="signin">SIGN IN</button>
        <p id="pforget"><a href="./forgetpw.php">Forgot Password?</a></p>
        <p id="createone">Don't have an account? <a href="./register.html">Create One</a></p>


    </form>
</body>
<script>
document.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }
});

function validateForm(event) {
    var isUnameValid = validateUname();
    var isPasswordValid = validatePassword();
    return isUnameValid && isPasswordValid;
}

function validateUname() {
    var unameInput = document.getElementById('uname').value.trim();
    var unameError = document.getElementById('uname_error');
    var unamePattern = /^[A-Za-z\s]+$/;

    if (unameInput === "") {
        unameError.innerHTML = "Cannot have empty field";
        return false;
    } else if (!unamePattern.test(unameInput)) {
        unameError.innerHTML = "Invalid name";
        return false;
    } else if (unameInput.length < 8) {
        unameError.innerHTML = "Insufficient characters";
        return false;
    } else {
        unameError.innerHTML = "";
        return true;
    }
}

function validatePassword() {
    var pwInput = document.getElementById('pw').value.trim();
    var pwError = document.getElementById('pw_error');

    if (pwInput === "") {
        pwError.innerHTML = "Cannot have empty field";
        return false;
    } else if (pwInput.length < 8) {
        pwError.innerHTML = "Password must be at least 8 characters";
        return false;
    } else {
        pwError.innerHTML = "";
        return true;
    }
}
</script>

</html>
<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
?>