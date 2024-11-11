<?php 
include("./connection.php");
if(isset($_POST['sendMessageBtn'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $message=$_POST['message'];



    $sql="INSERT INTO contacts(name,email,phone,message) VALUES ('$name','$email','$phone','$message')";

    $result=mysqli_query($conn,$sql);
    if($result){
       
        header("Location:../index.php");
        exit();
    }
    else{
        echo "Error:".mysqli_error($conn);
    }


    
    
    
}
?>