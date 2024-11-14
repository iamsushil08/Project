<?php
session_start();
include './connection.php'; 

require'../PHPMailer-master/src/PHPMailer.php';
require'../PHPMailer-master/src/Exception.php';
require'../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['reset'])) {
    $to = ($_POST['Email']);
    
   
    
    $code = random_int(1000, 9999);




    $sql = "UPDATE users SET code = $code WHERE email = '$to'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn)>0){
        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username='paudelsandhya1588@gmail.com';
            $mail->Password='rybq rkda yoez lblo';
            $mail->SMTPSecure= PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port=587;

            $mail->setFrom('paudelsandhya1588@gmail.com','DRIVZY Team!');
            $mail->addAddress($to);
            


            $mail->isHTML(true);
            $mail->Subject='Verification Code';
            $mail->Body='Your Verification Code is :'.$code;
            $mail->AltBody="Your Verification Code is: $code";

            
            $mail->send();
            echo "Email sent successfully";
            

            
        }
        catch(Exception $e){
            echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
    }
}
    else{
        echo "Email doesnot exist";
    }
}
?>