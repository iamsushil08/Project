<?php



session_start();
include './connection.php'; 

if (isset($_POST['reset'])) {
    $to = ($_POST['Email']);
    
   
    
    $code = random_int(1000, 9999);




    $sql = "UPDATE users SET code = $code WHERE email = '$to'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
   
        $subject = "Your Verification Code";
        $message = "Your verification code is: $code";
        $headers = "From: paudelsandhya1588@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully with the code.";
        } else {
            echo "Failed to send the email.";
        }
    } 
    else {
        echo "Email address doesnot exist.";
    }
}
?>