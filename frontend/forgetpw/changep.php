<?php
session_start();
include '../connect/connection.php';
if (!isset($_SESSION['email'])) {
    header("Location:../connect/connection.php");
    exit();
}
 if(isset($_POST['resetpw'])){
    $email= $_SESSION['email'];
    $newpassword = $_POST['newpassword'];
    $cpw= $_POST['cpw'];

    if($newpassword === $cpw){
        $hashedp= password_hash($newpassword,PASSWORD_DEFAULT);

        $sql="update users set password ='$hashedp' where email='$email'";
        $result=mysqli_query($conn,$sql);


        if($result){
          
            unset($_SESSION['email']);
            header("Location:../connect/signup.php");
            exit;
        }
        else{
            echo "Failed to update password";
        }
        
    }
 else{
    echo 'Password donot match';
    
 }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
* {
    font-family: "Open Sans", sans-serif;
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

/* #pforget,
#createone {
    font-size: 12px;
    color: blue;
    text-align: center;
    margin-top: 5px;
} */

#message {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: black;
    margin-bottom: 10px;
}

#pw_error,
#cpw_error {
    color: red;
    font-size: 12px;
    margin-top: 2px;
    margin-bottom: 8p
}

#login {
    text-align: center;
}

#login a {
    font-size: 12px;
    color: blue;
    margin-left: 4px;
}
</style>
</head>

<body>
    <form action="./changep.php" method="POST" onsubmit="return validateForm(event)">
        <p id="message">Reset Password</p>



        <div class="password">
            <label>
                <span>Password</span>
                <input type="password" id="pw" name="newpassword" />
            </label>
            <br>
            <div id="pw_error"></div>
        </div>
        <div class="cpassword">
            <label>
                <span>Confirm Password</span>
                <input type="password" id="cpw" name="cpw" />
            </label>
            <br>
            <div id="cpw_error"></div>
        </div>
        <br />
        <button class="submit" name="resetpw">Reset Password</button>
        <p id="login"><a href="../connect/signup.php">Back to log in</a></p>

    </form>
</body>

</html>