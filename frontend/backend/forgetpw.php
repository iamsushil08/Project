<?php
session_start();
include './connection.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $code = random_int(1000, 9999);

        $update_sql = "UPDATE users SET code = '$code' WHERE email = '$email'";
        $update_result = mysqli_query($conn, $update_sql);

        if (mysqli_affected_rows($conn) > 0) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'paudelsandhya1588@gmail.com';
                $mail->Password = 'rybq rkda yoez lblo';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('paudelsandhya1588@gmail.com', 'DRIVZY Team!');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Verification Code';
                $mail->Body = "Your Verification Code is: <b>$code</b>";
                $mail->AltBody = "Your Verification Code is: $code";

                $mail->send();

                header("Location: vcode.php?");
                exit();
            } catch (Exception $e) {
                echo "Mailer Error: {$mail->ErrorInfo}";
            }
        }
    } else {
        echo "No user found with this email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    * {
        font-family: "Open Sans", sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f0f0f0;
    }

    form {
        display: flex;
        flex-direction: column;
        width: 300px;
        height: 220px;
        background-color: #9aa0a6;
        padding: 20px;
        border-radius: 10px;
    }

    form label {
        margin-bottom: 0px;
    }

    form label span {
        margin-left: 11px;
        font-size: 15px;
        font-weight: 300px;
    }

    input[type="text"] {
        width: 95%;
        padding: 10px;
        border: 1px solid rgba(105, 105, 105, 0.4);
        border-radius: 8px;
        font-size: 15px;
        margin-top: 10px;
        color: #333;
    }

    input[type="text"]::placeholder {
        color: #666;
        font-size: 13px;
    }

    .submit {
        border: none;
        background-color: royalblue;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 15px;
        margin-top: 15px;
    }

    .submit:hover {
        background-color: rgb(56, 90, 194);
    }

    #login {
        text-align: center;
    }

    #login a {
        font-size: 12px;
        color: blue;
        margin-left: 4px;
    }

    #message {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: black;
        margin-bottom: 15px;
        margin-top: 3px;
    }

    #smessage {
        color: black;
        font-size: 11px;
        margin-top: -9px;
        text-align: center;
    }

    #email_error {
        color: red;
        font-size: 12px;
        margin-top: 2px;
    }
    </style>
</head>

<body>
    <form action="forgetpw.php" method="POST">
        <p id="message">Forget Password?</p>
        <p id="smessage">No worries, we'll send you reset instructions.</p>

        <div class="email">
            <label>
                <input type="text" id="email" name="email" placeholder="Enter your email" required />
            </label>
            <br />
        </div>
        <br />
        <button class="submit" name="reset">Reset Password</button>
        <p id="login"><a href="./signup.php">Back to log in</a></p>
    </form>
</body>

</html>