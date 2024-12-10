<?php
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



?>