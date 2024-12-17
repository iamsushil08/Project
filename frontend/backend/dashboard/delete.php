<?php
// deleting feedback wala
include"./connection.php";

if(isset($_GET['id'])){
    $id=$_GET['id'];


    $query="delete from contacts where id=$id";
    $result=mysqli_query($conn,$query);

    if($result){
        header("Location:./dashboard.php#feedbacks"); 
        exit;       
    }
    else{
        echo"Couldnot found record";
    }
    
}
//deleting user from here
if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
    $query="delete from users where user_id=$user_id";

    $result=mysqli_query($conn,$query);
    if($result){
        header("Location:./dashboard.php#manage-users");
        exit;
    }
    else{
        echo "Couldnot delete";
    }
}

//deleting car 
if(isset($_GET['car_id'])){
    $car_id=$_GET['car_id'];
    $query="delete from cars where id=$car_id";
    $result=mysqli_query($conn,$query);
    
    if($result){
        header("Location:./dashboard.php#manage-cars");
        exit;
    }
    else{
        echo "Couldnot found the car";
    }
}


?>