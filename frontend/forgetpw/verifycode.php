<?php
session_start();
include('../connect/connection.php');

if (isset($_SESSION['email'])) {
    // echo "Session email: " . $_SESSION['email'];
} else {
    echo "Session 'email' is not set.";
}

if (isset($_POST['verify'])) {
    $vcode = $_POST['verifiedcode'];
    $email = $_SESSION['email'];

  

    $sql = "SELECT code FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $acode = $row['code'];

        if ($vcode === $acode) {
            $sql="update users set code = NULL  where email ='$email'";
            $result=mysqli_query($conn,$sql);

            if($result)
            {
            header("Location:./changep.php");
            exit();
            }
            else{
                echo "could not update on db";
            }
        } else {
            echo "Incorrect verification code. Please retry.";
        }
    } else {
        echo "No verification code found. Please try again.";
    }
} else {
    echo "Verification code not found in form submission.";
}
?>