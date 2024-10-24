<?php 
include("./connection.php");

if(isset($_POST(["submit"]))){
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];

    if ($password !== $cpassword) {
        echo "Passwords do not match!";
  
    }
    $password_hashed= password_hash($password, PASSWORD_DEFAULT);
    $sql="INSERT INTO users(firstname,lastname,email,phone,password) VALUES ('$fname','$lname','$email','$phone','$password_hashed')";
    $result=mysqli_query($conn,$sql);
    if($result){
       header("Location:../index.html");
       exit();
//    echo" you are logged in";

    }
    else{ 
        // echo"Not done"; 
        echo "Error: " . mysqli_error($conn); 
    }

  
}




?>