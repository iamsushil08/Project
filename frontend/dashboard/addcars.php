<?php
include("../connect/connection.php");
 $uploadcarimg = "../carimages/"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


$name = $_POST['name'];
$model = $_POST['model'];
$color = $_POST['color'];
$mileage = $_POST['mileage'];
$type=$_POST['cartype'];
$description = $_POST['description'];
$noofseats=$_POST['noofseats'];
$charge = $_POST['charge'];
$status = $_POST['status'];
$plate_number = $_POST['plate_number'];



if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
$filename = $_FILES['file']['name'];
$filesize = $_FILES['file']['size'];
$filetemp = $_FILES['file']['tmp_name'];
$filetype = $_FILES['file']['type'];


$extensions = array("image/jpeg", "image/png", "image/jpg");

if (in_array($filetype, $extensions)) {
//avoiding override here
$unique_file = time() . "_" . basename($filename);
$destination = $uploadcarimg. $unique_file;
  


   if (move_uploaded_file($filetemp, $destination)) {
    $car_img="carimages/".$unique_file;
    }

   
   else {
     echo "Failed to move the uploaded file.";
   }


   
}
 else {
echo "Invalid file type. Only JPEG, PNG, and JPG formats are allowed.";
}

}
$query = "INSERT INTO cars (name, model, color, mileage,type, description,noofseats, charge, status, plate_number, image_url)
VALUES ('$name', '$model', '$color', '$mileage','$type', '$description','$noofseats', '$charge', '$status', '$plate_number',
 '$car_img')";
 $result=mysqli_query($conn,$query);

if ($result) {
   header("Location:./dashboard.php#addcars");
   exit;

} 
else {
echo "Error: " . mysqli_error($conn);
}
}




?>