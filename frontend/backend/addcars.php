<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./addcars.php" method="POST" enctype="multipart/form-data">
        <label for="">Car Name</label>
        <input type=" text" name="name">
        <br>
        <label for="">Car Model</label>
        <input type="text" name="model">
        <br>

        <label for="">Car Color</label>
        <input type="text" name="color">
        <br>
        <label for="">Car Mileage</label>
        <input type="text" name="mileage">
        <br>
        <label for="">Description</label>
        <textarea name="description" rows="3" cols="20" required></textarea>
        <br>
        <label for="">Charge</label>
        <input type="text" name="charge">
        <br>

        <label for="">Status</label>
        <select name="status" id="" required>
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
        </select>
        <br>
        <label for="">Plate Number</label>
        <input type=" text" name="plate_number">
        <br>
        <label for="">Car Image</label>
        <input type="file" name="file" accept="image/*">
        <br><input type="submit" name="submit" value="Submit">
        <input type="submit" name="reset" value="Reset">
    </form>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
include("./connection.php");

$name = $_POST['name'];
$model = $_POST['model'];
$color = $_POST['color'];
$mileage = $_POST['mileage'];
$description = $_POST['description'];
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
// overwrite nahos so using time
$unique_file = time() . "_" . basename($filename);
$destination = "carimages/" . $unique_file;


if (move_uploaded_file($filetemp, $destination)) {
   
$query = "INSERT INTO cars (name, model, color, mileage, description, charge, status, plate_number, image_url)
VALUES ('$name', '$model', '$color', '$mileage', '$description', '$charge', '$status', '$plate_number',
'$destination')";

if (mysqli_query($conn, $query)) {

} else {
echo "Error: " . mysqli_error($conn);
}
} else {
echo "Failed to move the uploaded file.";
}
} else {
echo "Invalid file type. Only JPEG, PNG, and JPG formats are allowed.";
}
}
}

?>