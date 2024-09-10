<?php 
include("./connection.php");

if(isset($_POST["submit"])){
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];


    $password_hashed= password_hash($password, PASSWORD_DEFAULT);
    $sql="INSERT INTO users(firstname,lastname,email,phone,password) VALUES ('$fname','$lname','$email','$phone','$password_hashed')";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo "Unsuccessful";

    }
  
}




?>