<?php

$host="localhost";
$user="root";
$pw="";
$dbname="carrenting";

$conn=mysqli_connect($host,$user,$pw,$dbname);
if(!$conn){
echo"Error while connecting";
}
?>