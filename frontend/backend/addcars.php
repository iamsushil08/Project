<form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Car Name:</label>
    <input type="text" name="name" required><br>

    <label for="model">Car Model:</label>
    <input type="text" name="model" required><br>

    <label for="color">Car Color:</label>
    <input type="text" name="color" required><br>

    <label for="mileage">Car Mileage:</label>
    <input type="text" name="mileage" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="extra_charge">Extra Charge:</label>
    <input type="number" name="extra_charge" required><br>

    <label for="status">Status:</label>
    <select name="status" required>
        <option value="Available">Available</option>
        <option value="Booked">Booked</option>

    </select><br>

    <label for="plate_number">Plate Number:</label>
    <input type="text" name="plate_number" required><br>

    <label for="image">Car Image:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <button type="submit">Add Car</button>
</form>
<?php 


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("./connection.php");
    $name=$_POST['name'];
    $model=$_POST['model'];
    $color=$_POST['color'];
    $mileage=$_POST['mileage'];
    $description=$_POST['description'];
    $extra_charge=$_POST['extra_charge'];
    $status=$_POST['status'];
    $plate_number=$_POST['plate_number'];
    



    $query="insert into cars(name,model,color,mileage,description,extra_charge,status,plate_number,image_url) values(
                             '$name','$model','$color','$mileage','$description','$extra_charge','$status','$plate_number','$image_url')";


        if(mysqli_query($conn,$query)){
        echo "successfull";
        }
        else{
            echo "error".mysqli_error($conn);
        }
    
}


?>