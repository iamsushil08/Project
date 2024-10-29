<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search</title>
    <style>
    /* Style the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <form action="search.php" method="GET">
        <input type="text" name="searching" placeholder="Search for cars">
        <button type="submit">Search</button>
    </form>

    <?php 
    include("connection.php");

    if (isset($_GET['searching'])) {
        $searching = $_GET['searching'];
        $query = "SELECT * FROM cars WHERE name = '$searching'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Car Name</th>
                    <th>Image</th>
                    <th>Color</th>
                    <th>Mileage</th>
                    <th>Description</th>
                    <th>Extra Charge</th>
                    <th>Status</th>
                    <th>Plate Number</th>
                    <th>Action</th>
                  </tr>";

            while ($car = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $car['name'] . "</td>";
                echo "<td><img src='" . $car['image_url'] . "' alt='" . $car['model'] . "' style='width:100px;height:auto;'></td>";
                echo "<td>" . $car['color'] . "</td>";
                echo "<td>" . $car['mileage'] . " km/l</td>";
                echo "<td>" . $car['description'] . "</td>";
                echo "<td>" . $car['extra_charge'] . "</td>";
                echo "<td>" . $car['status'] . "</td>";
                echo "<td>" . $car['plate_number'] . "</td>";

               
                if ($car['status'] === 'Available') {
                    echo "<td><a href='bookcar.php?car_id=" . $car['id'] . "&extra_charge=" . $car['extra_charge'] . "'>Book Now</a></td>";
                } else {
                    echo "<td>Rented Out</td>";
                }
                
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No cars found with the specified model.</p>";
        }
    }
    ?>
</body>

</html>