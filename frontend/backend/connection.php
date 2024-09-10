<?php

$host="localhost";
$user="root";
$pw="";
$dbname="carrent";

$conn=mysqli_connect($host,$user,$pw,$dbname);
if(!$conn){
echo"Error while connecting";
}
?>

