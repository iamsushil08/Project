<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>










    </style>

</head>

<body>
    <form action="search.php" method="GET"><input type="text" name="searching" placeholder="Search for cars"><button
            type="submit">Search</button></form><?php include("connection.php");

    if (isset($_GET['searching'])) {
        $searching=$_GET['searching'];
        $query="SELECT * FROM cars WHERE name = '$searching'";
        $result=mysqli_query($conn, $query);


        if (mysqli_num_rows($result) > 0) {

            while ($car=mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<h3>". $car['name']."</h3>";
                echo "<img src='". $car['image_url'] . "' alt='". $car['model'] . "' style='width:300px;height:auto;'><br>";
                echo "<p>Color: ". $car['color'] . "</p>";
                echo "<p>Mileage: ". $car['mileage'] . " km/l</p>";
                echo "<p>Description: ". $car['description'] . "</p>";
                echo "<p>Extra Charge: ". $car['extra_charge'] . "</p>";
                echo "<p>Status: ". $car['status'] . "</p>";
                echo "<p>Plate Number: ". $car['plate_number'] . "</p>";

                if ($car['status']==='Available') {
                    echo "<a href='bookcar.php?car_id=". $car['id'] . "'>Book Now</a>";

                }

                else {
                    echo "<p>Rented Out</p>";
                }

                echo "</div><br>";
            }
        }

        else {
            echo "<p>No cars found with the specified model.</p>";
        }
    }

    ?>
</body>

</html>